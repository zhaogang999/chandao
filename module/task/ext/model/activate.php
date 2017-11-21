<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/11/2
 * Time: 10:02
 */
/**
 * Activate a task.
 *
 * @param  int      $taskID
 * @access public
 * @return void
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
        ->remove('comment')
        ->get();

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

    $this->computeWorkingHours($oldTask->parent);

    $this->dao->update(TABLE_TASK)->set('status')->eq('doing')->where('parent')->eq($taskID)->exec();
    if($oldTask->parent) $this->dao->update(TABLE_TASK)->set('status')->eq('doing')->where('id')->eq((int)$oldTask->parent)->exec();

    if($oldTask->story) $this->loadModel('story')->setStage($oldTask->story);
    if(!dao::isError()) return common::createChanges($oldTask, $task);
}