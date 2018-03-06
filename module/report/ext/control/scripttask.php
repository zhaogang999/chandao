<?php
include '../../control.php';
class myReport extends report
{
    /**
     * 脚本文档列表页
     *
     * @param string $type
     * @param string $orderBy
     * @param int $param
     * @param int $recTotal
     * @param int $recPerPage
     * @param int $pageID
     */
    public function scriptTask($type = 'byModule', $param = 0, $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->app->loadLang('task');

        $this->session->set('scriptTaskList', $this->app->getURI(true));
        $queryID   = ($type == 'bySearch')  ? (int)$param : 0;

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);
        
        $this->view->position[] = $this->lang->task->script;
        $this->view->scriptTasks = $this->report->getScriptTask($sort, $type, $queryID, $pager);
        $actionURL    = $this->createLink('report', 'scriptTask', "type=bySearch&param=myQueryID");
        $projects = $this->loadModel('project')->getPairs('nocode');

        $this->report->buildReportSearchForm($projects, $actionURL, $queryID);
        /* Header and position. */
        $this->view->title      = $this->lang->task->script;
        $this->view->users      = $this->loadModel('user')->getPairs('noletter');
        $this->view->type       = $type;
        $this->view->pager      = $pager;
        $this->view->orderBy    = $orderBy;
        $this->view->param      = $param;

        $this->display();
    }
}