<?php
global $app;
helper::cd($app->getBasePath());
helper::import('.\module\story\model.php');
helper::cd();
class extstoryModel extends storyModel 
{
public function setListValue($productID, $branch = 0)
{
    return $this->loadExtension('excel')->setListValue($productID, $branch);
}

public function createFromImport($productID, $branch = 0)
{
    return $this->loadExtension('excel')->createFromImport($productID, $branch);
}
/**
 * Link stories.
 *
 * @param  int    $storyID
 * @param  string $type
 * @access public
 * @return void
 */
public function linkStories($storyID, $type = 'linkStories')
{
    if($this->post->stories == false) return;

    $story        = $this->getById($storyID);
    $stories2Link = $this->post->stories;
    $stories = implode(',', $stories2Link) . ',' . trim($story->$type, ',');

    $this->dao->update(TABLE_STORY)->set($type)->eq(trim($stories, ','))->where('id')->eq($storyID)->exec();
    if(dao::isError()) die(js::error(dao::getError()));

    $action = ($type == 'linkStories') ? 'linkRelatedStory' : 'subdivideStory';
    $this->loadModel('action')->create('story', $storyID, $action, '', implode(',', $stories2Link));
//需求双向关联
    if ($type == 'linkStories')
    {
        foreach ($stories2Link as $val)
        {
            $linkStories = $this->dao->select('linkStories')->FROM(TABLE_STORY)->where('id')->eq(trim($val, ','))->fetch();
            $linkStoriesAB = $linkStories->linkStories .','. $storyID;

            $this->dao->update(TABLE_STORY)->set($type)->eq(trim($linkStoriesAB, ','))->where('id')->eq(trim($val, ','))->exec();
            if(dao::isError()) die(js::error(dao::getError()));

            $action = ($type == 'linkStories') ? 'linkRelatedStory' : 'subdivideStory';
            $this->loadModel('action')->create('story', $val, $action, '', $storyID);
        }
    }
}
/**
 * Print cell data
 *
 * @param  object $col
 * @param  object $story
 * @param  array  $users
 * @param  array  $branches
 * @param  array  $storyStages
 * @param  array  $modulePairs
 * @param  array  $storyTasks
 * @param  array  $storyBugs
 * @param  array  $storyCases
 * @access public
 * @return void
 */
public function printCell($col, $story, $users, $branches, $storyStages, $modulePairs = array(), $storyTasks, $storyBugs, $storyCases)
{
    $storyLink = helper::createLink('story', 'view', "storyID=$story->id");
    $account   = $this->app->user->account;
    $id        = $col->id;
    if($col->show)
    {
        $class = '';
        if($id == 'status') $class .= ' story-' . $story->status;
        if($id == 'title') $class .= ' text-left';
        if($id == 'assignedTo' && $story->assignedTo == $account) $class .= ' red';

        $title = '';
        if($id == 'title') $title = $story->title;
        if($id == 'plan')  $title = $story->planTitle;

        echo "<td class='" . $class . "' title='$title'>";
        switch ($id)
        {
            case 'id':
                echo html::a($storyLink, sprintf('%03d', $story->id));
                break;
            case 'pri':
                echo "<span class='pri" . zget($this->lang->story->priList, $story->pri, $story->pri) . "'>";
                echo zget($this->lang->story->priList, $story->pri, $story->pri);
                echo "</span>";
                break;
            case 'title':
                if($story->branch) echo "<span class='label label-info label-badge'>{$branches[$story->branch]}</span> ";
                if($modulePairs and $story->module) echo "<span class='label label-info label-badge'>{$modulePairs[$story->module]}</span> ";
                echo html::a($storyLink, $story->title, null, "style='color: $story->color'");
                break;
            case 'plan':
                echo $story->planTitle;
                break;
            case 'branch':
                echo $branches[$story->branch];
                break;
            //1522 增加产品需求所关联的需求和已细分需求的显示
            case 'childStories':
                echo $story->childStories;
                break;
            case 'linkStories':
                echo $story->linkStories;
                break;
            
            case 'source':
                echo zget($this->lang->story->sourceList, $story->source, $story->source);
                break;
            case 'status':
                echo $this->lang->story->statusList[$story->status];
                break;
            case 'estimate':
                echo $story->estimate;
                break;
            case 'stage':
                echo "<div" . (isset($storyStages[$story->id]) ? " class='popoverStage' data-toggle='popover' data-placement='bottom' data-target='\$next'" : '') . "'>";
                echo $this->lang->story->stageList[$story->stage];
                if(isset($storyStages[$story->id])) echo "<span><i class='icon icon-caret-down'></i></span>";
                echo '</div>';
                if(isset($storyStages[$story->id]))
                {
                    echo "<div class='popover'>";
                    foreach($storyStages[$story->id] as $storyBranch => $storyStage) echo $branches[$storyBranch] . ": " . $this->lang->story->stageList[$storyStage->stage] . '<br />';
                    echo "</div>";
                }
                break;
            case 'taskCount':
                $tasksLink = helper::createLink('story', 'tasks', "storyID=$story->id");
                $storyTasks[$story->id] > 0 ? print(html::a($tasksLink, $storyTasks[$story->id], '', 'class="iframe"')) : print(0);
                break;
            case 'bugCount':
                $bugsLink = helper::createLink('story', 'bugs', "storyID=$story->id");
                $storyBugs[$story->id] > 0 ? print(html::a($bugsLink, $storyBugs[$story->id], '', 'class="iframe"')) : print(0);
                break;
            case 'caseCount':
                $casesLink = helper::createLink('story', 'cases', "storyID=$story->id");
                $storyCases[$story->id] > 0 ? print(html::a($casesLink, $storyCases[$story->id], '', 'class="iframe"')) : print(0);
                break;
            case 'openedBy':
                echo zget($users, $story->openedBy, $story->openedBy);
                break;
            case 'openedDate':
                echo substr($story->openedDate, 5, 11);
                break;
            case 'assignedTo':
                echo zget($users, $story->assignedTo, $story->assignedTo);
                break;
            case 'assignedDate':
                echo substr($story->assignedDate, 5, 11);
                break;
            case 'reviewedBy':
                echo zget($users, $story->reviewedBy, $story->reviewedBy);
                break;
            case 'reviewedDate':
                echo substr($story->reviewedDate, 5, 11);
                break;
            case 'closedBy':
                echo zget($users, $story->closedBy, $story->closedBy);
                break;
            case 'closedDate':
                echo substr($story->closedDate, 5, 11);
                break;
            case 'closedReason':
                echo zget($this->lang->story->reasonList, $story->closedReason, $story->closedReason);
                break;
            case 'actions':
                $vars = "story={$story->id}";
                common::printIcon('story', 'change',     $vars, $story, 'list', 'random');
                common::printIcon('story', 'review',     $vars, $story, 'list', 'review');
                common::printIcon('story', 'close',      $vars, $story, 'list', 'off', '', 'iframe', true);
                common::printIcon('story', 'edit',       $vars, $story, 'list', 'pencil');
                if($this->config->global->flow != 'onlyStory') common::printIcon('story', 'createCase', "productID=$story->product&branch=$story->branch&module=0&from=&param=0&$vars", $story, 'list', 'sitemap');
                break;
        }
        echo '</td>';
    }
}
/**
 * Get stories through search.
 *
 * @access public
 * @param  int    $productID
 * @param  int    $queryID
 * @param  string $orderBy
 * @param  object $pager
 * @param  string $projectID
 * @access public
 * @return array
 */
public function getBySearch($productID, $queryID, $orderBy, $pager = null, $projectID = '', $branch = 0)
{
    if($projectID != '')
    {
        $products = $this->loadModel('project')->getProducts($projectID);
    }
    else
    {
        $products = $this->loadModel('product')->getPairs();
    }
    $query = $queryID ? $this->loadModel('search')->getQuery($queryID) : '';

    /* Get the sql and form status from the query. */
    if($query)
    {
        $this->session->set('storyQuery', $query->sql);
        $this->session->set('storyForm', $query->form);
    }
    if($this->session->storyQuery == false) $this->session->set('storyQuery', ' 1 = 1');

    $allProduct     = "`product` = 'all'";
    $storyQuery     = $this->session->storyQuery;
    $queryProductID = $productID;
    if(strpos($storyQuery, $allProduct) !== false)
    {
        $storyQuery     = str_replace($allProduct, '1', $storyQuery);
        $queryProductID = 'all';
    }
    $storyQuery = $storyQuery . ' AND `product` ' . helper::dbIN(array_keys($products));
    if($projectID != '')
    {
        foreach($products as $product) $branches[$product->branch] = $product->branch;
        unset($branches[0]);
        $branches = join(',', $branches);
        if($branches) $storyQuery .= " AND `branch`" . helper::dbIN("0,$branches");
        if($this->app->moduleName == 'release' or $this->app->moduleName == 'build')
        {
            $storyQuery .= " AND `status` NOT IN ('draft')";// Fix bug #990.
        }
        else
        {
            $storyQuery .= " AND `status` NOT IN ('draft', 'closed')";
        }
    }
    elseif($branch)
    {
        $allBranch = "`branch` = 'all'";
        //跨产品关联需求时无法搜到预期结果
        //if($branch and strpos($storyQuery, '`branch` =') === false) $storyQuery .= " AND `branch` in('0','$branch')";

        if(strpos($storyQuery, $allBranch) !== false) $storyQuery = str_replace($allBranch, '1', $storyQuery);
    }
    $storyQuery = preg_replace("/`plan` +LIKE +'%([0-9]+)%'/i", "CONCAT(',', `plan`, ',') LIKE '%,$1,%'", $storyQuery);

    return $this->getBySQL($queryProductID, $storyQuery, $orderBy, $pager);
}

/**
 * Get stories by a sql.
 *
 * @param  int    $productID
 * @param  string $sql
 * @param  string $orderBy
 * @param  object $pager
 * @access public
 * @return array
 */
public function getBySQL($productID, $sql, $orderBy, $pager = null)
{
    /* Get plans. */
    $plans = $this->dao->select('id,title')->from(TABLE_PRODUCTPLAN)
        ->where('deleted')->eq('0')
        ->beginIF($productID != 'all' and $productID != '')->andWhere('product')->eq((int)$productID)->fi()
        ->fetchPairs();

    $tmpStories = $this->dao->select('*')->from(TABLE_STORY)->where($sql)
        //跨产品需求搜索无法搜到结果；
        ->beginIF($productID != 'all' and strpos($sql, "`product` =") === false)->andWhere('product')->eq((int)$productID)->fi()
        // ->beginIF($productID != 'all' and $productID != '')->andWhere('product')->eq((int)$productID)->fi()

        ->andWhere('deleted')->eq(0)
        ->orderBy($orderBy)
        ->page($pager)
        ->fetchAll('id');

    if(!$tmpStories) return array();

    /* Process plans. */
    $stories = array();
    foreach($tmpStories as $story)
    {
        $story->planTitle = '';
        $storyPlans = explode(',', trim($story->plan, ','));
        foreach($storyPlans as $planID) $story->planTitle .= zget($plans, $planID, '') . ' ';
        $stories[] = $story;
    }
    return $stories;
}
/**
 * Send mail
 *
 * @param  int    $storyID
 * @param  int    $actionID
 * @access public
 * @return void
 */
public function sendmail($storyID, $actionID)
{
    $this->loadModel('mail');
    $story       = $this->getById($storyID);
    $productName = $this->loadModel('product')->getById($story->product)->name;
    $users       = $this->loadModel('user')->getPairs('noletter');

    /* Get actions. */
    $action  = $this->loadModel('action')->getById($actionID);
    $history = $this->action->getHistory($actionID);
    $action->history    = isset($history[$actionID]) ? $history[$actionID] : array();
    $action->appendLink = '';
    if(strpos($action->extra, ':')!== false)
    {
        list($extra, $id) = explode(':', $action->extra);
        $action->extra    = $extra;
        if($id)
        {
            $name  = $this->dao->select('title')->from(TABLE_STORY)->where('id')->eq($id)->fetch('title');
            if($name) $action->appendLink = html::a(zget($this->config->mail, 'domain', common::getSysURL()) . helper::createLink($action->objectType, 'view', "id=$id"), "#$id " . $name);
        }
    }

    /* Get mail content. */
    $modulePath = $this->app->getModulePath($appName = '', 'story');
    $oldcwd     = getcwd();
    $viewFile   = $modulePath . 'view/sendmail.html.php';
    chdir($modulePath . 'view');
    if(file_exists($modulePath . 'ext/view/sendmail.html.php'))
    {
        $viewFile = $modulePath . 'ext/view/sendmail.html.php';
        chdir($modulePath . 'ext/view');
    }
    ob_start();
    include $viewFile;
    foreach(glob($modulePath . 'ext/view/sendmail.*.html.hook.php') as $hookFile) include $hookFile;
    $mailContent = ob_get_contents();
    ob_end_clean();
    chdir($oldcwd);

    /* Set toList and ccList. */

    $toList = $story->assignedTo . ',' . $story->openedBy;
    $ccList = str_replace(' ', '', trim($story->mailto, ','));

    /* If the action is changed or reviewed, mail to the project team. */
    if(strtolower($action->action) == 'changed' or strtolower($action->action) == 'reviewed')
    {
        $prjMembers = $this->getProjectMembers($storyID);
        if($prjMembers)
        {
            $ccList .= ',' . join(',', $prjMembers);
            $ccList = ltrim($ccList, ',');
        }
    }

    if(empty($toList))
    {
        if(empty($ccList)) return;
        if(strpos($ccList, ',') === false)
        {
            $toList = $ccList;
            $ccList = '';
        }
        else
        {
            $commaPos = strpos($ccList, ',');
            $toList   = substr($ccList, 0, $commaPos);
            $ccList   = substr($ccList, $commaPos + 1);
        }
    }
    elseif($toList == 'closed')
    {
        $toList = $story->openedBy;
    }

    /* Send it. */
    $this->mail->send($toList, 'STORY #' . $story->id . ' ' . $story->title . ' - ' . $productName, $mailContent, $ccList);
    if($this->mail->isError()) trigger_error(join("\n", $this->mail->getError()));
}
/**
 * Set stage of a story.
 *
 * @param  int    $storyID
 * @access public
 * @return bool
 */
public function setStage($storyID)
{
    $storyID = (int)$storyID;

    /* Get projects which status is doing. */
    $this->dao->delete()->from(TABLE_STORYSTAGE)->where('story')->eq($storyID)->exec();
    $story    = $this->dao->findById($storyID)->from(TABLE_STORY)->fetch();
    $product  = $this->dao->findById($story->product)->from(TABLE_PRODUCT)->fetch();
    $projects = $this->dao->select('t1.project,t3.branch')->from(TABLE_PROJECTSTORY)->alias('t1')
        ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
        ->leftJoin(TABLE_PROJECTPRODUCT)->alias('t3')->on('t1.project = t3.project')
        ->where('t1.story')->eq($storyID)
        ->andWhere('t2.deleted')->eq(0)
        ->fetchPairs('project', 'branch');

    $hasBranch = ($product->type != 'normal' and empty($story->branch));
    $stages    = array();
    if($hasBranch and $story->plan)
    {
        $plans = $this->dao->select('*')->from(TABLE_PRODUCTPLAN)->where('id')->in($story->plan)->fetchPairs('branch', 'branch');
        foreach($plans as $branch) $stages[$branch] = 'planned';
    }

    /* If no projects, in plan, stage is planned. No plan, wait. */
    if(!$projects)
    {
        $this->dao->update(TABLE_STORY)->set('stage')->eq('wait')->where('id')->eq($storyID)->andWhere('plan')->eq('')->exec();

        foreach($stages as $branch => $stage) $this->dao->insert(TABLE_STORYSTAGE)->set('story')->eq($storyID)->set('branch')->eq($branch)->set('stage')->eq($stage)->exec();
        $this->dao->update(TABLE_STORY)->set('stage')->eq('planned')->where('id')->eq($storyID)->andWhere("(plan != '' AND plan != '0')")->exec();
    }

    if($hasBranch)
    {
        foreach($projects as $projectID => $branch) $stages[$branch] = 'projected';
    }
    //获取任务类型配置信息
    $taskType = $this->config->story->develTask . ',test';

    /* Search related tasks. 取消统计status为pause的任务 */
    $tasks = $this->dao->select('type,project,status')->from(TABLE_TASK)
        ->where('project')->in(array_keys($projects))
        ->andWhere('story')->eq($storyID)
        ->andWhere('type')->in($taskType)
        ->andWhere('status')->ne('cancel')
        //->andWhere('status')->ne('pause')
        ->andWhere('closedReason')->ne('cancel')
        ->andWhere('deleted')->eq(0)
        ->fetchGroup('type');

    /* No tasks, then the stage is projected. */
    if(!$tasks and $projects)
    {
        foreach($stages as $branch => $stage) $this->dao->insert(TABLE_STORYSTAGE)->set('story')->eq($storyID)->set('branch')->eq($branch)->set('stage')->eq('projected')->exec();
        $this->dao->update(TABLE_STORY)->set('stage')->eq('projected')->where('id')->eq($storyID)->exec();
    }

    /* Get current stage and set as default value. */
    $currentStage = $story->stage;
    $stage = $currentStage;

    /* Cycle all tasks, get counts of every type and every status. */
    $branchStatusList = array();
    $branchDevelTasks = array();
    $branchTestTasks  = array();
    $statusList['devel'] = array('wait' => 0, 'doing' => 0, 'done'=> 0);
    $statusList['test']  = array('wait' => 0, 'doing' => 0, 'done'=> 0);

    foreach($tasks as $type => $typeTasks)
    {
        foreach($typeTasks as $task)
        {
            $status = $task->status ? $task->status : 'wait';
            $status = $status == 'closed' ? 'done' : $status;

            $branch = $projects[$task->project];

            if(!isset($branchStatusList[$branch])) $branchStatusList[$branch] = $statusList;
            //计算开发和测试各状态的任务数量
            if ($task->type != 'test')
            {
                $branchStatusList[$branch]['devel'][$status] ++;
            }
            else
            {
                $branchStatusList[$branch]['test'][$status] ++;
            }

            $develTask = explode(',', $this->config->story->develTask);

            if(in_array($type, $develTask))
            {
                if(!isset($branchDevelTasks[$branch])) $branchDevelTasks[$branch] = 0;
                $branchDevelTasks[$branch] ++;
            }
            elseif($type == 'test')
            {
                if(!isset($branchTestTasks[$branch])) $branchTestTasks[$branch] = 0;
                $branchTestTasks[$branch] ++;
            }
        }
    }

    /**
     * Judge stage according to the devel and test tasks' status.
     *
     * 1. one doing devel task, all test tasks waiting, set stage as developing.
     * 2. all devel tasks done, all test tasks waiting, set stage as developed.
     * 3. one test task doing, set stage as testing.
     * 4. all test tasks done, still some devel tasks not done(wait, doing), set stage as testing.
     * 5. all test tasks done, all devel tasks done, set stage as tested.
     */
    foreach($branchStatusList as $branch => $statusList)
    {
        $testTasks  = isset($branchTestTasks[$branch]) ? $branchTestTasks[$branch] : 0;
        $develTasks = isset($branchDevelTasks[$branch]) ? $branchDevelTasks[$branch] : 0;
        if($statusList['devel']['doing'] > 0 and $statusList['test']['wait'] == $testTasks) $stage = 'developing';
        if($statusList['devel']['done'] == $develTasks and $develTasks > 0 and $statusList['test']['wait'] == $testTasks) $stage = 'developed';
        if($statusList['test']['doing'] > 0) $stage = 'testing';
        if(($statusList['devel']['wait'] > 0 or $statusList['devel']['doing'] > 0) and $statusList['test']['done'] == $testTasks and $testTasks > 0) $stage = 'testing';
        if($statusList['devel']['done'] == $develTasks and $develTasks > 0 and $statusList['test']['done'] == $testTasks and $testTasks > 0) $stage = 'tested';

        $stages[$branch] = $stage;
    }

    $releases = $this->dao->select('*')->from(TABLE_RELEASE)->where("CONCAT(',', stories, ',')")->like("%,$storyID,%")->andWhere('deleted')->eq(0)->fetchPairs('branch', 'branch');
    foreach($releases as $branch) $stages[$branch] = 'released';

    if(empty($stages)) return;
    if($hasBranch)
    {
        $stageList   = join(',', array_keys($this->lang->story->stageList));
        $minStagePos = strlen($stageList);
        $minStage    = '';
        foreach($stages as $branch => $stage)
        {
            $this->dao->insert(TABLE_STORYSTAGE)->set('story')->eq($storyID)->set('branch')->eq($branch)->set('stage')->eq($stage)->exec();
            if(strpos($stageList, $stage) !== false and strpos($stageList, $stage) < $minStagePos)
            {
                $minStage    = $stage;
                $minStagePos = strpos($stageList, $stage);
            }
        }
        $this->dao->update(TABLE_STORY)->set('stage')->eq($minStage)->where('id')->eq($storyID)->exec();
    }
    else
    {
        $this->dao->update(TABLE_STORY)->set('stage')->eq(current($stages))->where('id')->eq($storyID)->exec();
    }

    return;
}
//**//
}