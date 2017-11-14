<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/11/7
 * Time: 11:24
 */
/**
 * Batch change the plan of story.
 *
 * @param  array  $storyIDList
 * @param  int    $planID
 * @access public
 * @return array
 */
public function batchChangePlan($storyIDList, $planID, $oldPlanID = 0)
{
    $now         = helper::now();
    $allChanges  = array();
    $oldStories  = $this->getByList($storyIDList);
    $plan        = $this->loadModel('productplan')->getById($planID);
    foreach($storyIDList as $storyID)
    {
        $oldStory = $oldStories[$storyID];

        $story = new stdclass();
        $story->lastEditedBy   = $this->app->user->account;
        $story->lastEditedDate = $now;
        if(strpos(",{$oldStory->plan},", ",$planID,") !== false) continue;
        if($this->session->currentProductType == 'normal' or empty($oldPlanID) or $oldStory->branch)
        {
            $story->plan = $planID;
        }
        elseif($oldPlanID)
        {
            $story->plan = trim(str_replace(",$oldPlanID,", ',', ",$oldStory->plan,"), ',');
            if(empty($story->branch)) $story->plan .= ",$planID";
        }

        //更改计划需求阶段不发生改变
        //if($planID) $story->stage = 'planned';
        if($planID and $oldStory->stage =='wait') $story->stage = 'planned';

        $this->dao->update(TABLE_STORY)->data($story)->autoCheck()->where('id')->eq((int)$storyID)->exec();
        if(!$planID) $this->setStage($storyID);
        if(!dao::isError()) $allChanges[$storyID] = common::createChanges($oldStory, $story);
    }
    return $allChanges;
}
