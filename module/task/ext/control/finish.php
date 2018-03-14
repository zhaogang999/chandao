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

        if ($this->view->task->status == 'wait' || $this->view->task->status == 'pause')
        {
           die($this->lang->task->error->undoingError);
        }
        
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

        $task    = $this->view->task;
        $members = $this->loadModel('user')->getPairs('noletter');

        if(!empty($task->team))
        {
            $task->openedBy   = $this->task->getNextUser(array_keys($task->team), $task->assignedTo);
            $members          = $this->task->getMemberPairs($task);
            $task->myConsumed = $this->dao->select('consumed')->from(TABLE_TEAM)->where('task')->eq($taskID)->andWhere('account')->eq($task->assignedTo)->fetch('consumed');
        }

        $this->view->title      = $this->view->project->name . $this->lang->colon .$this->lang->task->finish;
        $this->view->position[] = $this->lang->task->finish;
        $this->view->members    = $members;
        
        //测试类型的任务增加文字模板
        if ($this->view->task->type == 'test')
        {
            $this->view->testTaskComment = $this->lang->task->testTaskComment;

            //获取需求下脚本类型的任务的脚本文档信息
            if ($task->story != 0)
            {
                $scriptTasks = $this->dao->select('t1.id, t1.name ,t2.tester, t2.AT')->from(TABLE_TASK)->alias('t1')->leftJoin(TABLE_SCRIPT)->alias('t2')->on('t1.id = t2.task')->where('t1.type')->eq('script')->andWhere('t1.story')->eq($task->story)->andWhere('t1.deleted')->eq('0')->andWhere('t1.status')->ne('cancel')->fetchAll('id');
                if (!empty($scriptTasks)) $this->view->scriptTasks = $scriptTasks;
            }
        }

        //1754 增加开发任务关闭成果展示内容
        if ($this->view->task->type == 'fos' || $this->view->task->type == 'devel' || $this->view->task->type == 'sdk' || $this->view->task->type == 'web' || $this->view->task->type == 'ios' || $this->view->task->type == 'android' )
        {
            $this->view->develTaskComment = $this->lang->task->develTaskComment;
        }

        //需求类型的任务增加文字模板
        if ($this->view->task->type == 'ra')
        {
            $this->view->storyTaskComment = $this->lang->task->storyTaskComment;
        }

        if ($this->view->task->type == 'script')
        {
            $this->view->script = $this->dao->select('*')
                ->from(TABLE_SCRIPT)
                ->where('task')->eq($taskID)
                ->fetch();
        }
        
        $this->display();
    }
}