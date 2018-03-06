<?php
/**
 * Format stories
 *
 * @param  array    $stories
 * @param  string   $type
 * @param  int      $limit
 * @access public
 * @return void
 */
public function formatStories($stories, $type = 'full', $limit = 0)
{
    /* Get module names of stories. */
    /*$modules = array();
    foreach($stories as $story) $modules[] = $story->module;
    $moduleNames = $this->dao->select('id, name')->from(TABLE_MODULE)->where('id')->in($modules)->fetchPairs();*/

    /* Format these stories. */
    $storyPairs = array('' => '');
    $i = 0;
    $this->config->user->showDeleted = 1;        //修改bug；列表页可以显示已删除的用户 21-22
    $users = $this->loadModel('user')->getPairs();
    foreach($stories as $story)
    {
        if($type == 'short')
        {
            $property = '[p' . $story->pri . ', ' . $story->estimate . 'h]';
        }
        else
        {
            $property = '(' . $this->lang->story->pri . ':' . $story->pri . ',' . $this->lang->story->estimate . ':' . $story->estimate . ')' . $users[$story->openedBy];
        }
        $storyPairs[$story->id] = $story->id . ':' . $story->title . $property;

        if($limit > 0 && ++$i > $limit)
        {
            $storyPairs['showmore'] = $this->lang->more . $this->lang->ellipsis;
            break;
        }
    }
    return $storyPairs;
}