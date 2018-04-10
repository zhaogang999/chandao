<?php
/**
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