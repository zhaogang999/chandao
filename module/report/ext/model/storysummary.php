<?php
/**
* get info of projectStory
*
* @access public
* @return array
*/
public function storySummary()
{
	$info = array();
    $this->loadModel('story');
    $this->loadModel('project');

    $projects = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetch();
    $storySql = "SELECT ps.`project`,s.`stage`,COUNT(s.`id`) AS taskSum FROM zt_projectstory AS ps LEFT JOIN zt_story AS s ON ps.`story` = s.`id` WHERE ps.`project` IN(" .$projects->ids . ") AND s.deleted='0' GROUP BY ps.`project`,s.`stage`";
    $storySum = $this->dao->query($storySql)->fetchAll();
    $projectInfo = $this->dao->select("id,name")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetchPairs();

    $projects = explode(',', $projects->ids);
    $projectSum =count($projects);

    $newStorySum = array();
    foreach ($storySum as $val)
    {
        $newStorySum[$val->project][$val->stage]= $val->taskSum;
    }

    foreach ($projects as $project)
    {
        $info[$project] = new stdClass();

        //$stories = $this->story->getProjectStories($project,'id_desc', 'bySearch');
        $stories = $this->dao->select('t1.*, t2.*, t2.version as version')->from(TABLE_PROJECTSTORY)->alias('t1')
            ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
            ->where('t2.deleted')->eq('0')
            ->andWhere('t2.status')->ne('closed')
            ->andWhere('t1.project')->eq((int)$project)
            ->orderBy('id_desc')
            ->fetchAll('id');

        $projectAB = $this->project->getById($project);

        $zeroTaskStories = $this->getZeroTaskStories($stories,$project);
        $zeroDevelTaskStories = $this->getZeroTaskStories($stories,$project, "fos, devel, sdk, web, ios, android, script");
        $zeroTestTaskStories = $this->getZeroTaskStories($stories,$project, 'test');

        $storyCountByTime = $this->getStoryOpenDateReport($stories, $projectAB->begin);
        $storyChange = $this->getStoryChangeRate($project);
        
        $info[$project]->zeroTaskStories = $zeroTaskStories;
        $info[$project]->zeroDevelTaskStories = $zeroDevelTaskStories;
        $info[$project]->zeroTestTaskStories = $zeroTestTaskStories;
        $info[$project]->storyCountByTime = $storyCountByTime;
        $info[$project]->storyChange = $storyChange;

        $info[$project]->projectInfo = $projectInfo[$project];
        $info[$project]->storySum = isset($newStorySum[$project])?$newStorySum[$project]:0;
    }
    
    krsort($info);
    
    return $info;
}

public function getStoryChangeRate($project)
{
    $storyChange = array('count'=>0, 'rate'=>'');
    
    $storyChangeCount  = $this->dao->select("count('story') as storyChangeCount")->from(TABLE_PROJECTSTORY)
        ->where('project')->eq($project)
        ->andWhere('version')->ne(1)
        ->fetch('storyChangeCount');
    //var_dump($storyChangeCount);die;
    $storyCount  = $this->dao->select("count('story') as storyCount")->from(TABLE_PROJECTSTORY)
        ->where('project')->eq($project)
        ->fetch('storyCount');
    $storyChangeRate = $storyCount!=0?ceil($storyChangeCount/$storyCount*100):0;

    $storyChange['count'] = $storyChangeCount;
    $storyChange['rate'] = $storyChangeRate. '%';

    return $storyChange;
}

public function getStoryOpenDateReport($stories, $projectBegin)
{
    $storyCount = array('before'=>0, 'oneWeek'=>0, 'twoWeek'=>0, 'later'=>0);

    foreach($stories as $storyID => $story)
    {
        $days = ceil((strtotime($story->openedDate)-strtotime($projectBegin))/60/60/24);

        if ($days<=0)  ++$storyCount['before'];
        if ($days<7 && $days>0) ++$storyCount['oneWeek'];
        if ($days<=14 && $days>=7) ++$storyCount['twoWeek'];
        if ($days>14) ++$storyCount['later'];
    }
    
    return $storyCount;
}

/**
 * Get getZeroTaskStories of project.
 *
 * @param  array  $stories
 * @param  int    $projectID
 * @param  string    $type
 * @access public
 * @return string
 */
public function getZeroTaskStories($stories, $projectID, $type='')
{
    $storyIdList = array_keys($stories);

    $taskCounts = $this->dao->select('story, COUNT(*) AS tasks')
        ->from(TABLE_TASK)
        ->where('story')->in($storyIdList)
        ->beginIF($type!='')->andWhere('type')->in($type)->fi()
        ->andWhere('deleted')->eq(0)
        ->beginIF($projectID)->andWhere('project')->eq($projectID)->fi()
        ->groupBy('story')
        ->fetchPairs();

    $zeroTaskStories = array();
    foreach($stories as $storyID =>$story) if(!isset($taskCounts[$storyID]))
    {
        $zeroTaskStories[$storyID]->storyID = $storyID;
        $zeroTaskStories[$storyID]->version = $story->version;
    }

    return $zeroTaskStories;
}
