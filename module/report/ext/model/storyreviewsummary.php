<?php
/**
* get info of projectStory
*
* @access public
* @return array
*/
public function storyReviewSummary()
{
	$info = array();
    $this->loadModel('project');
    $projects = $this->project->getPairs('noclosed');

    foreach ($projects as $projectID => $project)
    {
        $info[$projectID] = new stdClass();
        $info[$projectID]->name = $project;
        $info[$projectID]->storyCount           = 0;
        $info[$projectID]->hasTestDateCount     = 0;
        $info[$projectID]->noTestDateCount      = 0;
        $info[$projectID]->noTestDateHasReviewStories     = array();
        $info[$projectID]->noTestDateFreeReviewStories    = array();
        $info[$projectID]->hasSpecialPlanCount  = 0;
        $info[$projectID]->noSpecialPlanCount   = 0;
        $info[$projectID]->noSpecialPlanHasReviewStories  = array();
        $info[$projectID]->noSpecialPlanFreeReviewStories = array();
        $info[$projectID]->notReviewStoryCount  = 0;
        $info[$projectID]->hasReviewStoryCount  = 0;
        $info[$projectID]->notReviewStories     = array();
        $info[$projectID]->freeReviewStoryCount = 0;
        $info[$projectID]->freeReviewStories    = array();
        $hasReviewedStories  = array();
        $freeReviewedStories = array();

        $stories = $this->dao->select('t1.*, t2.*, t2.version as version')->from(TABLE_PROJECTSTORY)->alias('t1')
            ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
            ->where('t2.deleted')->eq('0')
            ->andWhere('t2.status')->ne('closed')
            ->andWhere('t1.project')->eq((int)$projectID)
            ->orderBy('id_desc')
            ->fetchAll('id');

        foreach ($stories as $storyID => $story)
        {
            $info[$projectID]->storyCount++;

            if ($story->reviewStatus == 'notReview')
            {
                $info[$projectID]->notReviewStoryCount++;
                $info[$projectID]->notReviewStories[] = $storyID;
            }
            elseif ($story->reviewStatus == 'freeReview')
            {
                $info[$projectID]->freeReviewStoryCount++;
                //$info[$projectID]->freeReviewStories[] = $storyID;
                $freeReviewedStories[$storyID] = new stdClass();
                $freeReviewedStories[$storyID]->id = $storyID;
                $freeReviewedStories[$storyID]->version = $story->version;

                if ($story->testDate == '0000-00-00')
                {
                    $info[$projectID]->noTestDateFreeReviewStories[] = $storyID;
                }

                if ($story->specialPlan == '0000-00-00')
                {
                    $info[$projectID]->noSpecialPlanFreeReviewStories[] = $storyID;
                }
            }
            elseif ($story->reviewStatus == 'hasReview')
            {
                $info[$projectID]->hasReviewStoryCount++;
                $hasReviewedStories[$storyID] = new stdClass();
                $hasReviewedStories[$storyID]->id = $storyID;
                $hasReviewedStories[$storyID]->version = $story->version;

                if ($story->testDate != '0000-00-00')
                {
                    $info[$projectID]->hasTestDateCount++;
                }
                else
                {
                    $info[$projectID]->noTestDateCount++;
                    $info[$projectID]->noTestDateHasReviewStories[] = $storyID;
                }

                if ($story->specialPlan != '0000-00-00')
                {
                    $info[$projectID]->hasSpecialPlanCount++;
                }
                else
                {
                    $info[$projectID]->noSpecialPlanCount++;
                    $info[$projectID]->noSpecialPlanHasReviewStories[] = $storyID;
                }
            }
        }

        $info[$projectID]->zeroDevelTaskHasReviewStories = $this->getZeroTaskStories($hasReviewedStories, "fos, devel, sdk, web, ios, android, script");
        $info[$projectID]->zeroDevelTaskFreeReviewStories = $this->getZeroTaskStories($freeReviewedStories, "fos, devel, sdk, web, ios, android, script");
        $info[$projectID]->zeroTestTaskHasReviewStories = $this->getZeroTaskStories($hasReviewedStories, 'test');
        $info[$projectID]->zeroTestTaskFreeReviewStories = $this->getZeroTaskStories($freeReviewedStories, 'test');
    }
    
    krsort($info);
    return $info;
}
