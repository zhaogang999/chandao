<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/12/19
 * Time: 15:53
 */
class myStory extends story
{
    /**
     * 批量编辑提测/发版时间
     *
     * @param $field
     * @param $year
     * @param $moth
     * @param $day
     */
    public function batchEditDate($field, $year, $moth, $day)
    {
        $story = new stdClass();

        $story->lastEditedDate = helper::now();
        $story->lastEditedBy     = $this->app->user->account;
        $story->$field = $year . '-' . $moth . '-' . $day;
        $storyIDList = $this->post->storyIDList ? $this->post->storyIDList : die(js::locate($this->session->storyList, 'parent'));
        $storyIDList = implode(',', array_keys(array_unique($storyIDList)));
        $oldStoriesInfo = $this->dao->select('*')->from(TABLE_STORY)->where('id')->in($storyIDList)->fetchPairs('id', $field);

        $this->dao->update(TABLE_STORY)->data($story)->autoCheck()->where('id')->in("$storyIDList")->exec();
        if (!dao::isError())
        {
            $stories = explode(',', $storyIDList);
            foreach ($stories as $storyID)
            {
                $changes = array();
                $changes[] = array('field' => $field, 'old' => $oldStoriesInfo[$storyID], 'new' => $story->$field);
                $action   = 'Edited';
                $actionID = $this->action->create('story', $storyID, $action);
                $this->action->logHistory($actionID, $changes);
                $this->story->sendmail($storyID, $actionID);
            }
            
            die(js::locate($this->session->storyList, 'parent'));
        }
    }
}