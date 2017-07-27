<?php
/**
 * Get task info by Id.修改bug：任务详情页的相关用例；当用例已被删除时；但这条用例还显示。待官方修复后删除
 *
 * @param  int    $taskID
 * @param  bool   $setImgSize
 * @access public
 * @return object|bool
 */
public function getById($taskID, $setImgSize = false)
{
    $task = $this->dao->select('t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName')
        ->from(TABLE_TASK)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')
        ->on('t1.story = t2.id')
        ->leftJoin(TABLE_USER)->alias('t3')
        ->on('t1.assignedTo = t3.account')
        ->where('t1.id')->eq((int)$taskID)
        ->fetch();
    if(!$task) return false;
    if($setImgSize) $task->desc = $this->loadModel('file')->setImgSize($task->desc);
    if($task->assignedTo == 'closed') $task->assignedToRealName = 'Closed';
    foreach($task as $key => $value) if(strpos($key, 'Date') !== false and !(int)substr($value, 0, 4)) $task->$key = '';
    $task->files = $this->loadModel('file')->getByObject('task', $taskID);

    /* Get related test cases. */
    if($task->story) $task->cases = $this->dao->select('id, title')->from(TABLE_CASE)->where('story')->eq($task->story)->andWhere('storyVersion')->eq($task->storyVersion)->andWhere('deleted')->eq('0')->fetchPairs();

    return $this->processTask($task);
}
