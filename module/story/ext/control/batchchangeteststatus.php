<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/02/08
 * Time: 16:31
 */
class myStory extends story
{
    /**
     * 批量编辑开发提测
     *
     * @param $result int
     * @return null
     */
    public function batchChangeTestStatus($result)
    {
        $story = new stdClass();
        $storyIDList = $this->post->storyIDList ? $this->post->storyIDList : die(js::locate($this->session->storyList, 'parent'));
        $storyIDList = implode(',', array_keys(array_unique($storyIDList)));
        $story->testStatus = $result;
        $oldStoriesInfo = $this->dao->select('*')->from(TABLE_STORY)->where('id')->in($storyIDList)->fetchPairs('id', 'testStatus');
        
        $this->dao->update(TABLE_STORY)->data($story)->autoCheck()->where('id')->in($storyIDList)->exec();

        if (!dao::isError())
        {
            $stories = explode(',', $storyIDList);
            foreach ($stories as $storyID)
            {
                $changes = array();
                $changes[] = array('field' => 'testStatus', 'old' => $oldStoriesInfo[$storyID], 'new' => $story->testStatus);
                $action   = 'Edited';
                $actionID = $this->action->create('story', $storyID, $action);
                $this->action->logHistory($actionID, $changes);
                //$this->story->sendmail($storyID, $actionID);
            }

            die(js::locate($this->session->storyList, 'parent'));
        }
    }
}