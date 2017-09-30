<?php
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
    $tasks = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t2.plan AS plan, t3.realname AS assignedToRealName')
        ->from(TABLE_TASK)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
        ->leftJoin(TABLE_USER)->alias('t3')->on('t1.assignedTo = t3.account')
        ->where('t1.deleted')->eq(0)
        ->andWhere('t1.id')->in(array_keys($taskIdList))
        ->orderBy($orderBy)
        ->fetchAll();
    $this->loadModel('task')->processTasks($tasks);
    return $tasks;
}