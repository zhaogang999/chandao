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
    //2911 优化需求提测计划、发版计划等内容
    $tasks = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t2.testDate, t3.realname AS assignedToRealName')
        ->from(TABLE_TASK)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
        ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
        ->leftJoin(TABLE_TEAM)->alias('t4')->on('t4.root = t1.id')
        ->leftJoin(TABLE_MODULE)->alias('t5')->on('t1.module = t5.id')
        ->where('t1.project')->eq((int)$projectID)
        ->beginIF($type =='all' || is_array($type))->andWhere('t1.parent')->eq(0)->fi()
        ->beginIF($type == 'myinvolved')
        ->andWhere("((t4.`account` = '{$this->app->user->account}' AND t4.`type` = 'task') OR t1.`assignedTo` = '{$this->app->user->account}' OR t1.`finishedby` = '{$this->app->user->account}')")
        ->fi()
        ->beginIF($productID)->andWhere("((t5.root=" . (int)$productID . " and t5.type='story') OR t2.product=" . (int)$productID . ")")->fi()
        ->beginIF($type == 'undone')->andWhere("(t1.status = 'wait' or t1.status ='doing')")->fi()
        ->beginIF($type == 'needconfirm')->andWhere('t2.version > t1.storyVersion')->andWhere("t2.status = 'active'")->fi()
        ->beginIF($type == 'assignedtome')->andWhere('t1.assignedTo')->eq($this->app->user->account)->fi()
        ->beginIF($type == 'finishedbyme')->andWhere('t1.finishedby')->eq($this->app->user->account)->fi()
        ->beginIF($type == 'delayed')->andWhere('t1.deadline')->gt('1970-1-1')->andWhere('t1.deadline')->lt(date(DT_DATE1))->andWhere('t1.status')->in('wait,doing')->fi()
        ->beginIF(is_array($type) or strpos(',all,undone,needconfirm,assignedtome,delayed,finishedbyme,myinvolved,', ",$type,") === false)->andWhere('t1.status')->in($type)->fi()
        ->beginIF($modules)->andWhere('t1.module')->in($modules)->fi()
        ->andWhere('t1.deleted')->eq(0)
        ->orderBy('t1.`parent`,' . $orderBy)
        ->page($pager, 't1.id')
        ->fetchAll('id');

    $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'task', ($productID or in_array($type, array('myinvolved', 'needconfirm'))) ? false : true);

    if(empty($tasks)) return array();

    $taskList = array_keys($tasks);
    $taskTeam = $this->dao->select('*')->from(TABLE_TEAM)->where('root')->in($taskList)->andWhere('type')->eq('task')->fetchGroup('root');
    if(!empty($taskTeam))
    {
        foreach($taskTeam as $taskID => $team) $tasks[$taskID]->team = $team;
    }

    /* Select children task. */
    //2911 优化需求提测计划、发版计划等内容
    $children = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t2.testDate, t3.realname AS assignedToRealName')
        ->from(TABLE_TASK)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
        ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
        ->leftJoin(TABLE_MODULE)->alias('t4')->on('t1.module = t4.id')
        ->where('t1.project')->eq((int)$projectID)
        ->andWhere('t1.parent')->in($taskList)
        ->andWhere('t1.deleted')->eq(0)
        ->beginIF($productID)->andWhere("((t4.root=" . (int)$productID . " and t4.type='story') OR t2.product=" . (int)$productID . ")")->fi()
        ->beginIF($type == 'undone')->andWhere("(t1.status = 'wait' or t1.status ='doing')")->fi()
        ->beginIF($type == 'needconfirm')->andWhere('t2.version > t1.storyVersion')->andWhere("t2.status = 'active'")->fi()
        ->beginIF($type == 'assignedtome')->andWhere('t1.assignedTo')->eq($this->app->user->account)->fi()
        ->beginIF($type == 'finishedbyme')->andWhere('t1.finishedby')->eq($this->app->user->account)->fi()
        ->beginIF($type == 'delayed')->andWhere('t1.deadline')->gt('1970-1-1')->andWhere('t1.deadline')->lt(date(DT_DATE1))->andWhere('t1.status')->in('wait,doing')->fi()
        ->beginIF(is_array($type) or strpos(',all,undone,needconfirm,assignedtome,delayed,finishedbyme,myinvolved,', ",$type,") === false)->andWhere('t1.status')->in($type)->fi()
        ->beginIF($modules)->andWhere('t1.module')->in($modules)->fi()
        ->orderBy('t1.`id`,' . $orderBy)
        ->fetchAll('id');

    if(!empty($children))
    {
        foreach($children as $child)
        {
            $tasks[$child->parent]->children[] = $child;
        }
    }

    return $this->processTasks($tasks);
}
