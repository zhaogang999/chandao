<?php
/**
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
