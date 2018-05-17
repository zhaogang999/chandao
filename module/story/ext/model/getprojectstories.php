<?php
/**
 * Get stories list of a project.
 *
 * @param  int    $projectID
 * @param  string $orderBy
 * @access public
 * @return array
 */
public function getProjectStories($projectID = 0, $orderBy = 't1.`order`_desc', $type = 'byModule', $param = 0, $pager = null)
{
    if(defined('TUTORIAL')) return $this->loadModel('tutorial')->getProjectStories();

    if($type == 'bySearch')
    {
        $queryID  = (int)$param;
        $products = $this->loadModel('project')->getProducts($projectID);

        if($this->session->projectStoryQuery == false) $this->session->set('projectStoryQuery', ' 1 = 1');
        if($queryID)
        {
            $query = $this->loadModel('search')->getQuery($queryID);
            if($query)
            {
                $this->session->set('projectStoryQuery', $query->sql);
                $this->session->set('projectStoryForm', $query->form);
            }
        }

        $allProduct = "`product` = 'all'";
        $storyQuery = $this->session->projectStoryQuery;
        if(strpos($this->session->projectStoryQuery, $allProduct) !== false)
        {
            $storyQuery = str_replace($allProduct, '1', $this->session->projectStoryQuery);
        }
        $storyQuery = preg_replace('/`(\w+)`/', 't2.`$1`', $storyQuery);

        $stories = $this->dao->select('distinct t1.*, t2.*, t3.branch as productBranch, t4.type as productType, t2.version as version')->from(TABLE_PROJECTSTORY)->alias('t1')
            ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
            ->leftJoin(TABLE_PROJECTPRODUCT)->alias('t3')->on('t1.project = t3.project')
            ->leftJoin(TABLE_PRODUCT)->alias('t4')->on('t2.product = t4.id')
            ->where($storyQuery)
            ->andWhere('t1.project')->eq((int)$projectID)
            ->orderBy($orderBy)
            ->page($pager, 't2.id')
            ->fetchAll('id');
    }
    else
    {
        $modules = ($type == 'byModule' and $param) ? $this->dao->select('*')->from(TABLE_MODULE)->where('path')->like("%,$param,%")->andWhere('type')->eq('story')->andWhere('deleted')->eq(0)->fetchPairs('id', 'id') : array();
        $stories = $this->dao->select('distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version')->from(TABLE_PROJECTSTORY)->alias('t1')
            ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
            ->leftJoin(TABLE_PROJECTPRODUCT)->alias('t3')->on('t1.project = t3.project')
            ->leftJoin(TABLE_PRODUCT)->alias('t4')->on('t2.product = t4.id')
            ->where('t1.project')->eq((int)$projectID)
            ->beginIF($type == 'byProduct')->andWhere('t1.product')->eq($param)->fi()
            ->beginIF($type == 'byBranch')->andWhere('t2.branch')->eq($param)->fi()
            ->beginIF($type == 'byModule' and $param)->andWhere('t2.module')->in($modules)->fi()
            ->andWhere('t2.deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager, 't2.id')
            ->fetchAll('id');
    }

    $query    = $this->dao->get();
    $branches = array();
    foreach($stories as $story)
    {
        if(empty($story->branch) and $story->productType != 'normal') $branches[$story->productBranch][$story->id] = $story->id;
    }
    //现阶段不需要该规则
    /*foreach($branches as $branchID => $storyIDList)
    {
        $stages = $this->dao->select('*')->from(TABLE_STORYSTAGE)->where('story')->in($storyIDList)->andWhere('branch')->eq($branchID)->fetchPairs('story', 'stage');
        foreach($stages as $storyID => $stage) $stories[$storyID]->stage = $stage;
    }*/

    $this->dao->sqlobj->sql = $query;
    return $stories;
}