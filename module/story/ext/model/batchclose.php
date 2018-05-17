<?php
/**
 * Batch close story.
 *
 * @access public
 * @return void
 */
public function batchClose()
{
    /* Init vars. */
    $stories     = array();
    $allChanges  = array();
    $now         = helper::now();
    $data        = fixer::input('post')->get();
    $storyIDList = $data->storyIDList ? $data->storyIDList : array();

    $oldStories = $this->getByList($storyIDList);
    foreach($storyIDList as $storyID)
    {
        $oldStory = $oldStories[$storyID];
        if($oldStory->status == 'closed') continue;

        $story = new stdclass();
        $story->lastEditedBy   = $this->app->user->account;
        $story->lastEditedDate = $now;
        $story->closedBy       = $this->app->user->account;
        $story->closedDate     = $now;
        $story->assignedTo     = 'closed';
        $story->assignedDate   = $now;
        $story->status         = 'closed';
        $story->stage          = 'closed';

        $story->closedReason   = $data->closedReasons[$storyID];
        $story->duplicateStory = $data->duplicateStoryIDList[$storyID] ? $data->duplicateStoryIDList[$storyID] : $oldStory->duplicateStory;
        $story->childStories   = $data->childStoriesIDList[$storyID] ? $data->childStoriesIDList[$storyID] : $oldStory->childStories;

        if($story->closedReason == 'done') $story->stage = 'released';
        //bug修改把plan的值有0改为'';待官方修复后该文件删除
        if($story->closedReason != 'done') $story->plan  = '';

        $stories[$storyID] = $story;
        unset($story);
    }

    foreach($stories as $storyID => $story)
    {
        if(!$story->closedReason) continue;

        $oldStory = $oldStories[$storyID];

        $this->dao->update(TABLE_STORY)->data($story)
            ->autoCheck()
            ->checkIF($story->closedReason == 'duplicate',  'duplicateStory', 'notempty')
            ->where('id')->eq($storyID)->exec();

        if(!dao::isError())
        {
            $allChanges[$storyID] = common::createChanges($oldStory, $story);
        }
        else
        {
            die(js::error('story#' . $storyID . dao::getError(true)));
        }
        if(!dao::isError() && $story->stage == 'released') $this->loadModel('score')->create('story', 'close', $storyID);
    }

    return $allChanges;
}