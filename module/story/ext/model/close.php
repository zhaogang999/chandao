<?php
/**
 * Close a story.
 *
 * @param  int    $storyID
 * @access public
 * @return bool
 */
public function close($storyID)
{
    if(strpos($this->config->story->close->requiredFields, 'comment') !== false and !$this->post->comment)
    {
        dao::$errors[] = sprintf($this->lang->error->notempty, $this->lang->comment);
        return false;
    }

    $oldStory = $this->dao->findById($storyID)->from(TABLE_STORY)->fetch();
    $now      = helper::now();
    $story = fixer::input('post')
        ->add('lastEditedBy', $this->app->user->account)
        ->add('lastEditedDate', $now)
        ->add('closedDate', $now)
        ->add('closedBy',   $this->app->user->account)
        ->add('assignedTo',   'closed')
        ->add('assignedDate', $now)
        ->add('status', 'closed')
        ->add('stage', 'closed')
        ->removeIF($this->post->closedReason != 'duplicate', 'duplicateStory')
        ->removeIF($this->post->closedReason != 'subdivided', 'childStories')
        ->setIF($this->post->closedReason == 'done', 'stage', 'released')
        //bug修改把plan的值有0改为'';待官方修复后该文件删除
        ->setIF($this->post->closedReason != 'done', 'plan', '')
        ->remove('comment')
        ->get();

    $this->dao->update(TABLE_STORY)->data($story)
        ->autoCheck()
        ->batchCheck($this->config->story->close->requiredFields, 'notempty')
        ->checkIF($story->closedReason == 'duplicate',  'duplicateStory', 'notempty')
        ->where('id')->eq($storyID)->exec();
    if(!dao::isError() && $this->post->closedReason == 'done') $this->loadModel('score')->create('story', 'close', $storyID);
    return common::createChanges($oldStory, $story);
}