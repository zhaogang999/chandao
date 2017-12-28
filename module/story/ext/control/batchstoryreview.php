<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/12/14
 * Time: 16:31
 */
class myStory extends story
{
    /**
     * 批量编辑需求评审结果
     *
     * @param $result int
     * @return null
     */
    public function batchStoryReview($result)
    {
        $story = new stdClass();
        $storyIDList = $this->post->storyIDList ? $this->post->storyIDList : die(js::locate($this->session->storyList, 'parent'));
        $storyIDList = implode(',', array_keys(array_unique($storyIDList)));
        $story->reviewStatus = $result;
        $oldStoriesInfo = $this->dao->select('*')->from(TABLE_STORY)->where('id')->in($storyIDList)->fetchPairs('id', 'reviewStatus');

        $this->dao->update(TABLE_STORY)->data($story)->autoCheck()->where('id')->in($storyIDList)->exec();

        if (!dao::isError())
        {
            $stories = explode(',', $storyIDList);
            foreach ($stories as $storyID)
            {
                $changes = array();
                $changes[] = array('field' => 'reviewStatus', 'old' => $oldStoriesInfo[$storyID], 'new' => $story->reviewStatus);
                $action   = 'Edited';
                $actionID = $this->action->create('story', $storyID, $action);
                $this->action->logHistory($actionID, $changes);
                //$this->story->sendmail($storyID, $actionID);
            }

            die(js::locate($this->session->storyList, 'parent'));
        }
    }
}