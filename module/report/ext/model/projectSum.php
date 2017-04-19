<?php
/**
* get info of projects
*
* @access public
* @return array
*/
public function projectSummary()
{
	$info = array();

        $projects = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetch();

        $storySumSql = "SELECT `project`,COUNT(`story`) AS taskSum FROM zt_projectstory WHERE `project` IN(" .$projects->ids . ") GROUP BY `project`";
        $taskSumSql = "SELECT `project`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN(" .$projects->ids . ") AND deleted='0' AND `status` != 'cancel' GROUP BY `project`";
        $develTaskSumSql = "SELECT `project`,COUNT( `id` ) AS taskSum FROM zt_task WHERE `project` IN (" .$projects->ids . ") AND `type` IN ('service', 'devel', 'sdk', 'web', 'ios', 'android') AND `status` != 'cancel' AND deleted = '0' GROUP BY `project`";
        $develTaskDoneSumSql = "SELECT `project`,COUNT( `id` ) AS taskSum FROM zt_task WHERE `project` IN (" .$projects->ids . ") AND `type` IN ('service', 'devel', 'sdk', 'web', 'ios', 'android') AND deleted = '0' AND `status` IN ('done','closed') GROUP BY `project`";
        $testSumSql = "SELECT `project`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN (" .$projects->ids . ") AND deleted='0' AND `type`='test' AND `status` != 'cancel' GROUP BY `project`";
        $testDoneSumSql = "SELECT `project`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN (" .$projects->ids . ") AND deleted='0' AND `type`='test' AND `status` IN ('done','closed') GROUP BY `project`";
        $delayedTaskSumSql = "SELECT `project`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN (" .$projects->ids . ") AND NOW()>deadline AND `status` not IN ('done','closed') AND `status` != 'cancel' AND deadline != '0000-00-00' AND deleted='0' GROUP BY project";
        $delayedTaskSql = "SELECT project,GROUP_CONCAT(`id`) AS taskSum FROM zt_task WHERE project IN (" .$projects->ids . ") AND NOW()>deadline AND deleted='0' AND `status` not IN ('done','closed','cancel') AND deadline != '0000-00-00' GROUP BY project";

        $storySum = $this->dao->query($storySumSql)->fetchAll();
        $taskSum = $this->dao->query($taskSumSql)->fetchAll();
        $develTaskSum = $this->dao->query($develTaskSumSql)->fetchAll();
        $develTaskDoneSum = $this->dao->query($develTaskDoneSumSql)->fetchAll();
        $testSum = $this->dao->query($testSumSql)->fetchAll();
        $testDoneSum = $this->dao->query($testDoneSumSql)->fetchAll();
        $delayedTaskSum = $this->dao->query($delayedTaskSumSql)->fetchAll();
        $delayedTasks = $this->dao->query($delayedTaskSql)->fetchAll();
        $projectInfo = $this->dao->select("id,name")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetchAll();

      	$storySum = $this->transform($storySum);
      	$taskSum = $this->transform($taskSum);
      	$develTaskSum = $this->transform($develTaskSum);
      	$develTaskDoneSum = $this->transform($develTaskDoneSum);
      	$testSum = $this->transform($testSum);
      	$testDoneSum = $this->transform($testDoneSum);
      	$delayedTaskSum = $this->transform($delayedTaskSum);  
      	$delayedTasks = $this->transform($delayedTasks);

        $projects = explode(',', $projects->ids);
        $projectSum =count($projects);
        
        for($i=0;$i<$projectSum;$i++)
        {
        	$info[$projects[$i]]->projectInfo = $projectInfo[$i];
            $info[$projects[$i]]->storySum = $storySum[$projects[$i]];
            $info[$projects[$i]]->taskSum = $taskSum[$projects[$i]];
            $info[$projects[$i]]->develTaskSum = $develTaskSum[$projects[$i]];
            $info[$projects[$i]]->develTaskDoneSum = $develTaskDoneSum[$projects[$i]];
            $info[$projects[$i]]->testSum = $testSum[$projects[$i]];
            $info[$projects[$i]]->testDoneSum = $testDoneSum[$projects[$i]];
            $info[$projects[$i]]->delayedTaskSum = $delayedTaskSum[$projects[$i]];
            $info[$projects[$i]]->delayedTasks = $delayedTasks[$projects[$i]];
        }

        krsort($info);
        return $info;
}

/**
*
*/

public function transform($arr)
{
	$result = array();
	foreach ($arr as $value) {
		$result[$value->project] = $value->taskSum;
	}
	return $result;
}