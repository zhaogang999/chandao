<?php
/**
 * Activate a task.
 *
 * @param int $taskID
 *
 * @access public
 * @return array
 */
public function activate($taskID)
{
    if(strpos($this->config->task->activate->requiredFields, 'comment') !== false and !$this->post->comment)
    {
        dao::$errors[] = sprintf($this->lang->error->notempty, $this->lang->comment);
        return false;
    }

    $oldTask = $this->getById($taskID);
    $task = fixer::input('post')
        ->setDefault('left', 0)
        ->setDefault('status', 'doing')
        ->setDefault('finishedBy, canceledBy, closedBy, closedReason', '')
        ->setDefault('finishedDate, canceledDate, closedDate', '0000-00-00')
        ->setDefault('lastEditedBy',   $this->app->user->account)
        ->setDefault('lastEditedDate', helper::now())
        ->setDefault('assignedDate', helper::now())
        ->remove('comment')
        ->get();

    if(!empty($oldTask->team))
    {
        $this->dao->update(TABLE_TEAM)->set('left')->eq($this->post->left)
            ->where('root')->eq($taskID)
            ->andWhere('type')->eq('task')
            ->andWhere('account')->eq($this->post->assignedTo)
            ->exec();

        $task = $this->computeHours4Multiple($oldTask, $task);
    }

    $this->dao->update(TABLE_TASK)->data($task)
        ->autoCheck()
        ->batchCheck($this->config->task->activate->requiredFields, 'notempty')
        ->where('id')->eq((int)$taskID)
        ->exec();

    if ($oldTask->type == 'script')
    {
        $script = $this->dao->select('*')->from(TABLE_SCRIPT)->where('task')->eq($taskID)->andWhere('deleted')->eq('0')->fetch();
        $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(0)->where('id')->eq($script->id)->exec();
    }

    if($oldTask->parent) $this->updateParentStatus($taskID);
    if($oldTask->story)  $this->loadModel('story')->setStage($oldTask->story);
    if(!dao::isError()) return common::createChanges($oldTask, $task);
}
