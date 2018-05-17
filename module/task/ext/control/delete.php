<?php
include '../../control.php';
class myTask extends task
{
    /**
     * Delete a task.
     *
     * @param  int $projectID
     * @param  int $taskID
     * @param  string $confirm yes|no
     * @access public
     * @return void
     */
    public function delete($projectID, $taskID, $confirm = 'no')
    {
        $task = $this->task->getById($taskID);
        if ($confirm == 'no') {
            die(js::confirm($this->lang->task->confirmDelete, inlink('delete', "projectID=$projectID&taskID=$taskID&confirm=yes")));
        } else {
            $this->task->delete(TABLE_TASK, $taskID);
            //脚本任务
            if ($task->type = 'script') {
                $script = $this->dao->select('*')->from(TABLE_SCRIPT)->where('task')->eq($taskID)->andWhere('deleted')->eq('0')->fetch();
                $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(1)->where('id')->eq($script->id)->exec();
            }

            if ($task->parent) $this->task->updateParentStatus($task->id);
            if ($task->fromBug != 0) $this->dao->update(TABLE_BUG)->set('toTask')->eq(0)->where('id')->eq($task->fromBug)->exec();
            if ($task->story) $this->loadModel('story')->setStage($task->story);
            if (!empty($task->children)) {
                foreach ($task->children as $childTask) {
                    $this->task->delete(TABLE_TASK, $childTask->id);
                    //脚本任务
                    if ($childTask->type = 'script') {
                        $script = $this->dao->select('*')->from(TABLE_SCRIPT)->where('task')->eq($childTask->id)->andWhere('deleted')->eq('0')->fetch();
                        $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(1)->where('id')->eq($script->id)->exec();
                    }

                    if ($childTask->story) $this->loadModel('story')->setStage($childTask->story);
                }
            }

            die(js::locate($this->session->taskList, 'parent'));
        }
    }
}