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
        $story->reviewed = $result;

        $this->dao->update(TABLE_STORY)->data($story)->autoCheck()->where('id')->in($storyIDList)->exec();
        die(js::locate($this->session->storyList, 'parent'));
    }
}