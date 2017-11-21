<?php
/**
 * Get tasks of a project.
 *
 * @param int    $projectID
 * @param int    $productID
 * @param string $type
 * @param string $modules
 * @param string $orderBy
 * @param null   $pager
 *
 * @access public
 * @return array|void
 */
public function getProjectTasks($projectID, $productID = 0, $type = 'all', $modules = 0, $orderBy = 'status_asc, id_desc', $pager = null)
{
    if(is_string($type)) $type = strtolower($type);
    //在任务列表页面增加任务关联需求的所属计划字段
    $tasks = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t4.title AS plan, t3.realname AS assignedToRealName')
        ->from(TABLE_TASK)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
        ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
        ->leftJoin(TABLE_PRODUCTPLAN)->alias('t4')->on('t2.plan = t4.id')
        ->where('t1.project')->eq((int)$projectID)
        ->andWhere('t1.deleted')->eq(0)
        ->andWhere('t1.parent')->eq(0)
        ->beginIF($productID)->andWhere('t2.product')->eq((int)$productID)->fi()
        ->beginIF($type == 'undone')->andWhere("(t1.status = 'wait' or t1.status ='doing')")->fi()
        ->beginIF($type == 'needconfirm')->andWhere('t2.version > t1.storyVersion')->andWhere("t2.status = 'active'")->fi()
        ->beginIF($type == 'assignedtome')->andWhere('t1.assignedTo')->eq($this->app->user->account)->fi()
        ->beginIF($type == 'finishedbyme')->andWhere('t1.finishedby')->eq($this->app->user->account)->fi()
        ->beginIF($type == 'delayed')->andWhere('t1.deadline')->gt('1970-1-1')->andWhere('t1.deadline')->lt(date(DT_DATE1))->andWhere('t1.status')->in('wait,doing')->fi()
        ->beginIF(is_array($type) or strpos(',all,undone,needconfirm,assignedtome,delayed,finishedbyme,', ",$type,") === false)->andWhere('t1.status')->in($type)->fi()
        ->beginIF($modules)->andWhere('t1.module')->in($modules)->fi()
        ->orderBy($orderBy)
        ->page($pager)
        ->fetchAll('id');

    $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'task', ($productID or $type == 'needconfirm') ? false : true);

    $taskList = array_keys($tasks);
    if(!empty($taskList))
    {
        $children = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName')
            ->from(TABLE_TASK)->alias('t1')
            ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
            ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
            ->where('t1.parent')->in($taskList)
            ->andWhere('t1.deleted')->eq(0)
            ->orderBy('id_desc')
            ->fetchGroup('parent');
        foreach($children as $key => $child) $tasks[$key]->children = $child;
        $taskTeam = $this->dao->select('*')->from(TABLE_TEAM)->where('task')->in($taskList)->fetchGroup('task');
        foreach($taskTeam as $taskID => $team) $tasks[$taskID]->team = $team;
    }

    if($tasks) return $this->processTasks($tasks);
    return array();
}
