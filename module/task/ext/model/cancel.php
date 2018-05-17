<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/11/2
 * Time: 9:57
 */
/**
 * Cancel a task.
 *
 * @param int $taskID
 *
 * @access public
 * @return array
 */
public function cancel($taskID)
{
    $oldTask = $this->getById($taskID);
    $now     = helper::now();
    $task = fixer::input('post')
        ->setDefault('status', 'cancel')
        ->setDefault('assignedTo', $oldTask->openedBy)
        ->setDefault('assignedDate', $now)
        ->setDefault('finishedBy', '')
        ->setDefault('finishedDate', '0000-00-00')
        ->setDefault('canceledBy, lastEditedBy', $this->app->user->account)
        ->setDefault('canceledDate, lastEditedDate', $now)
        ->remove('comment')
        ->get();

    $this->dao->update(TABLE_TASK)->data($task)->autoCheck()->where('id')->eq((int)$taskID)->exec();

    if ($oldTask->type == 'script')
    {
        $script = $this->dao->select('*')->from(TABLE_SCRIPT)->where('task')->eq($taskID)->andWhere('deleted')->eq('0')->fetch();
        $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(1)->where('id')->eq($script->id)->exec();
    }
    
    if($oldTask->parent) $this->updateParentStatus($taskID);
    if($oldTask->story)  $this->loadModel('story')->setStage($oldTask->story);
    if(!dao::isError()) return common::createChanges($oldTask, $task);
}