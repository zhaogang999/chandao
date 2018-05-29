<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\project\model.php');
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
}/**
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
                if(!isset($branchGroups[$product->id][$product->branch])) continue;
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
        //unset($this->config->product->search['fields']['stage']);
        //unset($this->config->product->search['params']['stage']);
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
}/**
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
}/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     project 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function createRelationOfTasks($projectID)
{
    $this->loadExtension('gantt')->createRelationOfTasks($projectID);
}

public function editRelationOfTasks($projectID)
{
    $this->loadExtension('gantt')->editRelationOfTasks($projectID);
}

public function getRelationsOfTasks($projectID)
{
    return $this->loadExtension('gantt')->getRelationsOfTasks($projectID);
}

public function getDataForGantt($projectID, $type)
{
    return $this->loadExtension('gantt')->getDataForGantt($projectID, $type);
}

public function deleteRelation($id)
{
    $this->loadExtension('gantt')->deleteRelation($id);
}/**
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
    //3669 实现任务可以通过提测计划字段进行筛选或排序
    if (strstr($orderBy, 'testDate'))
    {
        $orderBy = 't2.' . $orderBy;
    }
    else
    {
        $orderBy = 't1.' . $orderBy;
    }

    $condition = str_replace('deleted' , 't1.deleted', $condition);
    $condition = preg_replace('/`(\w+)`/', 't1.`$1`', $condition);
    $condition = str_replace(array('t1.`testDate`'), array('t2.`testDate`'), $condition);

    $taskIdList = $this->dao->select('t1.id')
        ->from(TABLE_TASK)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
        ->where($condition)
        ->andWhere('t1.deleted')->eq(0)
        ->orderBy($orderBy)
        ->page($pager)
        ->fetchAll('id');

    //2911 优化需求提测计划、发版计划等内容
    $tasks = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t2.testDate, t3.realname AS assignedToRealName')
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
}/**
 * Unlink story.
 *
 * @param  int    $projectID
 * @param  int    $storyID
 * @access public
 * @return void
 */
public function unlinkStory($projectID, $storyID)
{
    $this->dao->delete()->from(TABLE_PROJECTSTORY)->where('project')->eq($projectID)->andWhere('story')->eq($storyID)->limit(1)->exec();

    $order  = 1;
    $storys = $this->dao->select('*')->from(TABLE_PROJECTSTORY)->where('project')->eq($projectID)->orderBy('order')->fetchAll();
    foreach($storys as $projectstory)
    {
        if($projectstory->order != $order) $this->dao->update(TABLE_PROJECTSTORY)->set('`order`')->eq($order)->where('project')->eq($projectID)->andWhere('story')->eq($projectstory->story)->exec();
        $order++;
    }

    $this->loadModel('story')->setStage($storyID);
    $this->loadModel('action')->create('story', $storyID, 'unlinkedfromproject', '', $projectID);

    $tasks = $this->dao->select('id')->from(TABLE_TASK)->where('story')->eq($storyID)->andWhere('project')->eq($projectID)->andWhere('status')->in('wait,doing')->fetchPairs('id');
    $this->dao->update(TABLE_TASK)->set('status')->eq('cancel')->where('id')->in($tasks)->exec();
    foreach($tasks as $taskID)
    {
        $changes  = $this->loadModel('task')->cancel($taskID);
        //10588 由于需求取消而导致的任务取消，是否可以在任务履历中增加需求取消的字样
        $actionID = $this->action->create('task', $taskID, 'Canceled',  $this->lang->project->storyCancel);
        $this->action->logHistory($actionID, $changes);
    }
}
//**//
}