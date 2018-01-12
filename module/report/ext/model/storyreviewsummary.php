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
        $info[$projectID]->hasTestDateCount     = 0;
        $info[$projectID]->noTestDateCount      = 0;
        $info[$projectID]->noTestDateStories    = array();
        $info[$projectID]->hasSpecialPlanCount  = 0;
        $info[$projectID]->noSpecialPlanCount   = 0;
        $info[$projectID]->noSpecialPlanStories = array();
        $info[$projectID]->notReviewStoryCount  = 0;
        $info[$projectID]->notReviewStories     = array();
        $info[$projectID]->freeReviewStoryCount = 0;
        $info[$projectID]->freeReviewStories    = array();
        $hasReviewedStories = array();

        $stories = $this->dao->select('t1.*, t2.*, t2.version as version')->from(TABLE_PROJECTSTORY)->alias('t1')
            ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
            ->where('t2.deleted')->eq('0')
            ->andWhere('t2.status')->ne('closed')
            ->andWhere('t1.project')->eq((int)$projectID)
            ->orderBy('id_desc')
            ->fetchAll('id');

        foreach ($stories as $storyID => $story)
        {
            if ($story->reviewStatus == 'notReview')
            {
                $info[$projectID]->notReviewStoryCount++;
                $info[$projectID]->notReviewStories[] = $storyID;
            }
            elseif ($story->reviewStatus == 'freeReview')
            {
                $info[$projectID]->freeReviewStoryCount++;
                $info[$projectID]->freeReviewStories[] = $storyID;
            }
            elseif ($story->reviewStatus == 'hasReview')
            {
                $hasReviewedStories[$storyID] = $storyID;
                if ($story->testDate != '0000-00-00')
                {
                    $info[$projectID]->hasTestDateCount++;
                }
                else
                {
                    $info[$projectID]->noTestDateCount++;
                    $info[$projectID]->noTestDateStories[] = $storyID;
                }

                if ($story->specialPlan != '0000-00-00')
                {
                    $info[$projectID]->hasSpecialPlanCount++;
                }
                else
                {
                    $info[$projectID]->noSpecialPlanCount++;
                    $info[$projectID]->noSpecialPlanStories[] = $storyID;
                }
            }
        }
        
        $zeroDevelTaskStories = $this->getZeroTaskStories($hasReviewedStories, "fos, devel, sdk, web, ios, android, script");
        $zeroTestTaskStories = $this->getZeroTaskStories($hasReviewedStories, 'test');
        $info[$projectID]->zeroDevelTaskStories = $zeroDevelTaskStories;
        $info[$projectID]->zeroTestTaskStories = $zeroTestTaskStories;
    }
    
    krsort($info);
    return $info;
}
