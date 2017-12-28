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
    public function todoStory($type = 'toTestStory', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        /* Save session. */
        if($this->app->viewType != 'json') $this->session->set('todoStoryList', $this->app->getURI(true));

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        if($this->app->getViewType() == 'mhtml') $recPerPage = 10;
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        if ($type == 'toTestStory')
        {
            $orderBy = 'testDate';
        }
        elseif ($type == 'toReleaseStory')
        {
            $orderBy = 'specialPlan';
        }
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        $stories = $this->loadModel('story')->getStoriesByField($type, $sort, $pager);
        $storyIdList = array();
        foreach($stories as $story) $storyIdList[$story->id] = $story->id;
        $storyTasks = $this->loadModel('task')->getStoryTaskCounts($storyIdList);

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