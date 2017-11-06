<?php
include '../../control.php';
class myReport extends report
{
    /**
     * Edit a script.
     *
     * @param  int    $scriptID
     * @access public
     * @return void
     */
    public function editScript($scriptID)
    {
        if(!empty($_POST))
        {
            $taskID  = $_POST['taskID'];
            $changes = $this->report->updateScript($scriptID);
            if(dao::isError()) die(js::error(dao::getError()));
            //$files = $this->loadModel('file')->saveUpload('build', $buildID);

            if($changes)
            {
                //$fileAction = '';
                //if(!empty($files)) $fileAction = $this->lang->addFiles . join(',', $files) . "\n" ;
                $actionID = $this->loadModel('action')->create('task', $taskID, 'Edited');
                if(!empty($changes)) $this->action->logHistory($actionID, $changes);

                /* send mail.*/
                $this->loadModel('task')->sendmail($taskID, $actionID);
            }

            die(js::locate($this->createLink('report', 'viewScript', "scriptID=$scriptID"), 'parent'));

        }

        $this->app->loadLang('task');
        $script = $this->report->getScriptById((int)$scriptID);

        $this->view->title      = $this->lang->task->edit . $this->lang->task->script . $this->lang->colon . $script->scriptName;
        $this->view->position[] = $this->lang->task->script;
        $this->view->position[] = $this->lang->task->edit;
        $this->view->users      = $this->loadModel('user')->getPairs();
        $this->view->script     = $script;

        $this->display();
    }
}

