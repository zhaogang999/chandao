<?php
global $app;
helper::cd($app->getBasePath());
helper::import('.\module\project\model.php');
helper::cd();
class extprojectModel extends projectModel 
{
/**
 * Build bug search form.
 *
 * @param  int    $products
 * @param  int    $queryID
 * @param  int    $actionURL
 * @access public
 * @return void
 */
public function buildBugSearchForm($products, $queryID, $actionURL)
{
    $modules = array();
    $builds  = array('' => '', 'trunk' => $this->lang->trunk);
    foreach($products as $product)
    {
        $productModules = $this->loadModel('tree')->getOptionMenu($product->id);
        $productBuilds  = $this->loadModel('build')->getProductBuildPairs($product->id, 0, $params = 'noempty|notrunk');
        foreach($productModules as $moduleID => $moduleName)
        {
            $modules[$moduleID] = ((count($products) >= 2 and $moduleID) ? $product->name : '') . $moduleName;
        }
        foreach($productBuilds as $buildID => $buildName)
        {
            $builds[$buildID] = ((count($products) >= 2 and $buildID) ? $product->name . '/' : '') . $buildName;
        }
    }

    $branchGroups = $this->loadModel('branch')->getByProducts(array_keys($products), 'noempty');
    $branchPairs  = array();
    $productType  = 'normal';
    $productNum   = count($products);
    $productPairs = array(0 => '');
    foreach($products as $product)
    {
        $productPairs[$product->id] = $product->name;
        if($product->type != 'normal')
        {
            $productType = $product->type;
            if($product->branch)
            {
                $branchPairs[$product->branch] = (count($products) > 1 ? $product->name . '/' : '') . $branchGroups[$product->id][$product->branch];
            }
            else
            {
                $productBranches = isset($branchGroups[$product->id]) ? $branchGroups[$product->id] : array(0);
                if(count($products) > 1)
                {
                    foreach($productBranches as $branchID => $branchName) $productBranches[$branchID] = $product->name . '/' . $branchName;
                }
                $branchPairs += $productBranches;
            }
        }
    }

    $this->config->bug->search['module']    = 'projectBug';
    $this->config->bug->search['actionURL'] = $actionURL;
    $this->config->bug->search['queryID']   = $queryID;
    unset($this->config->bug->search['fields']['project']);
    $this->config->bug->search['params']['product']['values']       = $productPairs + array('all' => $this->lang->product->allProductsOfProject);
    $this->config->bug->search['params']['plan']['values']          = $this->loadModel('productplan')->getForProducts($products);
    //优化搜索功能增加空选项；
    $this->config->bug->search['params']['module']['values']        = array('' => '') + $modules;

    $this->config->bug->search['params']['openedBuild']['values']   = $builds;
    $this->config->bug->search['params']['resolvedBuild']['values'] = $this->config->bug->search['params']['openedBuild']['values'];
    if($productType == 'normal')
    {
        unset($this->config->bug->search['fields']['branch']);
        unset($this->config->bug->search['params']['branch']);
    }
    else
    {
        $this->config->bug->search['fields']['branch']           = sprintf($this->lang->product->branch, $this->lang->product->branchName[$productType]);
        $this->config->bug->search['params']['branch']['values'] = array('' => '') + $branchPairs;
    }
    $this->config->bug->search['params']['status'] = array('operator' => '=', 'control' => 'select', 'values' => $this->lang->bug->statusList);

    $this->loadModel('search')->setSearchParams($this->config->bug->search);
}
/**
 * Build story search form.
 *
 * @param  array  $products
 * @param  array  $branchGroups
 * @param  array  $modules
 * @param  int    $queryID
 * @param  string $actionURL
 * @param  string $type
 * @access public
 * @return void
 */
public function buildStorySearchForm($products, $branchGroups, $modules, $queryID, $actionURL, $type = 'projectStory')
{
    $branchPairs  = array();
    $productType  = 'normal';
    $productNum   = count($products);
    $productPairs = array(0 => '');
    foreach($products as $product)
    {
        $productPairs[$product->id] = $product->name;
        if($product->type != 'normal')
        {
            $productType = $product->type;
            if($product->branch)
            {
                $branchPairs[$product->branch] = (count($products) > 1 ? $product->name . '/' : '') . $branchGroups[$product->id][$product->branch];
            }
            else
            {
                $productBranches = isset($branchGroups[$product->id]) ? $branchGroups[$product->id] : array(0);
                if(count($products) > 1)
                {
                    foreach($productBranches as $branchID => $branchName) $productBranches[$branchID] = $product->name . '/' . $branchName;
                }
                $branchPairs += $productBranches;
            }
        }
    }

    /* Build search form. */
    if($type == 'projectStory')
    {
        $this->config->product->search['module'] = 'projectStory';
        unset($this->config->product->search['fields']['stage']);
        unset($this->config->product->search['params']['stage']);
    }
    $this->config->product->search['actionURL'] = $actionURL;
    $this->config->product->search['queryID']   = $queryID;
    $this->config->product->search['params']['product']['values'] = $productPairs + array('all' => $this->lang->product->allProductsOfProject);
    $this->config->product->search['params']['plan']['values'] = $this->loadModel('productplan')->getForProducts($products);
    //优化搜索功能增加空选项；
    $this->config->product->search['params']['module']['values'] = array(''=>'') + $modules;

    unset($this->lang->story->statusList['draft']);
    if($productType == 'normal')
    {
        unset($this->config->product->search['fields']['branch']);
        unset($this->config->product->search['params']['branch']);
    }
    else
    {
        $this->config->product->search['fields']['branch'] = sprintf($this->lang->product->branch, $this->lang->product->branchName[$productType]);
        $this->config->product->search['params']['branch']['values'] = array('' => '') + $branchPairs;
    }
    $this->config->product->search['params']['status'] = array('operator' => '=', 'control' => 'select', 'values' => $this->lang->story->statusList);

    $this->loadModel('search')->setSearchParams($this->config->product->search);
}
/**
 * Build task search form.
 *
 * @param  int    $projectID
 * @param  array  $projects
 * @param  int    $queryID
 * @param  string $actionURL
 * @access public
 * @return void
 */
public function buildTaskSearchForm($projectID, $projects, $queryID, $actionURL)
{
    $this->config->project->search['actionURL'] = $actionURL;
    $this->config->project->search['queryID']   = $queryID;
    //搜索框实现多项目下任务的搜索16-20
    //$this->config->project->search['params']['project']['values'] = array(''=>'', $projectID => $projects[$projectID], 'all' => $this->lang->project->allProject);
    $this->config->project->search['params']['project']['values'] = array(''=>'', 'all' => $this->lang->project->allProject);
    $this->config->project->search['params']['project']['values'] = $this->config->project->search['params']['project']['values'] +  $projects;
//优化搜索功能增加空选项；
    $this->config->project->search['params']['module']['values']  = array('' => '') + $this->loadModel('tree')->getTaskOptionMenu($projectID, $startModuleID = 0);

    $this->loadModel('search')->setSearchParams($this->config->project->search);
}
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/9/26
 * Time: 12:44
 */
/**
 * Get taskes by search.
 *
 * @param  string $condition
 * @param  object $pager
 * @param  string $orderBy
 * @access public
 * @return array
 */
public function getSearchTasks($condition, $pager, $orderBy)
{
    $taskIdList = $this->dao->select('id')
        ->from(TABLE_TASK)
        ->where($condition)
        ->andWhere('deleted')->eq(0)
        ->orderBy($orderBy)
        ->page($pager)
        ->fetchAll('id');

    //增加plan
    $tasks = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t4.title AS plan, t3.realname AS assignedToRealName')
        ->from(TABLE_TASK)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
        ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
        ->leftJoin(TABLE_PRODUCTPLAN)->alias('t4')->on('t2.plan = t4.id')
        ->where('t1.deleted')->eq(0)
        ->andWhere('t1.id')->in(array_keys($taskIdList))
        ->orderBy($orderBy)
        ->fetchAll();
    $this->loadModel('task')->processTasks($tasks);
    return $tasks;
}
//**//
}