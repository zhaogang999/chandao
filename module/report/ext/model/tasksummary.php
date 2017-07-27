<?php
/**
* get info of task
*
* @access public
* @return array
*/
public function taskSummary($projects)
{
	$info = array();
    $echartData = array();
    $result = array();

    $taskSumSql = "SELECT `project`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN(" .$projects . ") AND deleted='0' GROUP BY `project`";
    $develTaskStatusSumSql = "SELECT `project`,`status`,COUNT( `id` ) AS taskSum FROM zt_task WHERE `project` IN (" .$projects . ") AND `type` IN ('fos', 'devel', 'sdk', 'web', 'ios', 'android') AND deleted = '0' GROUP BY `project`,`status`";
    $testStatusSumSql = "SELECT `project`,`status`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN (" .$projects . ") AND deleted='0' AND `type`='test' GROUP BY `project`,`status`";
    $storyTaskStatusSumSql = "SELECT `project`,`status`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN (" .$projects . ") AND deleted='0' AND `type` IN ('ra','design','ui') GROUP BY `project`,`status`";
    $delayedTaskSumSql = "SELECT `project`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN (" .$projects . ") AND curdate()>deadline AND `status` not IN ('done','closed','cancel') AND deadline != '0000-00-00' AND deleted='0' GROUP BY `project`";

    $taskSum = $this->dao->query($taskSumSql)->fetchAll();
    $develTaskStatusSum = $this->dao->query($develTaskStatusSumSql)->fetchAll();
    $testStatusSum = $this->dao->query($testStatusSumSql)->fetchAll();
    $storyTaskStatusSum = $this->dao->query($storyTaskStatusSumSql)->fetchAll();
    $delayedTaskSum = $this->dao->query($delayedTaskSumSql)->fetchAll();
    $projectInfo = $this->dao->select("id,name")->from(TABLE_PROJECT)->where('id')->in($projects)->fetchAll();

    $echartData['testTaskStatusCount'] = $this->taskStatusCount("'test'", $projects);
    $echartData['develTaskStatusCount'] = $this->taskStatusCount("'fos', 'devel', 'sdk', 'web', 'ios', 'android'", $projects);
    $echartData['storyTaskStatusCount'] = $this->taskStatusCount("'story'", $projects);

    //对数据进行处理
    $taskSum = $this->transform($taskSum);
    $delayedTaskSum = $this->transform($delayedTaskSum);

    $newDevelTaskStatusSum  = $this->taskStatusCountOfProject($develTaskStatusSum);
    $newTestStatusSum       = $this->taskStatusCountOfProject($testStatusSum);
    $newStoryTaskStatusSum  = $this->taskStatusCountOfProject($storyTaskStatusSum);

    $projects = explode(',', $projects);
    $projectSum =count($projects);

    for($i=0;$i<$projectSum;$i++)
    {
        $info[$projects[$i]] = new stdClass();
        $info[$projects[$i]]->projectInfo = $projectInfo[$i];
        $info[$projects[$i]]->taskSum = isset($taskSum[$projects[$i]])?$taskSum[$projects[$i]]:0;
        $info[$projects[$i]]->develTaskSum = isset($newDevelTaskStatusSum[$projects[$i]]) ? array_sum($newDevelTaskStatusSum[$projects[$i]]):0;
        $info[$projects[$i]]->newDevelTaskStatusSum = isset($newDevelTaskStatusSum[$projects[$i]])?$newDevelTaskStatusSum[$projects[$i]]:0;
        $info[$projects[$i]]->testSum = isset($newTestStatusSum[$projects[$i]]) ? array_sum($newTestStatusSum[$projects[$i]]) : 0;
        $info[$projects[$i]]->newTestStatusSum = isset($newTestStatusSum[$projects[$i]])?$newTestStatusSum[$projects[$i]]:0;
        $info[$projects[$i]]->storyTaskSum = isset($newStoryTaskStatusSum[$projects[$i]]) ? array_sum($newStoryTaskStatusSum[$projects[$i]]):0;
        $info[$projects[$i]]->newStoryTaskStatusSum = isset($newStoryTaskStatusSum[$projects[$i]])?$newStoryTaskStatusSum[$projects[$i]]:0;
        $info[$projects[$i]]->delayedTaskSum = isset($delayedTaskSum[$projects[$i]])?$delayedTaskSum[$projects[$i]]:0;
    }

    krsort($info);
    $result['info'] = $info;
    $result['echartData'] = $echartData;
    return $result;
}

/*public function getUndoneTaskCount($project)
{
    $this->dao->selcet

}*/

/**
 * Process the data
 * 
 * @param array  $arr
 * @return array
*/
public function transform($arr)
{
	$result = array();
	foreach ($arr as $value) {
		$result[$value->project] = $value->taskSum;
	}
	return $result;
}

/**
 * task status count
 *
 * @param string $type
 * @param string $projects
 * @return array
 */
public function taskStatusCount($type, $projects)
{
    $result = array();

    $taskCountSql = "SELECT COUNT(`id`) AS taskSum FROM zt_task WHERE deleted='0' AND `project` IN (" .$projects . ") AND `status`!='cancel' AND `type` IN (" . $type . ")";
    $doneTaskCountSql = "SELECT COUNT(id) AS  taskSum FROM zt_task WHERE deleted='0' AND `project` IN (" .$projects . ") AND `status`!='cancel' AND `status` IN ('done','close') AND `type` IN (" . $type . ")";
    $taskCount = $this->dao->query($taskCountSql)->fetch();
    $doneTaskCount = $this->dao->query($doneTaskCountSql)->fetch();

    $result['taskCount'] = $taskCount->taskSum;
    $result['doneTaskCount'] = $doneTaskCount->taskSum;
    $result['undoneTaskCount'] = $taskCount->taskSum - $doneTaskCount->taskSum;
    $result['doneTaskCountPercent'] = round($doneTaskCount->taskSum/$taskCount->taskSum, 2)*100 . '%';
    $result['undoneTaskCountPercent'] = round($result['undoneTaskCount']/$taskCount->taskSum, 2)*100 . '%';
    return $result;
}

public function taskStatusCountOfProject ($data)
{
    $newData = array();
    //$testStatistic = array();
    foreach ($data as $val)
    {
        $newData[$val->project][$val->status]= $val->taskSum;

        if ($val->status == 'done' || $val->status == 'closed')
        {
            $newData[$val->project]['done'] += $val->taskSum;
        }
        elseif ($val->status == 'wait' || $val->status == 'doing' || $val->status == 'pause')
        {
            $newData[$val->project]['undone'] += $val->taskSum;
        }
    }
    return $newData;
}