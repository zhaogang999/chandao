<?php
/**
 * The control file of issue module of ZenTaoPMS
 */
class issue extends control
{
    public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);
        /* Load need modules. */
        $this->loadModel('issue');
    }

    /**
     * The index page, locate to browse.
     *
     * @access public
     * @return void
     */
    public function index()
    {
        $this->locate($this->createLink('issue', 'browse'));
    }

    /**
     * issue list
     *
     * @param string $type
     * @param int $param
     * @param string $orderBy
     * @param int $recTotal
     * @param int $recPerPage
     * @param int $pageID
     */
    public function browse($type = 'byModule', $param = 0, $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $queryID   = ($type == 'bySearch')  ? (int)$param : 0;

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        /* Build the search form. */
        $actionURL    = $this->createLink('issue', 'browse', "type=bySearch&param=myQueryID");
        $this->issue->buildIssueSearchForm($actionURL, $queryID);

        /* Set view. */
        $this->view->position[]   = $this->lang->issue->issue;
        $this->view->title        = $this->lang->issue->issue;
        $this->view->issues   = $this->issue->getIssues($sort, $type, $queryID, $pager);
        $this->view->users    = $this->loadModel('user')->getPairs('noletter');
        $this->view->type     = $type;
        $this->view->pager    = $pager;
        $this->view->orderBy  = $orderBy;
        $this->view->param    = $param;

        $this->display();
    }

    /**
     * 创建问题流出表
     *
     * @param $fromBug
     * @access public
     * @return void
     */
    public function create($fromBug = 0)
    {
        if(!empty($_POST))
        {
            $issueID = $this->issue->create($fromBug);
            if(dao::isError()) die(js::error(dao::getError()));

            $action   = $fromBug == 0 ? 'Opened' : 'toissue';
            $extra    = $fromBug == 0 ? '' : $fromBug;
            $actionID = $this->loadModel('action')->create('issue', $issueID, $action, '', $extra);
            $this->issue->sendmail($issueID, $actionID);
            die(js::locate($this->createLink('issue', 'browse'), 'parent'));
        }

        /* Load these models. */
        $this->loadModel('user');
        $this->loadModel('bug');

        $this->view->fromBug    = $fromBug;
        $this->view->title      = $this->lang->issue->create;
        $this->view->position[] = $this->lang->issue->create;
        $this->view->bugs       = $this->bug->getProductBugsPairs(0, 'active,resolved', true);
        $this->view->users      = $this->user->getPairs('nodeleted|noclosed');
        $this->display();
    }

    /**
     * edit a issue
     * 
     * @param $issueID
     * @access public
     * @return void
     */
    public function edit($issueID)
    {
        if(!empty($_POST))
        {
            $changes = $this->issue->update($issueID);
            if(dao::isError()) die(js::error(dao::getError()));
            $files = $this->loadModel('file')->saveUpload('build', $issueID);

            if($this->post->comment != '' or !empty($changes) or !empty($files))
            {
                $action = !empty($changes) ? 'Edited' : 'Commented';
                $actionID = $this->loadModel('action')->create('issue', $issueID, $action, $this->post->comment);
                $this->action->logHistory($actionID, $changes);
                /* send mail.*/
                $this->issue->sendmail($issueID, $actionID);

                die(js::locate($this->createLink('issue', 'view', "buildID=$issueID"), 'parent'));
            }
        }
        /* Load these models. */
        $this->loadModel('user');
        $this->loadModel('bug');

        $bugs = $this->bug->getProductBugsPairs(0, 'active,resolved', true);
        $issue = $this->issue->getById((int)$issueID);
        if ($issue->fromBug != 0)
        {
            $fromBug = $this->dao->select('id,title')->from(TABLE_BUG)->where('toIssue')->eq($issueID)->fetchPairs();
            $fromBug[$issue->fromBug] = $issue->fromBug . ':' . $fromBug[$issue->fromBug];
            $bugs = $fromBug + $bugs;
        }
        $this->view->title      = $this->lang->issue->edit;
        $this->view->position[] = $this->lang->issue->edit;
        $this->view->issue      = $issue;
        $this->view->bugs       = $bugs;
        $this->view->users      = $this->user->getPairs('nodeleted|noclosed');
        $this->display();
    }

    /**
     * View a issue.
     *
     * @param  int    $issueID
     * @access public
     * @return void
     */
    public function view($issueID)
    {
        /* Load these models. */
        $this->loadModel('user');
        
        $issue = $this->issue->getById((int)$issueID);
        $fromBug = $this->dao->select('id,title')->from(TABLE_BUG)->where('toIssue')->eq($issueID)->fetch();
        if(!$issue) die(js::error($this->lang->notFound) . js::locate('back'));
        
        $this->view->title      = $this->lang->issue->view;
        $this->view->position[] = $this->lang->issue->view;
        $this->view->issue      = $this->issue->getById($issueID);
        $this->view->users      = $this->user->getPairs('nodeleted|noclosed');
        $this->view->issue      = $issue;
        $this->view->fromBug    = $fromBug;
        $this->view->actions    = $this->loadModel('action')->getList('issue', $issueID);

        $this->display();
    }

    /**
     * Delete a issue.
     *
     * @param  int    $issueID
     * @param  string $confirm  yes|noe
     * @access public
     * @return void
     */
    public function delete($issueID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->issue->confirmDelete, $this->createLink('issue', 'delete', "$issueID=$issueID&confirm=yes")));
        }
        else
        {
            $issue = $this->issue->getById($issueID);
            $this->issue->delete(TABLE_ISSUE, $issueID);

            /* if ajax request, send result. */
            if($this->server->ajax)
            {
                if(dao::isError())
                {
                    $response['result']  = 'fail';
                    $response['message'] = dao::getError();
                }
                else
                {
                    $response['result']  = 'success';
                    $response['message'] = '';
                }
                $this->send($response);
            }

            die(js::locate($this->createLink('issue', 'browse'), 'parent'));
        }
    }
}