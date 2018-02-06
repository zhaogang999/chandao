<?php
/**
 * Get stories pairs of a project.
 *
 * @param  int           $projectID
 * @param  int           $productID
 * @param  array|string  $moduleIdList
 * @param  string        $type
 * @access public
 * @return array
 */
public function getProjectStoryPairs($projectID = 0, $productID = 0, $branch = 0, $moduleIdList = 0, $type = 'full')
{
    if(defined('TUTORIAL')) return $this->loadModel('tutorial')->getProjectStoryPairs();
    $stories = $this->dao->select('t2.id, t2.title, t2.module, t2.pri, t2.estimate, t2.openedBy,  t3.name AS product')
        ->from(TABLE_PROJECTSTORY)->alias('t1')
        ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
        ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
        ->where('t1.project')->eq((int)$projectID)
        ->andWhere('t2.deleted')->eq(0)
        ->beginIF($productID)->andWhere('t2.product')->eq((int)$productID)->fi()
        ->beginIF($branch)->andWhere('t2.branch')->in("0,$branch")->fi()
        ->beginIF($moduleIdList)->andWhere('t2.module')->in($moduleIdList)->fi()
        ->orderBy('t1.`order` desc')
        ->fetchAll();
    if(!$stories) return array();
    return $this->formatStories($stories, $type);
}