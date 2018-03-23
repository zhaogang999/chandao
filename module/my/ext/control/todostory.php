<?php
include '../../control.php';
class myMy extends my
{

    /**
     * 待办需求
     *
     * @param  string $type
     * @param  string $orderBy
     * @param  int    $recTotal
     * @param  int    $recPerPage
     * @param  int    $pageID
     * @access public
     * @return void
     */
    public function todoStory($type = 'toTestStory', $browseType = 'bymodule', $param=0, $orderBy='testDate', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        /* Lower browse type. */
        $browseType = strtolower($browseType);
        
        /* Get all products. */
        $products = $this->loadModel('product')->getPairs('nocode');

        /* Save session. */
        if($this->app->viewType != 'json') $this->session->set('todoStoryList', $this->app->getURI(true));

        //if($browseType == 'bymodule') setcookie('storyModule', (int)$param, $this->config->cookieLife, $this->config->webRoot);
        if($browseType != 'bymodule') $this->session->set('storyBrowseType', $browseType);
        $queryID  = ($browseType == 'bysearch') ? (int)$param : 0;

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        if($this->app->getViewType() == 'mhtml') $recPerPage = 10;
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        $stories = $this->loadModel('story')->getStoriesByField($type, $browseType, $queryID, $sort, $pager);
        $storyIdList = array();
        foreach($stories as $story) $storyIdList[$story->id] = $story->id;
        $storyTasks = $this->loadModel('task')->getStoryTaskCounts($storyIdList);

        /* Build search form. */
        $actionURL = $this->createLink('my', 'todostory', "type=$type&browseType=bySearch&queryID=myQueryID");
        $this->my->buildStorySearchForm($products , $queryID, $actionURL);

        /* Assign. */
        $this->view->title      = $this->lang->my->common . $this->lang->colon . $this->lang->my->todoStory;
        $this->view->position[] = $this->lang->my->todoStory;
        $this->view->stories    = $stories;
        $this->view->storyTasks = $storyTasks;
        $this->view->users      = $this->user->getPairs('noletter');
        $this->view->type       = $type;
        $this->view->recTotal   = $recTotal;
        $this->view->recPerPage = $recPerPage;
        $this->view->pageID     = $pageID;
        $this->view->orderBy    = $orderBy;
        $this->view->pager      = $pager;
        $this->view->today      = helper::today();

        $this->display();
    }
}