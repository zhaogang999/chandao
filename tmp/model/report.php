<?php
global $app;
helper::cd($app->getBasePath());
helper::import('.\module\report\model.php');
helper::cd();
class extreportModel extends reportModel 
{
/**
 * get count of bug of Branch
 *
 * @param $product
 * @access public
 * @return object
*/
public function bugBranchStatistics($product)
{
    $data = new stdClass();

    $activedBugsPerBranch = $this->dao->select("branch, count(id) as bugs")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->eq($product)
        ->andWhere('status')->eq('active')
        ->groupBy('branch')
        ->fetchPairs();
    $bugsPerBranch = $this->dao->select("branch, count(id) as bugs")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->eq($product)
        ->groupBy('branch')
        ->fetchPairs();

    $data->activedBugs = $activedBugsPerBranch;
    $data->bugs = $bugsPerBranch;

    return $data;
}
/**
* bug解决周期&bug响应时间
*
* @access public
* @return array
*/
public function bugResponseTimeStatistics()
{
    $data = array();

    $products = $this->loadModel('product')->getPairs('noclosed');


    foreach ($products as $productID => $product)
    {
        $data[$productID] = $this->getBugStatisticsData($productID);
        $data[$productID]->productName = $product;
    }

    ksort($data);
    return $data;
}

/**
 * bug解决周期&bug响应时间 分项目
 *
 * @param  $productID string
 * @access public
 * @return object
 */
public function getBugStatisticsData($productID)
{
    $now = time();
    $data = new stdClass();
    $data->resolving1week   = 0;
    $data->resolving2weeks  = 0;
    $data->resolvinglong    = 0;
    $data->responsed1week   = 0;
    $data->responsed1weekbugs = array();
    $data->responsed2weeks  = 0;
    $data->responsed2weeksbugs = array();
    $data->responsedlong    = 0;
    $data->responsedlongbugs = array();

    $bugs = $this->dao->select('id,assignedDate,openedDate')->from(TABLE_BUG)
        ->where('product')->eq($productID)
        ->andWhere('deleted')->eq(0)
        ->andWhere('status')->eq('active')
        ->orderBy('id')
        ->fetchAll('id');

    foreach ($bugs as $bugID =>$bug)
    {
        $dif = ceil(($now-strtotime($bug->openedDate))/24/60/60);
        //var_dump($dif);die;
        switch ($dif)
        {
            case $dif < 7:
                $data->resolving1week++;
                break;
            case $dif>=7 && $dif<14:
                $data->resolving2weeks++;
                break;
            default:
                $data->resolvinglong++;
        }

        $responseTime = ceil(($now-strtotime($bug->assignedDate))/24/60/60);
        switch ($responseTime)
        {
            case $responseTime <7 :
                $data->responsed1week++;
                $data->responsed1weekbugs[] = $bugID;
                break;
            case $responseTime >=7 && $responseTime <= 14 :
                $data->responsed2weeks ++;
                $data->responsed2weeksbugs[] = $bugID;
                break;
            default :
                $data->responsedlong++;
                $data->responsedlongbugs[] = $bugID;
        }
    }

    return $data;
}
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
    $bugPriSum = $this->getBugSum($products->ids,'pri');
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
        $info[$products[$i]]->bugPriSum = isset($bugPriSum[$products[$i]])?$bugPriSum[$products[$i]]:0;
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
/**
* get info of burnup
*
 * @param $data object
* @access public
* @return array
*/
public function burnUp($data)
{
    $this->loadModel('project');

    $begin = $data['begin'];
    $end = $data['end'];

    $burnUpData = $this->dao->select('*')->from(TABLE_BURNUP)->where('project')->eq($data['project'])->andWhere('date')->between($begin,$end)->orderBy('date')->fetchAll('date');

    return $burnUpData;
}
/**
* get info of dailyBugStatistics
*
* @param $data array
* @return array
*/
public function dailyBugStatistics($data)
{
    $this->loadModel('project');

    $result = $this->dao->select('*')->from(TABLE_BUGREPORT)->where('product')->eq($data['product'])->andWhere('date')->between($data['begin'],$data['end'])->orderBy('date')->fetchAll('date');

    return $result;
}
/**
 * Build a search form
 *
 * @param $actionURL  string
 * @access public
 * @return void
 */
public function buildReportSearchForm($actionURL)
{
    $this->config->report->search['actionURL'] = $actionURL;
    $this->loadModel('search')->setSearchParams($this->config->report->search);
}

/**
 * Get patchBuilds of a project.
 *
 * @param  string    $orderBy
 * @param  string    $type
 * @param  object    $pager
 * @access public
 * @return array
 */
public function getScriptTask($orderBy = 'id_desc', $type  = 'byModule', $pager = null)
{
    if ($type == 'bySearch')
    {
        $reportQuery = $this->session->reportQuery;
        $reportQuery = preg_replace('/`(\w+)`/', 't1.`$1`', $reportQuery);
        $reportQuery = str_replace(array('t1.`storyTitle`','t1.`openedBy`'), array('t3.`title`','t3.`openedBy`'),$reportQuery);
        $reportQuery = str_replace(array('t1.`taskTitle`','t1.`finishedBy`','t1.`finishedDate`'), array('t2.`name`','t2.`finishedBy`','t2.`finishedDate`'), $reportQuery);
        $reportQuery = str_replace(array('t1.`planTitle`'), array('t4.`title`'), $reportQuery);

        return $this->dao->select('t1.*, t2.`id` as task, t2.`name` as taskTitle, t2.finishedBy, t2.finishedDate, t2.story, t3.title as storyTitle, t3.plan, t3.openedBy, t4.title as planTitle')
            ->from(TABLE_SCRIPT)->alias('t1')
            ->leftJoin(TABLE_TASK)->alias('t2')->on('t1.task = t2.id')
            ->leftJoin(TABLE_STORY)->alias('t3')->on('t2.story = t3.id')
            ->leftJoin(TABLE_PRODUCTPLAN)->alias('t4')->on('t3.plan = t4.id')
            ->where('t1.deleted')->eq(0)
            ->andWhere($reportQuery)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
    }
    else
    {
        return $this->dao->select('t1.*, t2.`id` as task, t2.`name` as taskTitle, t2.finishedBy, t2.finishedDate, t2.story, t3.title as storyTitle, t3.plan, t3.openedBy, t4.title as planTitle')
            ->from(TABLE_SCRIPT)->alias('t1')
            ->leftJoin(TABLE_TASK)->alias('t2')->on('t1.task = t2.id')
            ->leftJoin(TABLE_STORY)->alias('t3')->on('t2.story = t3.id')
            ->leftJoin(TABLE_PRODUCTPLAN)->alias('t4')->on('t3.plan = t4.id')
            ->where('t1.deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
    }
}

/**
 * Get script info.
 *
 * @param  int    $scriptID
 * @access public
 * @return object
 */
public function getScriptById($scriptID)
{
    $script = $this->dao->select('t1.*, t2.`name` as taskTitle, t2.finishedBy, t2.finishedDate, t2.story, t3.title as storyTitle, t3.plan, t3.openedBy, t4.title as planTitle, t5.spec')
        ->from(TABLE_SCRIPT)->alias('t1')
        ->leftJoin(TABLE_TASK)->alias('t2')->on('t1.task = t2.id')
        ->leftJoin(TABLE_STORY)->alias('t3')->on('t2.story = t3.id')
        ->leftJoin(TABLE_PRODUCTPLAN)->alias('t4')->on('t3.plan = t4.id')
        ->leftJoin(TABLE_STORYSPEC)->alias('t5')->on('t3.id = t5.story')
        ->where('t1.id')->eq((int)$scriptID)
        ->fetch();

    if(!$script) return false;

    //$build->files = $this->loadModel('file')->getByObject('patchBuild', $buildID);
    //if($setImgSize) $build->patchContent = $this->file->setImgSize($build->patchContent);
    return $script;
}
/**
 * Update a script.
 *
 * @param  int    $scriptID
 * @access public
 * @return void
 */
public function updateScript($scriptID)
{
    $oldScript = $this->getScriptById($scriptID);
    $script = fixer::input('post')
        ->stripTags($this->config->report->editor->editscript['id'], $this->config->allowedTags)
        //->join('mailto', ',')
        ->remove('taskID')
        ->get();
    
    $this->dao->update(TABLE_SCRIPT)->data($script)
        ->autoCheck()
        //->batchCheck($this->config->patchbuild->editBatchBuild->requiredFields, 'notempty')
        ->where('id')->eq((int)$scriptID)
        ->check("id != $scriptID AND deleted = '0'")
        ->exec();
    
    if(!dao::isError())
    {
        //$this->file->updateObjectID($this->post->uid, $buildID, 'build');
        return common::createChanges($oldScript, $script);
    }
}

public function undelete($scriptID)
{
    $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(0)->where('id')->eq($scriptID)->exec();
}
/**
 * get info of storyCycleSummary
 *
 * @param $project
 * @access public
 * @return array
*/
public function storyCycleSummary($project)
{
    $data =array();

    $this->loadModel('story');
    $this->loadModel('project');

    $stories = $this->story->getProjectStories($project,'id_desc');
    $projectInfo = $this->project->getByID($project);

    foreach ($stories as $storyID =>$story)
    {
        $tasks = $this->dao->select('id, name,type, status, estimate, consumed, assignedTo, estStarted, deadline, realStarted, finishedDate')
            ->from(TABLE_TASK)
            ->where('story')->eq((int)$storyID)
            ->andWhere('deleted')->eq(0)
            ->andWhere('project')->eq($project)
            ->fetchAll('id');

        $data[$storyID] = new stdClass();
        $data[$storyID]-> title = $story->title;
        $data[$storyID]->	estimate = 0;//预计消耗
        $data[$storyID]->	consumed = 0;//实际消耗
        $data[$storyID]->	developEstimate = 0; //开发预计
        $data[$storyID]->	testEstimate = 0; //测试预计
        $data[$storyID]->	developConsumed = 0; //开发消耗
        $data[$storyID]->	testConsumed = 0; //测试消耗

        foreach ($tasks as $task)
        {
            if ($task->deadline == '0000-00-00') $task->deadline = $projectInfo->end;
            if ($task->estimate == '0000-00-00') $task->estimate = $projectInfo->begin;
//var_dump($task);die;
            switch ($task->type)
            {
                case 'test':
                    $data[$storyID]->	estimate += $task->estimate;
                    $data[$storyID]->	consumed += $task->consumed;
                    if (!empty($task->assignedTo))
                    {
                        $data[$storyID]->	testEstimate += ceil((strtotime($task->deadline) - strtotime($task->estStarted))/60/60/24) + 1;
                    }
                    if ($task->status == 'done' || $task->status == 'closed')
                    {
                        $data[$storyID]->	testConsumed += ceil((strtotime($task->finishedDate) - strtotime($task->realStarted))/60/60/24) + 1;
                    }
                    break;
                case 'devel' || 'fos' || 'ios' || 'android' || 'sdk' || 'web':
                    $data[$storyID]->	estimate += $task->estimate;
                    $data[$storyID]->	consumed += $task->consumed;
                    if (!empty($task->assignedTo))
                    {
                        $data[$storyID]->	developEstimate += ceil((strtotime($task->deadline) - strtotime($task->estStarted))/60/60/24) + 1;
                    }
                    if ($task->status == 'done' || $task->status == 'closed')
                    {
                        $data[$storyID]->	developConsumed += ceil((strtotime($task->finishedDate) - strtotime($task->realStarted))/60/60/24) + 1;
                    }
                    break;
                default:
                    $data[$storyID]->	estimate += $task->estimate;
                    $data[$storyID]->	consumed += $task->consumed;
            }
        }
    }
    
    return $data;
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
        $zeroDevelTaskStories = $this->getZeroTaskStories($stories,$project, "fos, devel, sdk, web, ios, android");
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
/**
* get info of task
*
* @access public
* @return array
*/
public function taskSummary($data)
{
	$info = array();
    $echartData = array();
    $result = array();

    $begin = $data->begin;
    $end = $data->end;
    $projects = $data->project;
    asort($projects);
    $projects = trim(implode(',', $projects), ',');

    $taskSumSql = "SELECT `project`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN(" .$projects . ") AND deleted='0' GROUP BY `project`";
    $develTaskStatusSum = $this->dao->select(" `project`,`status`,COUNT( `id` ) AS taskSum")->from(TABLE_TASK)->where('project')->in("$projects")->andWhere('type')->in("fos,devel,sdk,web,ios,android")->andWhere('deleted')->eq('0')->groupBy('project,status')->fetchGroup('project','status');
    $testStatusSum = $this->dao->select(" `project`,`status`,COUNT( `id` ) AS taskSum")->from(TABLE_TASK)->where('project')->in("$projects")->andWhere('type')->in("test")->andWhere('deleted')->eq('0')->groupBy('project,status')->fetchGroup('project','status');
    $storyTaskStatusSum = $this->dao->select(" `project`,`status`,COUNT( `id` ) AS taskSum")->from(TABLE_TASK)->where('project')->in("$projects")->andWhere('type')->in("ra")->andWhere('deleted')->eq('0')->groupBy('project,status')->fetchGroup('project','status');
    $delayedTaskSumSql = "SELECT `project`,COUNT(`id`) AS taskSum FROM zt_task WHERE `project` IN (" .$projects . ") AND curdate()>deadline AND `status` not IN ('done','closed','cancel') AND deadline != '0000-00-00' AND deleted='0' GROUP BY `project`";

    $taskSum = $this->dao->query($taskSumSql)->fetchAll();
    $delayedTaskSum = $this->dao->query($delayedTaskSumSql)->fetchAll();
    $projectInfo = $this->dao->select("id,name,code")->from(TABLE_PROJECT)->where('id')->in($projects)->fetchAll();

    $echartData['testTaskStatusCount'] = $this->taskStatusCount("'test'", $projects);
    $echartData['develTaskStatusCount'] = $this->taskStatusCount("'fos', 'devel', 'sdk', 'web', 'ios', 'android'", $projects);
    $echartData['storyTaskStatusCount'] = $this->taskStatusCount("'ra'", $projects);

    //对数据进行处理
    $taskSum = $this->transform($taskSum);
    $delayedTaskSum = $this->transform($delayedTaskSum);

    $undoneTaskCount = $this->undoneTaskCount($projects, $begin, $end);
    //var_dump($undoneTaskCount);die;
    //$undoneTaskByType = $this->undoneTaskByType($projects);
    $undoneTaskByType = $this->dao->select('project,type,COUNT(id) as taskSum')->from(TABLE_TASK)->where('project')->in($projects)->andWhere('deleted')->eq('0')->andWhere('type')->in('fos,devel,sdk,web,ios,android')->andWhere('status')->in('wait,doing,pause')->groupBy('project,type')->fetchGroup('project','type');
    $finishedTasksPerDay = $this->finishedTasksPerDay($projects, $begin, $end);
    
    $projects = explode(',', $projects);
    $newDevelTaskStatusSum  = $this->taskStatusCountOfProject($projects,$develTaskStatusSum);
    $newTestStatusSum       = $this->taskStatusCountOfProject($projects,$testStatusSum);
    $newStoryTaskStatusSum  = $this->taskStatusCountOfProject($projects,$storyTaskStatusSum);

    $projectSum =count($projects);

    for($i=0;$i<$projectSum;$i++)
    {
        $info[$projects[$i]] = new stdClass();
        $info[$projects[$i]]->projectInfo = $projectInfo[$i];
        $info[$projects[$i]]->taskSum = isset($taskSum[$projects[$i]])?$taskSum[$projects[$i]]:0;

        $info[$projects[$i]]->develTaskSum = $newDevelTaskStatusSum[$projects[$i]]['undone'] + $newDevelTaskStatusSum[$projects[$i]]['doneTask'];
        $info[$projects[$i]]->newDevelTaskStatusSum = isset($newDevelTaskStatusSum[$projects[$i]])?$newDevelTaskStatusSum[$projects[$i]]:0;

        $info[$projects[$i]]->testSum = $newTestStatusSum[$projects[$i]]['undone'] + $newTestStatusSum[$projects[$i]]['doneTask'];
        $info[$projects[$i]]->newTestStatusSum = isset($newTestStatusSum[$projects[$i]])?$newTestStatusSum[$projects[$i]]:0;

        $info[$projects[$i]]->storyTaskSum = $newStoryTaskStatusSum[$projects[$i]]['undone'] + $newStoryTaskStatusSum[$projects[$i]]['doneTask'];
        $info[$projects[$i]]->newStoryTaskStatusSum = isset($newStoryTaskStatusSum[$projects[$i]])?$newStoryTaskStatusSum[$projects[$i]]:0;
        $info[$projects[$i]]->delayedTaskSum = isset($delayedTaskSum[$projects[$i]])?$delayedTaskSum[$projects[$i]]:0;
    }

    krsort($info);
    $result['info'] = $info;
    $result['echartData'] = $echartData;
    $result['undoneTaskCount'] = $undoneTaskCount;
    $result['undoneTaskByType'] = $undoneTaskByType;
    $result['finishedTasksPerDay'] = $finishedTasksPerDay;

    return $result;
}

/**
 * 获取每日完成的开发任务数
 * 
 * @param $projects
 * @param $begin
 * @param $end
 * @return array
 */
public function finishedTasksPerDay($projects, $begin, $end)
{
    $finishedTasksPerDay = $this->dao->select("project,DATE_FORMAT(finishedDate,'%Y-%m-%d') AS date, COUNT(id) AS value")->from(TABLE_TASK)->where('project')->in($projects)->andWhere('deleted')->eq('0')->andWhere('type')->in('fos,devel,sdk,web,ios,android')->groupBy('finishedDate')->having("date != '0000-00-00' AND date>='$begin' AND date<='$end'")->orderBy('project,finishedDate')->fetchGroup('date','project');
    
    $begin = strtotime($begin);
    $end = strtotime($end);
    $dataOfFinishedTaskPerDay = array();
    $projects = explode(',', $projects);
    $dateTime = $begin;
    while ($dateTime <= $end)
    {
        $key = date('Y-m-d', $dateTime);
        $date[$key] = $key;
        foreach ($projects as $val)
        {
            $dataOfFinishedTaskPerDay[$key][$val] = isset($finishedTasksPerDay[$key][$val])?$finishedTasksPerDay[$key][$val]->value:0;
        }
        $dateTime = strtotime('+1 day',$dateTime);
    }
    
    return $dataOfFinishedTaskPerDay;
}

/**
 * 获取未完成任务的统计数据
 * 
 * @param $projects
 * @param $begin
 * @param $end
 * @return stdClass
 */
public function undoneTaskCount($projects, $begin, $end)
{
    $undoneTaskCount = $this->dao->select('*')->from(TABLE_UNDONETASKREPORT)->where('project')->in($projects)->andWhere('date')->between($begin,$end)->fetchGroup('date','project');
    $projects = explode(',', $projects);

    foreach ($undoneTaskCount as $date => $value)
    {
        foreach ($projects as $val)
        {
            if (!isset($value[$val]))
            {
                $undoneTaskCount[$date][$val] = new stdClass();
                $undoneTaskCount[$date][$val]->project = $val;
                $undoneTaskCount[$date][$val]->date = $date;
                $undoneTaskCount[$date][$val]->undoneStoryTaskCount = 0;
                $undoneTaskCount[$date][$val]->undoneDevelTaskCount = 0;
                $undoneTaskCount[$date][$val]->undoneTestTaskCount  = 0;
            }
        }
    }

    ksort($undoneTaskCount);
    return $undoneTaskCount;
}

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
    $doneTaskCountSql = "SELECT COUNT(id) AS  taskSum FROM zt_task WHERE deleted='0' AND `project` IN (" .$projects . ") AND `status`!='cancel' AND `status` IN ('done','closed') AND `type` IN (" . $type . ")";
    $taskCount = $this->dao->query($taskCountSql)->fetch();
    $doneTaskCount = $this->dao->query($doneTaskCountSql)->fetch();

    $result['taskCount'] = $taskCount->taskSum;
    $result['doneTaskCount'] = $doneTaskCount->taskSum;
    $result['undoneTaskCount'] = $taskCount->taskSum - $doneTaskCount->taskSum;
    $result['doneTaskCountPercent'] = round($doneTaskCount->taskSum/$taskCount->taskSum, 2)*100 . '%';
    $result['undoneTaskCountPercent'] = round($result['undoneTaskCount']/$taskCount->taskSum, 2)*100 . '%';
    return $result;
}

/**
 * 按任务状态对项目的任务进行统计
 *
 * @param  $projects
 * @param $data
 * @return array
 */
public function taskStatusCountOfProject ($projects, $data)
{
    $newData = array();

    foreach ($projects as $project)
    {
        $newData[$project]['wait']= isset($data[$project]['wait']->taskSum)?$data[$project]['wait']->taskSum:0;
        $newData[$project]['doing']= isset($data[$project]['doing']->taskSum)?$data[$project]['doing']->taskSum:0;
        $newData[$project]['done']= isset($data[$project]['done']->taskSum)?$data[$project]['done']->taskSum:0;
        $newData[$project]['pause']= isset($data[$project]['pause']->taskSum)?$data[$project]['pause']->taskSum:0;
        $newData[$project]['cancel']= isset($data[$project]['cancel']->taskSum)?$data[$project]['cancel']->taskSum:0;
        $newData[$project]['closed']= isset($data[$project]['closed']->taskSum)?$data[$project]['closed']->taskSum:0;
        $newData[$project]['doneTask'] = $newData[$project]['done'] + $newData[$project]['closed'];
        $newData[$project]['undone'] = $newData[$project]['wait'] + $newData[$project]['doing'] + $newData[$project]['pause'];
    }

    return $newData;
}
//**//
}