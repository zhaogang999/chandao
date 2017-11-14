<?php
include '../../control.php';
class myReport extends report
{
    /**
     * 脚本文档列表页
     *
     * @param string $type
     * @param string $orderBy
     * @param int $recTotal
     * @param int $recPerPage
     * @param int $pageID
     */
    public function scriptTask($type = 'byModule', $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->app->loadLang('task');

        $this->session->set('scriptTaskList', $this->app->getURI(true));

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);
        
        $this->view->position[] = $this->lang->task->script;
        $this->view->scriptTasks = $this->report->getScriptTask($sort, $type, $pager);
        $actionURL    = $this->createLink('report', 'scriptTask', "type=bySearch");

        $this->report->buildReportSearchForm($actionURL);
        /* Header and position. */
        $this->view->title      = $this->lang->task->script;
        $this->view->users      = $this->loadModel('user')->getPairs('noletter');
        $this->view->type       = $type;
        $this->view->pager      = $pager;
        $this->view->orderBy    = $orderBy;

        $this->display();
    }
}