<?php
/**
 * Link stories.
 *
 * @param  int    $storyID
 * @param  string $type
 * @access public
 * @return void
 */
public function linkStories($storyID, $type = 'linkStories')
{
    if($this->post->stories == false) return;

    $story        = $this->getById($storyID);
    $stories2Link = $this->post->stories;
    $stories = implode(',', $stories2Link) . ',' . trim($story->$type, ',');
//3286 创建需求时就可以选择关联需求，并且支持相关需求处显示“无”
    $this->dao->update(TABLE_STORY)->set($type)->eq(trim($stories, ','))->set('ifLinkStories')->eq('exist')->where('id')->eq($storyID)->exec();
    if(dao::isError()) die(js::error(dao::getError()));

    $action = ($type == 'linkStories') ? 'linkRelatedStory' : 'subdivideStory';
    $this->loadModel('action')->create('story', $storyID, $action, '', implode(',', $stories2Link));
//需求双向关联
    if ($type == 'linkStories')
    {
        foreach ($stories2Link as $val)
        {
            $linkStories = $this->dao->select('linkStories')->FROM(TABLE_STORY)->where('id')->eq(trim($val, ','))->fetch();
            $linkStoriesAB = $linkStories->linkStories .','. $storyID;

            $this->dao->update(TABLE_STORY)->set($type)->eq(trim($linkStoriesAB, ','))->set('ifLinkStories')->eq('exist')->where('id')->eq(trim($val, ','))->exec();
            if(dao::isError()) die(js::error(dao::getError()));

            $action = ($type == 'linkStories') ? 'linkRelatedStory' : 'subdivideStory';
            $this->loadModel('action')->create('story', $val, $action, '', $storyID);
        }
    }
}
