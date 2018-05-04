<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\release\model.php');
helper::cd();
class extreleaseModel extends releaseModel 
{
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
}/**
 * Link stories
 *
 * @param  int    $releaseID
 * @access public
 * @return void
 */
public function linkStory($releaseID)
{
    $release = $this->getByID($releaseID);

    $release->stories .= ',' . join(',', $this->post->stories) . ',';
    $this->dao->update(TABLE_RELEASE)->set('stories')->eq($release->stories)->where('id')->eq((int)$releaseID)->exec();
    if($release->stories)
    {
        $this->loadModel('story');
        foreach($this->post->stories as $storyID)
        {
            $this->story->setStage($storyID);
            $this->loadModel('action')->create('story', $storyID, 'linked2release', '', $releaseID);
        }
    }
}/**
 * Unlink story
 *
 * @param  int    $releaseID
 * @param  int    $storyID
 * @access public
 * @return void
 */
public function unlinkStory($releaseID, $storyID)
{
    $release = $this->getByID($releaseID);

    //$release->stories = trim(str_replace(",$storyID,", ',', ",$release->stories,"), ',');
    $release->stories = str_replace(",$storyID,", ',', "$release->stories");
    $this->dao->update(TABLE_RELEASE)->set('stories')->eq($release->stories)->where('id')->eq((int)$releaseID)->exec();
    $this->loadModel('action')->create('story', $storyID, 'unlinkedfromrelease', '', $releaseID);
}
//**//
}