<?php
/**
 * Get tasks list of a project.
 *
 * @param  int           $projectID
 * @param  array|string  $moduleIdList
 * @param  string        $status
 * @param  string        $orderBy
 * @param  object        $pager
 * @access public
 * @return array
 */
public function getTasksByModule($projectID = 0, $moduleIdList = 0, $orderBy = 'id_desc', $pager = null)
{
    //增加plan
    $tasks = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t4.title AS plan, t3.realname AS assignedToRealName')
        ->from(TABLE_TASK)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
        ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
        ->leftJoin(TABLE_PRODUCTPLAN)->alias('t4')->on('t2.plan = t4.id')
        ->where('t1.project')->eq((int)$projectID)
        ->beginIF($moduleIdList)->andWhere('t1.module')->in($moduleIdList)->fi()
        ->andWhere('t1.deleted')->eq(0)
        ->orderBy($orderBy)
        ->page($pager)
        ->fetchAll();

    $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'task');

    if($tasks) return $this->processTasks($tasks);
    return array();
}
