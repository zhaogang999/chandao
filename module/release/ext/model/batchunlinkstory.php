<?php
/**
 * Batch unlink story.
 *
 * @param  int    $releaseID
 * @access public
 * @return void
 */
public function batchUnlinkStory($releaseID)
{
    $storyList = $this->post->unlinkStories;
    if(empty($storyList)) return true;

    $release = $this->getByID($releaseID);
    //$release->stories = ",$release->stories,";
    foreach($storyList as $storyID) $release->stories = str_replace(",$storyID,", ',', $release->stories);
    //$release->stories = trim($release->stories, ',');
    $this->dao->update(TABLE_RELEASE)->set('stories')->eq($release->stories)->where('id')->eq((int)$releaseID)->exec();
    foreach($this->post->unlinkStories as $unlinkStoryID)
    {
        $this->loadModel('action')->create('story', $unlinkStoryID, 'unlinkedfromrelease', '', $releaseID);
    }
}
