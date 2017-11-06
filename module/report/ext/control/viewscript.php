<?php
include '../../control.php';
class myReport extends report
{
    /**
     * View a scriptTask.
     *
     * @param  int    $scriptID
     * @access public
     * @return void
     */
    public function viewScript($scriptID)
    {
        $this->app->loadLang('task');

        $script = $this->report->getScriptById((int)$scriptID);
        if(!$script) die(js::error($this->lang->notFound) . js::locate('back'));

        $this->lang->scripttask->menu      = $this->lang->report->menu;
        $this->lang->menugroup->scripttask = 'report';
        $this->view->position[]    = $this->lang->task->script;
        $this->view->title         = "脚本 #$script->id $script->scriptName";

        /* Assign. */
        $this->view->users         = $this->loadModel('user')->getPairs('noletter');
        $this->view->script        = $script;
        $this->view->actions       = $this->loadModel('action')->getList('task', $script->task);

        $this->display();
    }
}