<?php
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
        z WHERE z.deadline>z.new OR (z.deadline=z.new AND z.old!='0000-00-00' AND z.deadline>z.old) GROUP BY z.project";
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
    
    return $tasksum;
}
