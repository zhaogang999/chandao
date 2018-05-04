<?php
/**
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
}
