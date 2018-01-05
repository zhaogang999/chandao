<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/1/3
 * Time: 17:12
 */
class myStory extends story
{
    /**
     * Batch change the status of ifLinkStories.
     *
     * @param  string    $status
     * @access public
     * @return void
     */
    public function batchChangeIfLinkStories($status)
    {
        $storyIDList = $this->post->storyIDList ? $this->post->storyIDList : die(js::locate($this->session->storyList, 'parent'));
        $storyIDList = array_unique($storyIDList);
        $allChanges  = $this->story->batchChangeIfLinkStories($storyIDList, $status);
        if(dao::isError()) die(js::error(dao::getError()));

        $action = 'Edited';
        foreach($allChanges as $storyID => $changes)
        {
            $actionID = $this->action->create('story', $storyID, $action);
            $this->action->logHistory($actionID, $changes);
            //$this->story->sendmail($storyID, $actionID);
        }
        if(!dao::isError()) $this->loadModel('score')->create('ajax', 'batchOther');
        die(js::locate($this->session->storyList, 'parent'));
    }
}