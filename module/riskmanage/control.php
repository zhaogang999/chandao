<?php

/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/3/1
 * Time: 15:16
 */
class riskmanage extends control
{
    public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);
        /* Load need modules. */
        $this->loadModel('riskmanage');
    }
    /**
     * The index page, locate to browse.
     *
     * @access public
     * @return void
     */
    public function index()
    {
        $this->locate($this->createLink('riskmanage', 'browse'));
    }

    /**
     * riskManage list
     *
     * @param $status string
     * @param string $type
     * @param int $param
     * @param string $orderBy
     * @param int $recTotal
     * @param int $recPerPage
     * @param int $pageID
     */
    public function browse($status = 'unclosed', $type = 'byModule', $param = 0, $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $queryID   = ($type == 'bySearch')  ? (int)$param : 0;

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        /* Build the search form. */
        $actionURL    = $this->createLink('riskmanage', 'browse', "status=$status&type=bySearch&param=myQueryID");
        $this->riskmanage->buildRiskManageSearchForm($actionURL, $queryID);

        /* Set view. */
        $this->view->position[]   = $this->lang->riskmanage->common;
        $this->view->title        = $this->lang->riskmanage->common;
        $this->view->riskManages   = $this->riskmanage->getRiskManages($status, $sort, $type, $queryID, $pager);
        $this->view->users    = $this->loadModel('user')->getPairs('noletter');
        $this->view->type     = $type;
        $this->view->pager    = $pager;
        $this->view->orderBy  = $orderBy;
        $this->view->param    = $param;
        $this->view->status   = $status;

        $this->display();
    }

    /**
     * 创建问题流出表
     *
     * @access public
     * @return void
     */
    public function create()
    {
        if(!empty($_POST))
        {
            $riskManageID = $this->riskmanage->create();
            if(dao::isError()) die(js::error(dao::getError()));

            $action   =  'Opened';
            $actionID = $this->loadModel('action')->create('riskmanage', $riskManageID, $action);
            $this->riskmanage->sendmail($riskManageID, $actionID);
            die(js::locate($this->createLink('riskmanage', 'browse'), 'parent'));
        }

        /* Load these models. */
        $this->loadModel('user');
        
        $this->view->title      = $this->lang->riskmanage->create;
        $this->view->position[] = $this->lang->riskmanage->create;
        $this->view->users      = $this->user->getPairs('nodeleted|noclosed');
        $this->display();
    }

    /**
     * edit a riskmanage
     *
     * @param $riskManageID
     * @access public
     * @return void
     */
    public function edit($riskManageID)
    {
        if(!empty($_POST))
        {
            $changes = $this->riskmanage->update($riskManageID);
            if(dao::isError()) die(js::error(dao::getError()));
            $files = $this->loadModel('file')->saveUpload('build', $riskManageID);

            if($this->post->comment != '' or !empty($changes) or !empty($files))
            {
                $action = !empty($changes) ? 'Edited' : 'Commented';
                $actionID = $this->loadModel('action')->create('riskmanage', $riskManageID, $action, $this->post->comment);
                $this->action->logHistory($actionID, $changes);
                /* send mail.*/
                $this->riskmanage->sendmail($riskManageID, $actionID);

                die(js::locate($this->createLink('riskmanage', 'view', "buildID=$riskManageID"), 'parent'));
            }
        }
        /* Load these models. */
        $this->loadModel('user');
        
        $riskManage = $this->riskmanage->getById((int)$riskManageID);
        $this->view->title      = $this->lang->riskmanage->edit;
        $this->view->position[] = $this->lang->riskmanage->edit;
        $this->view->riskManage      = $riskManage;
        $this->view->users      = $this->user->getPairs('nodeleted|noclosed');
        $this->display();
    }

    /**
     * View a riskManage.
     *
     * @param  int    $riskManageID
     * @access public
     * @return void
     */
    public function view($riskManageID)
    {
        /* Load these models. */
        $this->loadModel('user');

        $riskManage = $this->riskmanage->getById((int)$riskManageID);
        
        if(!$riskManage) die(js::error($this->lang->notFound) . js::locate('back'));

        $this->view->title      = $this->lang->riskmanage->view;
        $this->view->position[] = $this->lang->riskmanage->view;
        $this->view->riskmanage      = $this->riskmanage->getById($riskManageID);
        $this->view->users      = $this->user->getPairs('nodeleted|noclosed');
        $this->view->riskManage      = $riskManage;
        $this->view->actions    = $this->loadModel('action')->getList('riskManage', $riskManageID);

        $this->display();
    }

    /**
     * Delete a riskManage.
     *
     * @param  int    $riskManageID
     * @param  string $confirm  yes|noe
     * @access public
     * @return void
     */
    public function delete($riskManageID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->riskmanage->confirmDelete, $this->createLink('riskmanage', 'delete', "riskManageID=$riskManageID&confirm=yes")));
        }
        else
        {
            $riskManage = $this->riskmanage->getById($riskManageID);
            $this->riskmanage->delete(TABLE_RISKMANAGE, $riskManageID);

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

            die(js::locate($this->createLink('riskmanage', 'browse'), 'parent'));
        }
    }

    /**
     * Batch close risk.
     *
     * @access public
     * @return void
     */
    public function batchClose()
    {
        if($this->post->riskManageIDList)
        {
            $riskManageIDList = $this->post->riskManageIDList;
            $riskManageIDList = array_unique($riskManageIDList);
            unset($_POST['riskManageIDList']);
            $this->loadModel('action');

            $riskManages = $this->riskmanage->getByList($riskManageIDList);
            foreach($riskManages as $riskID => $risk)
            {
                if($risk->stateTracking == 'closed') continue;

                $changes = $this->riskmanage->close($riskID);
                if($changes)
                {
                    $actionID = $this->action->create('riskmanage', $riskID, 'Closed', '');
                    $this->action->logHistory($actionID, $changes);
                    $this->riskmanage->sendmail($riskID, $actionID);
                }
            }
            if(!dao::isError()) $this->loadModel('score')->create('ajax', 'batchOther');
        }
        die(js::reload('parent'));
    }

    /**
     * Close a task.
     *
     * @param  int      $riskManageID
     * @access public
     * @return void
     */
    public function close($riskManageID)
    {
        $this->riskmanage->getById($riskManageID);

        $this->loadModel('action');
        $changes = $this->riskmanage->close($riskManageID);
        if(dao::isError()) die(js::error(dao::getError()));

        if(!empty($changes))
        {
            $actionID = $this->action->create('riskmanage', $riskManageID, 'Closed');
            $this->action->logHistory($actionID, $changes);
            $this->riskmanage->sendmail($riskManageID, $actionID);
        }
        
        die(js::reload('parent'));
    }
}