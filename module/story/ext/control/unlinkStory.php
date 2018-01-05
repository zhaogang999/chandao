<?php
include '../../control.php';
class myStory extends story
{
    /**
     * Unlink story.
     *
     * @param  int    $storyID
     * @param  string $type
     * @param  int    $story2Unlink
     * @access public
     * @return string
     */
    public function unlinkStory($storyID, $type = '', $story2Unlink = 0)
    {
        /* Unlink related story if type is linkStories else unlink child story. */
        $this->story->unlinkStory($storyID, $type, $story2Unlink);
        //3286 创建需求时就可以选择关联需求，并且支持相关需求处显示“无”
        $storyA = $this->dao->findById((int)$storyID)->from(TABLE_STORY)->fetch();
        if (empty($storyA->linkStories))
        {
            $this->dao->update(TABLE_STORY)->set('ifLinkStories')->eq('')->where('id')->eq($storyID)->exec();
        }

        //需求双向关联
        $this->story->unlinkStory($story2Unlink, $type, $storyID);
        $storyB = $this->dao->findById((int)$story2Unlink)->from(TABLE_STORY)->fetch();
        if (empty($storyB->linkStories))
        {
            $this->dao->update(TABLE_STORY)->set('ifLinkStories')->eq('')->where('id')->eq($story2Unlink)->exec();
        }

        die('success');
    }
}