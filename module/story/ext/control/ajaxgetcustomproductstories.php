<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/12/29
 * Time: 9:40
 */
class myStory extends story
{
    /**
     * AJAX: get stories of a product in html select.3286 创建需求时就可以选择关联需求，并且支持相关需求处显示“无”
     *
     * @param  int    $productID
     * @param  int    $moduleID
     * @param  int    $storyID
     * @param  string $onlyOption
     * @param  string $status
     * @param  int    $limit
     * @access public
     * @return void
     */
    public function ajaxGetCustomProductStories($productID, $branch = 0, $moduleID = 0, $storyID = 0, $onlyOption = 'false', $status = '', $limit = 0)
    {
        if($moduleID)
        {
            $moduleID = $this->loadModel('tree')->getStoryModule($moduleID);
            $moduleID = $this->tree->getAllChildID($moduleID);
        }

        $storyStatus = '';
        if($status == 'noclosed')
        {
            $storyStatus = $this->lang->story->statusList;
            unset($storyStatus['closed']);
            $storyStatus = array_keys($storyStatus);
        }

        $stories = $this->story->getProductStoryPairs($productID, $branch ? "0,$branch" : $branch, $moduleID, $storyStatus, 'id_desc', $limit);
        $select  = html::select('story[]', empty($stories) ? array('' => '') : $stories, $storyID, "class='form-control' multiple onchange='changeIfLinkStories(this.value);'");

        /* If only need options, remove select wrap. */
        if($onlyOption == 'true') die(substr($select, strpos($select, '>') + 1, -10));
        die($select);
    }
}