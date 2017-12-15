<?php
/**
 * Get a story by id.
 *
 * @param  int    $storyID
 * @param  int    $version
 * @param  bool   $setImgSize
 * @access public
 * @return object|bool
 */
public function getById($storyID, $version = 0, $setImgSize = false)
{
    $story = $this->dao->findById((int)$storyID)->from(TABLE_STORY)->fetch();
    if(!$story) return false;
    if(substr($story->closedDate, 0, 4) == '0000') $story->closedDate = '';
    if($version == 0) $version = $story->version;
    $spec = $this->dao->select('title,spec,verify')->from(TABLE_STORYSPEC)->where('story')->eq($storyID)->andWhere('version')->eq($version)->fetch();
    $story->title  = isset($spec->title)  ? $spec->title  : '';
    $story->spec   = isset($spec->spec)   ? $spec->spec   : '';
    $story->verify = isset($spec->verify) ? $spec->verify : '';

    $story = $this->loadModel('file')->replaceImgURL($story, 'spec,verify');
    if($setImgSize) $story->spec   = $this->file->setImgSize($story->spec);
    if($setImgSize) $story->verify = $this->file->setImgSize($story->verify);

    $story->projects = $this->dao->select('t1.project, t2.name, t2.status')->from(TABLE_PROJECTSTORY)->alias('t1')
        ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
        ->where('t1.story')->eq($storyID)
        ->orderBy('t1.`order` DESC')
        ->fetchAll('project');
    $story->tasks  = $this->dao->select('id, name, assignedTo, project, status, consumed, `left`')->from(TABLE_TASK)->where('story')->eq($storyID)->andWhere('deleted')->eq(0)->orderBy('id DESC')->fetchGroup('project');
    $story->stages = $this->dao->select('*')->from(TABLE_STORYSTAGE)->where('story')->eq($storyID)->fetchPairs('branch', 'stage');
    //$story->bugCount  = $this->dao->select('COUNT(*)')->alias('count')->from(TABLE_BUG)->where('story')->eq($storyID)->fetch('count');
    //$story->caseCount = $this->dao->select('COUNT(*)')->alias('count')->from(TABLE_CASE)->where('story')->eq($storyID)->fetch('count');
    if($story->toBug) $story->toBugTitle = $this->dao->findById($story->toBug)->from(TABLE_BUG)->fetch('title');
    if($story->plan)
    {
        $plans  = $this->dao->select('id,title,branch')->from(TABLE_PRODUCTPLAN)->where('id')->in($story->plan)->fetchAll('id');
        foreach($plans as $planID => $plan)
        {
            $story->planTitle[$planID] = $plan->title;
            if($plan->branch and !isset($story->stages[$plan->branch])) $story->stages[$plan->branch] = 'planned';
        }
    }

    //2912 需求评审单的开发
    if ($story->storyReviewID != 0)
    {
        $storyReview = $this->dao->findById((int)$story->storyReviewID)->from(TABLE_STORYREVIEW)->fetch();
        $story->storyReview[$storyReview->id] = $storyReview->title;
    }

    $extraStories = array();
    if($story->duplicateStory) $extraStories = array($story->duplicateStory);
    if($story->linkStories)    $extraStories = explode(',', $story->linkStories);
    if($story->childStories)   $extraStories = array_merge($extraStories, explode(',', $story->childStories));
    $extraStories = array_unique($extraStories);
    if(!empty($extraStories)) $story->extraStories = $this->dao->select('id,title')->from(TABLE_STORY)->where('id')->in($extraStories)->fetchPairs();
    return $story;
}
