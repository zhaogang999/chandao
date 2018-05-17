<?php
include '../../control.php';
class myCompany extends company
{
    /**
     * Company dynamic.
     *
     * @param  string $browseType
     * @param  string $orderBy
     * @param  int    $recTotal
     * @param  int    $recPerPage
     * @param  int    $pageID
     * @access public
     * @return void
     */
    public function dynamic($browseType = 'today', $param = '', $orderBy = 'date_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->company->setMenu();
        $this->app->loadLang('user');
        $this->app->loadLang('project');
        $this->loadModel('action');

        /* Save session. */
        $uri = $this->app->getURI(true);
        $this->session->set('productList',     $uri);
        $this->session->set('productPlanList', $uri);
        $this->session->set('releaseList',     $uri);
        $this->session->set('storyList',       $uri);
        $this->session->set('projectList',     $uri);
        $this->session->set('taskList',        $uri);
        $this->session->set('buildList',       $uri);
        $this->session->set('bugList',         $uri);
        $this->session->set('caseList',        $uri);
        $this->session->set('testtaskList',    $uri);
        $this->session->set('patchbuildList',  $uri);
        $this->session->set('storyreviewList', $uri);
        $this->session->set('issueList',       $uri);
        $this->session->set('riskmanageList',  $uri);

        /* Set the pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        /* Set the user and type. */
        $account = $browseType == 'account' ? $param : 'all';
        $product = $browseType == 'product' ? $param : 'all';
        $project = $browseType == 'project' ? $param : 'all';
        $period  = ($browseType == 'account' or $browseType == 'product' or $browseType == 'project') ? 'all'  : $browseType;
        $queryID = ($browseType == 'bysearch') ? (int)$param : 0;

        /* Get products' list.*/
        $products = $this->loadModel('product')->getPairs('nocode');
        $products = array($this->lang->company->product) + $products;
        $this->view->products = $products;

        /* Get projects' list.*/
        $projects = $this->loadModel('project')->getPairs('nocode');
        $projects = array($this->lang->company->project) + $projects;
        $this->view->projects = $projects;

        /* Get users.*/
        $users = $this->loadModel('user')->getPairs('noclosed|nodeleted');
        $users[''] = $this->lang->company->user;
        $this->view->users    = $users;

        /* The header and position. */
        $this->view->title      = $this->lang->company->common . $this->lang->colon . $this->lang->company->dynamic;
        $this->view->position[] = $this->lang->company->dynamic;

        /* Get actions. */
        if($browseType != 'bysearch')
        {
            $actions = $this->action->getDynamic($account, $period, $sort, $pager, $product, $project);
        }
        else
        {
            $actions = $this->action->getDynamicBySearch($products, $projects, $queryID, $sort, $pager);
        }

        /* Build search form. */
        $projects[0] = '';
        $products[0] = '';
        $users['']   = '';
        ksort($projects);
        ksort($products);
        $projects['all'] = $this->lang->project->allProject;
        $products['all'] = $this->lang->product->allProduct;

        foreach($this->lang->action->search->label as $action => $name)
        {
            if($action) $this->lang->action->search->label[$action] .= " [ $action ]";
        }
        
        $this->config->company->dynamic->search['actionURL'] = $this->createLink('company', 'dynamic', "browseType=bysearch&param=myQueryID");
        $this->config->company->dynamic->search['queryID']   = $queryID;
        $this->config->company->dynamic->search['params']['action']['values']  = $this->lang->action->search->label;
        $this->config->company->dynamic->search['params']['project']['values'] = $projects;
        $this->config->company->dynamic->search['params']['product']['values'] = $products;
        $this->config->company->dynamic->search['params']['actor']['values']   = $users;
        $this->loadModel('search')->setSearchParams($this->config->company->dynamic->search);

        /* Assign. */
        $this->view->browseType = $browseType;
        $this->view->account    = $account;
        $this->view->product    = $product;
        $this->view->project    = $project;
        $this->view->queryID    = $queryID;
        $this->view->actions    = $actions;
        $this->view->orderBy    = $orderBy;
        $this->view->pager      = $pager;
        $this->view->param      = $param;
        $this->display();
    }
}