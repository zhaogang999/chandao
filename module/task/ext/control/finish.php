<?php
include '../../control.php';
class myTask extends task
{
    /**
     * Finish a task.
     *
     * @param  int    $taskID
     * @access public
     * @return void
     */
    public function finish($taskID)
    {
        $this->commonAction($taskID);

        if(!empty($_POST))
        {
            $this->loadModel('action');
            $changes = $this->task->finish($taskID);
            if(dao::isError()) die(js::error(dao::getError()));
            $files = $this->loadModel('file')->saveUpload('task', $taskID);

            $task = $this->task->getById($taskID);
            if($this->post->comment != '' or !empty($changes))
            {
                $fileAction = !empty($files) ? $this->lang->addFiles . join(',', $files) . "\n" : '';
                $actionID = $this->action->create('task', $taskID, 'Finished', $fileAction . $this->post->comment);
                $this->action->logHistory($actionID, $changes);
                $this->task->sendmail($taskID, $actionID);
            }

            if($this->task->needUpdateBugStatus($task))
            {
                foreach($changes as $change)
                {
                    if($change['field'] == 'status')
                    {
                        $confirmURL = $this->createLink('bug', 'view', "id=$task->fromBug");
                        unset($_GET['onlybody']);
                        $cancelURL  = $this->createLink('task', 'view', "taskID=$taskID");
                        die(js::confirm(sprintf($this->lang->task->remindBug, $task->fromBug), $confirmURL, $cancelURL, 'parent', 'parent.parent'));
                    }
                }
            }
            if(isonlybody()) die(js::closeModal('parent.parent', 'this'));
            die(js::locate($this->createLink('task', 'view', "taskID=$taskID"), 'parent'));
        }

        $this->view->title      = $this->view->project->name . $this->lang->colon .$this->lang->task->finish;
        $this->view->position[] = $this->lang->task->finish;
        $this->view->date       = strftime("%Y-%m-%d %X", strtotime('now'));
        $this->view->users      = $this->loadModel('user')->getPairs('noletter');
        
        //测试类型的任务增加文字模板
        if ($this->view->task->type == 'test')
        {
            $this->view->testTaskComment = $this->lang->task->testTaskComment;
        }

        //1754 增加开发任务关闭成果展示内容
        if ($this->view->task->type == 'fos' || $this->view->task->type == 'devel' || $this->view->task->type == 'sdk' || $this->view->task->type == 'web' || $this->view->task->type == 'ios' || $this->view->task->type == 'android' )
        {
            $this->view->develTaskComment = $this->lang->task->develTaskComment;
        }
        
        $this->display();
    }
}