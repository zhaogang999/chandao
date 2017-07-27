<?php
global $app;
helper::cd($app->getBasePath());
helper::import('.\module\report\model.php');
helper::cd();
class extreportModel extends reportModel 
{
/**
* 获得bug统计数据
*
* @access public
* @return array
*/
public function bugSummary()
{
	$info = array();
    //获得要统计的产品及产品标题
    $products = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PRODUCT)->where('status')->eq('normal')->andWhere('deleted')->eq('0')->fetch();
    $productInfo = $this->dao->select("id,name")->from(TABLE_PRODUCT)->where('status')->eq('normal')->andWhere('deleted')->eq('0')->fetchAll();
    //获得bug总数
    $bugSumSql = "SELECT `product`,COUNT(`id`) AS bugSum FROM zt_bug WHERE `product` IN(" .$products->ids . ") AND deleted='0' AND `status`!='closed' GROUP BY `product`";
    //获得转需求bug总数
    $bugToStorySumSql = "SELECT `product`,COUNT(`id`) AS bugSum FROM zt_bug WHERE `product` IN(" .$products->ids . ") AND deleted='0' AND `resolution`='tostory' GROUP BY `product`";

    $bugSum = $this->dao->query($bugSumSql)->fetchAll();
    $bugToStorySum = $this->dao->query($bugToStorySumSql)->fetchAll();
    //对数据进行处理
    $newBugSum = array();
    foreach ($bugSum as $value) {
        $newBugSum[$value->product] = $value->bugSum;
    }
    $newBugToStorySum = array();
    foreach ($bugToStorySum as $val)
    {
        $newBugToStorySum[$val->product] = $val->bugSum;
    }

    //获得bug各分类的统计数据
    //按严重程度统计
    $bugSeveritySum = $this->getBugSum($products->ids,'severity');
    //按bug状态统计
    $bugStatusSum = $this->getBugSum($products->ids,'status');
    //按解决方案统计
    $bugResolutionSum = $this->getBugSum($products->ids,'resolution');
    //对数据进行处理，把得到的数据按产品整合到一起
    $products = explode(',', $products->ids);
    $productSum =count($products);
    for($i=0;$i<$productSum;$i++)
    {
        $info[$products[$i]] = new stdClass();
        $info[$products[$i]]->productInfo = $productInfo[$i];
        $info[$products[$i]]->bugSum = isset($newBugSum[$products[$i]])?$newBugSum[$products[$i]]:0;
        $info[$products[$i]]->bugToStorySum = isset($newBugToStorySum[$products[$i]])?$newBugToStorySum[$products[$i]]:0;
        $info[$products[$i]]->bugSeveritySum = isset($bugSeveritySum[$products[$i]])?$bugSeveritySum[$products[$i]]:0;
        $info[$products[$i]]->bugStatusSum = isset($bugStatusSum[$products[$i]]) ? $bugStatusSum[$products[$i]]: 0;
        $info[$products[$i]]->bugResolutionSum = isset($bugResolutionSum[$products[$i]])?$bugResolutionSum[$products[$i]]:0;
    }
    //按产品ID倒序
    krsort($info);
    return $info;
}

/**
 * 按bug个分类统计数据
 *
 * @param string $productIDs
 * @param string $sort
 * @return array
*/
public function getBugSum($productIDs,$sort)
{
    $sql = "SELECT `product`,`" . $sort . "`,COUNT( `id` ) AS bugSum FROM zt_bug WHERE `product` IN (" .$productIDs . ") AND deleted = '0' AND `status`!='closed' GROUP BY `product`,`" .$sort . "`";
    $data = $this->dao->query($sql)->fetchAll();
    //对数据进行处理，把得到的数据按产品整合到一起
    $newData = array();
    foreach ($data as $val)
    {
        $newData[$val->product][$val->$sort]= $val->bugSum;
    }
    return $newData;
}
public function getUndoneTaskCount()
{
    $projects = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetch();
    $undoneDevelTaskCount = $this->dao->select('project, count(id) as undoneDevelCount')->from(TABLE_TASK)->where('deleted')->eq('0')->andWhere('status')->in('wait, doing, pause')->andWhere('type')->in('fos, devel, sdk, web, ios, android')->andWhere('project')->in($projects->ids)->groupBy('project')->fetchAll('project');
    $undoneTestTaskCount = $this->dao->select('project, count(id) as undoneTestCount')->from(TABLE_TASK)->where('deleted')->eq('0')->andWhere('status')->in('wait, doing, pause')->andWhere('type')->in('test')->andWhere('project')->in($projects->ids)->groupBy('project')->fetchAll('project');

    $projects = explode(',', $projects->ids);
    foreach($projects as $project)
    {
        $data = new stdClass();
        $data->project = $project;
        $data->date = date('Y-m-d');
        $data->undoneDevelTaskCount = isset($undoneDevelTaskCount[$project])?$undoneDevelTaskCount[$project]->undoneDevelCount:0;
        $data->undoneTestTaskCount = isset($undoneTestTaskCount[$project])?$undoneTestTaskCount[$project]->undoneTestCount:0;
        $this->dao->insert(TABLE_UNDONETASKREPORT)->data($data)->exec();
    }
}
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
* get info of storyTask
*
* @access public
* @return array
*/
public function storyTaskSummary()
{
	$info = array();

    $projects = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetch();

    $storyTaskStatusSumSql = "SELECT `project`,`status`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN (" .$projects->ids . ") AND deleted='0' AND `type` IN ('ra','design','ui') GROUP BY `project`,`status`";

    $storyTaskStatusSum = $this->dao->query($storyTaskStatusSumSql)->fetchAll();

    $projectInfo = $this->dao->select("id,name")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetchAll();

    $projects = explode(',', $projects->ids);
    $projectSum =count($projects);

    $newStoryTaskStatusSum = array();
    foreach ($storyTaskStatusSum as $val)
    {
        $newStoryTaskStatusSum[$val->project][$val->status]= $val->taskSum;
    }

    for($i=0;$i<$projectSum;$i++)
    {
        $info[$projects[$i]] = new stdClass();
        $info[$projects[$i]]->projectInfo = $projectInfo[$i];
        $info[$projects[$i]]->newStoryTaskStatusSum = isset($newStoryTaskStatusSum[$projects[$i]])?$newStoryTaskStatusSum[$projects[$i]]:0;
    }

    krsort($info);
    return $info;
}
/**
* get info of taskPlan
*
* @access public
* @return array
*/
public function taskPlanSummary()
{
    $projects = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetch();
        $sumSql = "SELECT z.project,z.`name`,COUNT(DISTINCT z.taskID) AS taskCount,GROUP_CONCAT(DISTINCT z.taskID) AS ids FROM(
            SELECT l.project,l.`name`,GROUP_CONCAT(DISTINCT l.objectID) AS taskID,l.old,l.new,l.deadline FROM(
            SELECT a.project,p.`name`,a.objectID,h.old,h.new,t.deadline
            FROM zt_action AS a LEFT JOIN zt_history AS h 
            ON a.id=h.action 
            LEFT JOIN zt_task AS t
            ON a.objectID=t.id
            LEFT JOIN zt_project AS p
            ON a.project=p.id
            WHERE a.objectType='task' AND h.field='deadline' AND t.`status` IN('wait','doing','pause') 
            AND t.deleted='0' AND p.deleted='0' AND p.`status`!='done'
            ) 
            l GROUP BY l.objectID
            )
            z WHERE z.deadline>=z.new GROUP BY z.project ORDER BY z.project DESC";
    $delaySql = "SELECT z.project,COUNT(DISTINCT z.taskID) AS taskCount,GROUP_CONCAT(DISTINCT z.taskID) AS ids FROM(
        SELECT l.project,GROUP_CONCAT(DISTINCT l.objectID) AS taskID,l.old,l.new,l.deadline FROM(
        SELECT a.project,a.objectID,h.old,h.new,t.deadline
        FROM zt_action AS a LEFT JOIN zt_history AS h 
        ON a.id=h.action 
        LEFT JOIN zt_task AS t
        ON a.objectID=t.id
        LEFT JOIN zt_project AS p
        ON a.project=p.id
        WHERE a.objectType='task' AND h.field='deadline' AND t.`status` IN('wait','doing','pause') 
        AND t.deleted='0' AND p.deleted='0' AND p.`status`!='done'
        ) 
        l GROUP BY l.objectID
        )
        z WHERE z.deadline>z.new OR (z.deadline=z.new AND z.old!='0000-00-00') GROUP BY z.project";
    $planSql = "SELECT z.project,COUNT(DISTINCT z.taskID) AS taskCount,GROUP_CONCAT(DISTINCT z.taskID) AS ids FROM(
        SELECT l.project,GROUP_CONCAT(DISTINCT l.objectID) AS taskID,l.old,l.new,l.deadline FROM(
        SELECT a.project,a.objectID,h.old,h.new,t.deadline
        FROM zt_action AS a LEFT JOIN zt_history AS h 
        ON a.id=h.action 
        LEFT JOIN zt_task AS t
        ON a.objectID=t.id
        LEFT JOIN zt_project AS p
        ON a.project=p.id
        WHERE a.objectType='task' AND h.field='deadline' AND t.`status` IN('wait','doing','pause') AND t.deleted='0' AND p.deleted='0' AND p.`status`!='done'
        ) 
        l GROUP BY l.objectID
        )
        z WHERE z.deadline=z.new AND z.old='0000-00-00'  GROUP BY z.project";

    $noPlanTaskSql = "SELECT t.project,COUNT(DISTINCT t.id) AS taskCount,GROUP_CONCAT(t.id) AS ids FROM zt_task AS t
          LEFT JOIN zt_project  as p ON t.project = p.id
          WHERE t.deadline = '0000-00-00' AND t.deleted='0' AND t.`status` IN('wait','pause','doing')  AND p.`status`!='done' AND p.deleted = '0' GROUP BY t.project";

    $undoneAbnormalPlanTasksSql = "SELECT t.project,COUNT(DISTINCT t.id) AS taskCount,GROUP_CONCAT(t.id) AS ids FROM zt_task AS t
            LEFT JOIN zt_project  as p ON t.project = p.id
            WHERE TIMESTAMPDIFF(day,t.estStarted,t.deadline)>7 AND t.deleted='0' AND t.`status` IN('wait','pause','doing')  AND p.`status`!='done' AND p.deleted = '0' GROUP BY t.project";
    $doneAbnormalPlanTasksSql = "SELECT t.project,COUNT(DISTINCT t.id) AS taskCount,GROUP_CONCAT(t.id) AS ids FROM zt_task AS t
            LEFT JOIN zt_project  as p ON t.project = p.id
            WHERE TIMESTAMPDIFF(day,t.estStarted,t.deadline)>7 AND t.deleted='0' AND t.`status` IN('done','closed')  AND p.`status`!='done' AND p.deleted = '0' GROUP BY t.project";

    $sum = $this->dao->query($sumSql)->fetchAll();
    $delay = $this->dao->query($delaySql)->fetchAll();
    $plan = $this->dao->query($planSql)->fetchAll();
    $noPlanTasks= $this->dao->query($noPlanTaskSql)->fetchAll();
    $undoneAbnormalPlanTasks = $this->dao->query($undoneAbnormalPlanTasksSql)->fetchAll();
    $doneAbnormalPlanTasks = $this->dao->query($doneAbnormalPlanTasksSql)->fetchAll();
    /*1086 统计项目内任务截止时间是否有修改，并增加链接直接定位任务  #4 */
    $tasksum = array();

    $IDs = ',';
    foreach ($sum as $value)
    {
        $tasksum[$value->project]['taskCount'] = $value->taskCount;
        //$tasksum[$value->project]['name'] = $value->name;
        $IDs .= $value->ids . ',';
    }

    $IDs = trim($IDs, ',');
    $dateAjustmentSql = "SELECT GROUP_CONCAT(DISTINCT l.objectID) AS taskID,l.date FROM(
		SELECT a.objectID,a.date
        FROM zt_action AS a LEFT JOIN zt_history AS h 
        ON a.id=h.action 
        WHERE a.objectID IN ($IDs) AND h.field='deadline'
        ORDER BY a.date DESC
        ) l GROUP BY l.objectID";
    $dateAjustment = $this->dao->query($dateAjustmentSql)->fetchAll();
    $dateAjustmentAB = array();
    foreach ($dateAjustment as $value)
    {
        $dateAjustmentAB[$value->taskID] = date('Y-m-d', strtotime($value->date));
    }

    foreach ($delay as $value)
    {
        $tasksum[$value->project]['delayTaskCount'] = $value->taskCount;
        $value->ids = explode( ',', $value->ids);
        foreach ($value->ids as $val)
        {
            $tasksum[$value->project]['delayTaskIDs'][$val] = $dateAjustmentAB[$val];
        }
        arsort($tasksum[$value->project]['delayTaskIDs']);
    }
    foreach ($plan as $value)
    {
        $tasksum[$value->project]['planTaskCount'] = $value->taskCount;
        $value->ids = explode( ',', $value->ids);
        foreach ($value->ids as $val)
        {
            $tasksum[$value->project]['planTaskIDs'][$val] = $dateAjustmentAB[$val];
        }
        arsort($tasksum[$value->project]['planTaskIDs']);
    }
    //var_dump($noPlanTasks);die;
    foreach ($noPlanTasks as $value)
    {
        $tasksum[$value->project]['noPlanTaskCount'] = $value->taskCount;
        $value->ids = explode( ',', $value->ids);
        foreach ($value->ids as $val)
        {
            $tasksum[$value->project]['noPlanTaskIDs'][$val] = $val;
        }
        arsort($tasksum[$value->project]['noPlanTaskIDs']);
    }
    foreach ($undoneAbnormalPlanTasks as $value)
    {
        //$tasksum[$value->project]['abnormalPlanTaskCount'] = $value->taskCount;
        $value->ids = explode( ',', $value->ids);
        foreach ($value->ids as $val)
        {
            $tasksum[$value->project]['undoneAbnormalPlanTaskIDs'][$val] = $val;
        }
    }
    foreach ($doneAbnormalPlanTasks as $value)
    {
        //$tasksum[$value->project]['abnormalPlanTaskCount'] = $value->taskCount;
        $value->ids = explode( ',', $value->ids);
        foreach ($value->ids as $val)
        {
            $tasksum[$value->project]['doneAbnormalPlanTaskIDs'][$val] = $val;
        }
    }
    //var_dump($tasksum);die;
    //var_dump($tasksum);die;
    return $tasksum;
}
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
//**//
}