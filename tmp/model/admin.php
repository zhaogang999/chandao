<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\admin\model.php');
helper::cd();
class extadminModel extends adminModel 
{
/**
 * 抓取燃起图数据
 * 
 * @return void
 */
public function getBurnUpData()
{
    $this->loadModel('story');

    $projects = $this->dao->select("id")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetchPairs('id');

    foreach ($projects as $project)
    {
        $data = new stdClass();

        $stories = $this->story->getProjectStories($project,'id_desc');
        $data->storyCount = count($stories);
        $data->testedStoryCount = 0;
        $data->developedStoryCount = 0;

        foreach ($stories as $story)
        {
            switch ($story->stage)
            {
                case 'tested':
                    $data->testedStoryCount++;
                    $data->developedStoryCount++;
                    break;
                case 'released':
                    $data->developedStoryCount++;
                    $data->testedStoryCount++;
                    break;
                case 'developed':
                    $data->developedStoryCount++;
                    break;
                case 'testing':
                    $data->developedStoryCount++;
                    break;
            }
        }

        $data->project = $project;
        $data->date = date('Y-m-d');

        $this->dao->insert(TABLE_BURNUP)->data($data)->exec();
        unset($data);
    }
}/**
 * 每日bug情况统计数据
 *
 * @access public
 * @return void
 */
public function getDailyBugStatistics()
{
    $this->loadModel('product');

    $now = helper::today();
    $products = $this->product->getPairs('noclosed');
    $productIDs = implode(',', array_keys($products));

    $createdPerDay = $this->dao->select("product, count(id) as createdPerDay")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('DATE_FORMAT(openedDate, "%Y-%m-%d")')->eq($now)
        ->groupBy('product')
        ->fetchPairs();
    $resolvedPerDay = $this->dao->select("product, count(id) as resolvedPerDay")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('DATE_FORMAT(resolvedDate, "%Y-%m-%d")')->eq($now)
        ->groupBy('product')
        ->fetchPairs();
    $active = $this->dao->select("product, count(id) as actived")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('status')->eq('active')
        ->groupBy('product')
        ->fetchPairs();
    $resolved = $this->dao->select("product, count(id) as resolved")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('status')->eq('resolved')
        ->groupBy('product')
        ->fetchPairs();
    $opened = $this->dao->select("product, count(id) as opened")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('status')->ne('closed')
        ->groupBy('product')
        ->fetchPairs();
    $count = $this->dao->select("product, count(id) as count")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->groupBy('product')
        ->fetchPairs();

    foreach ($products as $productID => $product)
    {
        $data = new stdClass();

        $data->date             =  $now;
        $data->product          = $productID;
        $data->createdPerDay    = isset($createdPerDay[$productID])?$createdPerDay[$productID]:0;
        $data->resolvedPerDay   = isset($resolvedPerDay[$productID])?$resolvedPerDay[$productID]:0;
        $data->active           = isset($active[$productID])?$active[$productID]:0;
        $data->resolved         = isset($resolved[$productID])?$resolved[$productID]:0;
        $data->opened           = isset($opened[$productID])?$opened[$productID]:0;
        $data->count            = isset($count[$productID])?$count[$productID]:0;

        $this->dao->insert(TABLE_BUGREPORT)->data($data)->exec();
    }
}/**
 * 获取未完成任务的统计数据
 * 
 * @return void
 */
public function getUndoneTaskCount()
{
    $projects = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetch();
    $undoneStoryTaskCount = $this->dao->select('project, count(id) as undoneStoryCount')->from(TABLE_TASK)->where('deleted')->eq('0')->andWhere('status')->in('wait, doing, pause')->andWhere('type')->in('ra')->andWhere('project')->in($projects->ids)->groupBy('project')->fetchAll('project');
    $undoneDevelTaskCount = $this->dao->select('project, count(id) as undoneDevelCount')->from(TABLE_TASK)->where('deleted')->eq('0')->andWhere('status')->in('wait, doing, pause')->andWhere('type')->in('fos, devel, sdk, web, ios, android')->andWhere('project')->in($projects->ids)->groupBy('project')->fetchAll('project');
    $undoneTestTaskCount = $this->dao->select('project, count(id) as undoneTestCount')->from(TABLE_TASK)->where('deleted')->eq('0')->andWhere('status')->in('wait, doing, pause')->andWhere('type')->in('test')->andWhere('project')->in($projects->ids)->groupBy('project')->fetchAll('project');

    $projects = explode(',', $projects->ids);
    foreach($projects as $project)
    {
        $data = new stdClass();
        $data->project = $project;
        $data->date = date('Y-m-d');
        $data->undoneStoryTaskCount = isset($undoneStoryTaskCount[$project])?$undoneStoryTaskCount[$project]->undoneStoryCount:0;
        $data->undoneDevelTaskCount = isset($undoneDevelTaskCount[$project])?$undoneDevelTaskCount[$project]->undoneDevelCount:0;
        $data->undoneTestTaskCount = isset($undoneTestTaskCount[$project])?$undoneTestTaskCount[$project]->undoneTestCount:0;
        $this->dao->insert(TABLE_UNDONETASKREPORT)->data($data)->exec();
    }
}
//**//
}