<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/1/3
 * Time: 17:17
 */
/**
 * Batch change the status of ifLinkStories.
 *
 * @param  $storyIDList
 * @param  string    $status
 * @access public
 * @return array
 */
public function batchChangeIfLinkStories($storyIDList, $status)
{
    //var_dump($storyIDList);die;
    $now         = helper::now();
    $allChanges  = array();
    $oldStories  = $this->getByList($storyIDList);
    foreach($storyIDList as $storyID)
    {
        $oldStory = $oldStories[$storyID];

        $story = new stdclass();
        $story->lastEditedBy   = $this->app->user->account;
        $story->lastEditedDate = $now;
        $story->ifLinkStories  = $status;
        
        $this->dao->update(TABLE_STORY)->data($story)->autoCheck()->where('id')->eq((int)$storyID)->exec();
        if(!dao::isError()) $allChanges[$storyID] = common::createChanges($oldStory, $story);
    }
    return $allChanges;
}