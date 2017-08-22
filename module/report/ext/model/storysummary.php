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

    $projects = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetch();
    $storySql = "SELECT ps.`project`,s.`stage`,COUNT(s.`id`) AS taskSum FROM zt_projectstory AS ps LEFT JOIN zt_story AS s ON ps.`story` = s.`id` WHERE ps.`project` IN(" .$projects->ids . ") AND s.deleted='0' GROUP BY ps.`project`,s.`stage`";
    $storySum = $this->dao->query($storySql)->fetchAll();
    $projectInfo = $this->dao->select("id,name")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetchAll();

    $projects = explode(',', $projects->ids);
    $projectSum =count($projects);

    $newStorySum = array();
    foreach ($storySum as $val)
    {
        $newStorySum[$val->project][$val->stage]= $val->taskSum;
    }

    for($i=0;$i<$projectSum;$i++)
    {
        $info[$projects[$i]] = new stdClass();
        $info[$projects[$i]]->projectInfo = $projectInfo[$i];
        $info[$projects[$i]]->storySum = isset($newStorySum[$projects[$i]])?$newStorySum[$projects[$i]]:0;
    }

    krsort($info);
    return $info;
}

/**
 * Get counts of some stories' tasks.
 *
 * @param  array  $stories
 * @param  int    $projectID
 * @access public
 * @return int
 */
public function getStoryTask($stories)
{
    $taskCounts = $this->dao->select('story, COUNT(*) AS tasks')
        ->from(TABLE_TASK)
        ->where('story')->in($stories)
        ->andWhere('deleted')->eq(0)
        ->groupBy('story')
        ->fetchPairs();
    foreach($stories as $storyID) if(!isset($taskCounts[$storyID])) $taskCounts[$storyID] = 0;
    return $taskCounts;
}
