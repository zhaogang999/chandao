<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\bug\model.php');
helper::cd();
class extbugModel extends bugModel 
{
/**
 * Activate a bug.
 *
 * @param  int    $bugID
 * @access public
 * @return void
 */
public function activate($bugID)
{
    $oldBug = $this->getById($bugID);
    $now = helper::now();
    $bug = fixer::input('post')
        ->setDefault('assignedTo', $oldBug->resolvedBy)
        ->add('assignedDate', $now)
        ->add('resolution', '')
        ->add('status', 'active')
        ->add('resolvedDate', '0000-00-00')
        ->add('resolvedBy', '')
        ->add('resolvedBuild', '')
        ->add('closedBy', '')
        ->add('closedDate', '0000-00-00')
        ->add('duplicateBug', 0)
        ->add('lastEditedBy',   $this->app->user->account)
        ->add('lastEditedDate', $now)
        ->join('openedBuild', ',')
        ->remove('comment,files,labels')
        ->get();

    $this->dao->update(TABLE_BUG)->data($bug)->autoCheck()->where('id')->eq((int)$bugID)->exec();
    $this->dao->update(TABLE_BUG)->set('activatedCount = activatedCount + 1')->where('id')->eq((int)$bugID)->exec();
    if (dao::isError())
    {
        $this->loadModel('github');
        $this->github->resolve($oldBug, $bug, 'bug');
    }
}/**
 * Build search form.
 *
 * @param  int    $productID
 * @param  array  $products
 * @param  int    $queryID
 * @param  string $actionURL
 * @access public
 * @return void
 */
public function buildSearchForm($productID, $products, $queryID, $actionURL)
{
    $this->config->bug->search['actionURL'] = $actionURL;
    $this->config->bug->search['queryID']   = $queryID;
    //优化搜索功能搜索条件增加空选项
    $this->config->bug->search['params']['product']['values']       = array('' => '', $productID => $products[$productID], 'all' => $this->lang->bug->allProduct);
    
    $this->config->bug->search['params']['plan']['values']          = $this->loadModel('productplan')->getPairs($productID);
    //优化搜索功能；增加空选项
    $this->config->bug->search['params']['module']['values']        = array(0 => '') + $this->loadModel('tree')->getOptionMenu($productID, $viewType = 'bug', $startModuleID = 0);

    $this->config->bug->search['params']['project']['values']       = $this->product->getProjectPairs($productID);
    $this->config->bug->search['params']['severity']['values']      = array(0 => '') + $this->lang->bug->severityList; //Fix bug #939.
    $this->config->bug->search['params']['openedBuild']['values']   = $this->loadModel('build')->getProductBuildPairs($productID, 0, $params = '');
    $this->config->bug->search['params']['resolvedBuild']['values'] = $this->config->bug->search['params']['openedBuild']['values'];
    if($this->session->currentProductType == 'normal')
    {
        unset($this->config->bug->search['fields']['branch']);
        unset($this->config->bug->search['params']['branch']);
    }
    else
    {
        $this->config->bug->search['fields']['branch'] = $this->lang->product->branch;
        $this->config->bug->search['params']['branch']['values']  = array('' => '') + $this->loadModel('branch')->getPairs($productID, 'noempty') + array('all' => $this->lang->branch->all);
    }

    $this->loadModel('search')->setSearchParams($this->config->bug->search);
}public function setListValue($productID, $branch = 0)
{
    return $this->loadExtension('excel')->setListValue($productID, $branch);
}

public function createFromImport($productID, $branch = 0)
{
    return $this->loadExtension('excel')->createFromImport($productID, $branch);
}/**
 * Get report data of bugs per pri
 *
 * @access public
 * @return array
 */
public function getDataOfBugsPerPri()
{
    $datas = $this->dao->select('pri AS name, COUNT(*) AS value')->from(TABLE_BUG)->where($this->reportCondition())->groupBy('name')->orderBy('value DESC')->fetchAll('name');
    if(!$datas) return array();
    //foreach($datas as $status => $data) $data->name = $this->lang->bug->report->bugsPerPri->graph->xAxisName . ':' . $data->name;
    //7178 搜索bug优先级时，显示错误；官方bug；待官方修复后删除
    foreach($datas as $pri => $data)  $data->name = $this->lang->bug->priList[$pri] != '' ? $this->lang->bug->priList[$pri] : $this->lang->report->undefined;
    return $datas;
}/**
 * Get report data of deadline bugs per day.
 *
 * @access public
 * @return array
 */
public function getDataOfbugsDeadline()
{
    return $this->dao->select('deadline AS name, COUNT(*) AS value')->from(TABLE_BUG)
        ->where($this->reportCondition())->groupBy('name')
        ->having('name != 0000-00-00')
        ->orderBy('deadline')->fetchAll();
}/**
 * Link related bugs.
 *
 * @param  int    $bugID
 * @access public
 * @return void
 */
public function linkBugs($bugID)
{
    if($this->post->bugs == false) return;

    $bug       = $this->getById($bugID);
    $bugs2Link = $this->post->bugs;

    $bugs = implode(',', $bugs2Link) . ',' . trim($bug->linkBug, ',');
    $this->dao->update(TABLE_BUG)->set('linkBug')->eq(trim($bugs, ','))->where('id')->eq($bugID)->exec();
    if(dao::isError()) die(js::error(dao::getError()));
    $this->loadModel('action')->create('bug', $bugID, 'linkRelatedBug', '', implode(',', $bugs2Link));

    //Bug双向关联
    foreach ($bugs2Link as $val)
    {
        $linkbugs = $this->dao->select('linkBug')->FROM(TABLE_BUG)->where('id')->eq(trim($val, ','))->fetch();
        $linkBugsAB = $linkbugs->linkBugs .','. $bugID;

        $this->dao->update(TABLE_BUG)->set('linkBug')->eq(trim($linkBugsAB, ','))->where('id')->eq(trim($val, ','))->exec();
        if(dao::isError()) die(js::error(dao::getError()));

        $this->loadModel('action')->create('bug', $val, 'linkRelatedBug', '', $bugID);
    }
}/**
 * Print cell data.
 *
 * @param  object $col
 * @param  object $bug
 * @param  array  $users
 * @param  array  $builds
 * @param  array  $branches
 * @access public
 * @return void
 */
public function printCell($col, $bug, $users, $builds, $branches, $modulePairs)
{
    $bugLink = inlink('view', "bugID=$bug->id");
    $account = $this->app->user->account;
    $id = $col->id;
    if($col->show)
    {
        $class = '';
        if($id == 'status') $class .= ' bug-' . $bug->status;
        if($id == 'title') $class .= ' text-left';
        if($id == 'assignedTo' && $bug->assignedTo == $account) $class .= ' red';
        if($id == 'deadline' && isset($bug->delay)) $class .= ' delayed';

        echo "<td class='" . $class . "'" . ($id=='title' ? " title='{$bug->title}'" : '') . ">";
        switch ($id)
        {
            case 'id':
                echo html::a($bugLink, sprintf('%03d', $bug->id));
                break;
            case 'severity':
                echo "<span class='severity" . zget($this->lang->bug->severityList, $bug->severity, $bug->severity) . "'>";
                echo zget($this->lang->bug->severityList, $bug->severity, $bug->severity);
                echo "</span>";
                break;
            case 'pri':
                echo "<span class='pri" . zget($this->lang->bug->priList, $bug->pri, $bug->pri) . "'>";
                echo zget($this->lang->bug->priList, $bug->pri, $bug->pri);
                echo "</span>";
                break;
            case 'title':
                $class = 'confirm' . $bug->confirmed;
                echo "<span class='$class'>[{$this->lang->bug->confirmedList[$bug->confirmed]}]</span> ";
                if($bug->branch)echo "<span class='label label-info label-badge'>{$branches[$bug->branch]}</span> ";
                if($modulePairs and $bug->module)echo "<span class='label label-info label-badge'>{$modulePairs[$bug->module]}</span> ";
                echo html::a($bugLink, $bug->title, null, "style='color: $bug->color'");
                break;

            //2061 提bug页面增加一个字段“发现阶段”，该字段需要支持后续搜索
            case 'discoveryPhase':
                echo $this->lang->bug->discoveryPhaseList[$bug->discoveryPhase];
                break;
            
            case 'branch':
                echo $branches[$bug->branch];
                break;
            case 'type':
                echo zget($this->lang->bug->typeList, $bug->type);
                break;
            case 'status':
                echo zget($this->lang->bug->statusList, $bug->status);
                break;
            case 'activatedCount':
                echo $bug->activatedCount;
                break;
            case 'openedBy':
                echo zget($users, $bug->openedBy);
                break;
            case 'openedDate':
                echo substr($bug->openedDate, 5, 11);
                break;
            case 'openedBuild':
                foreach(explode(',', $bug->openedBuild) as $build) echo zget($builds, $build) . '<br />';
                break;
            case 'assignedTo':
                echo zget($users, $bug->assignedTo, $bug->assignedTo);
                break;
            case 'assignedDate':
                echo substr($bug->assignedDate, 5, 11);
                break;
            case 'deadline':
                echo $bug->deadline;
                break;
            case 'resolvedBy':
                echo zget($users, $bug->resolvedBy, $bug->resolvedBy);
                break;
            case 'resolution':
                echo zget($this->lang->bug->resolutionList, $bug->resolution);
                break;
            case 'resolvedDate':
                echo substr($bug->resolvedDate, 5, 11);
                break;
            case 'resolvedBuild':
                echo $bug->resolvedBuild;
                break;
            case 'closedBy':
                echo zget($users, $bug->closedBy);
                break;
            case 'lastEditedDate':
                echo substr($bug->lastEditedDate, 5, 11);
                break;
            case 'closedDate':
                echo substr($bug->closedDate, 5, 11);
                break;
            case 'actions':
                $params = "bugID=$bug->id";
                common::printIcon('bug', 'confirmBug', $params, $bug, 'list', 'search', '', 'iframe', true);
                common::printIcon('bug', 'assignTo',   $params, '',   'list', '', '', 'iframe', true);
                common::printIcon('bug', 'resolve',    $params, $bug, 'list', '', '', 'iframe', true);
                common::printIcon('bug', 'close',      $params, $bug, 'list', '', '', 'iframe', true);
                common::printIcon('bug', 'edit',       $params, $bug, 'list');
                common::printIcon('bug', 'create',     "product=$bug->product&branch=$bug->branch&extra=bugID=$bug->id", $bug, 'list', 'copy');
                break;
        }
        echo '</td>';
    }
}/**
 * Resolve a bug.
 *
 * @param  int    $bugID
 * @access public
 * @return void
 */
public function resolve($bugID)
{
    $now    = helper::now();
    $oldBug = $this->getById($bugID);
    $bug    = fixer::input('post')
        ->add('resolvedBy',     $this->app->user->account)
        ->add('status',         'resolved')
        ->add('confirmed',      1)
        ->add('assignedDate',   $now)
        ->add('lastEditedBy',   $this->app->user->account)
        ->add('lastEditedDate', $now)
        ->setDefault('resolvedDate', $now)
        ->setDefault('duplicateBug', 0)
        ->setDefault('assignedTo', $oldBug->openedBy)
        ->remove('comment,files,labels')
        ->get();

    /* Can create build when resolve bug. */
    if(isset($bug->createBuild))
    {
        if(empty($bug->buildName)) dao::$errors['buildName'][] = sprintf($this->lang->error->notempty, $this->lang->bug->placeholder->newBuildName);
        if(empty($bug->buildProject)) dao::$errors['buildProject'][] = sprintf($this->lang->error->notempty, $this->lang->bug->project);
        if(dao::isError()) return false;

        $buildData = new stdclass();
        $buildData->product = $oldBug->product;
        $buildData->branch  = $oldBug->branch;
        $buildData->project = $bug->buildProject;
        $buildData->name    = $bug->buildName;
        $buildData->date    = date('Y-m-d');
        $buildData->builder = $this->app->user->account;
        $this->dao->insert(TABLE_BUILD)->data($buildData)->autoCheck()
            ->check('name', 'unique', "product = {$buildData->product} AND branch = {$buildData->branch} AND deleted = '0'")
            ->exec();
        if(dao::isError()) return false;
        $buildID = $this->dao->lastInsertID();
        $this->loadModel('action')->create('build', $buildID, 'opened');
        $bug->resolvedBuild = $buildID;
    }
    unset($bug->buildName);
    unset($bug->createBuild);
    unset($bug->buildProject);

    if($bug->resolvedBuild != 'trunk') $bug->testtask = $this->dao->select('id')->from(TABLE_TESTTASK)->where('build')->eq($bug->resolvedBuild)->orderBy('id_desc')->limit(1)->fetch('id');

    $this->dao->update(TABLE_BUG)->data($bug)
        ->autoCheck()
        ->batchCheck($this->config->bug->resolve->requiredFields, 'notempty')
        ->checkIF($bug->resolution == 'duplicate', 'duplicateBug', 'notempty')
        ->checkIF($bug->resolution == 'fixed',     'resolvedBuild','notempty')
        ->where('id')->eq((int)$bugID)
        ->exec();
    if (!dao::isError())
    {
        $this->loadModel('github');
        //$this->github->edit($oldBug, $bug, 'bug');
    }
    /* Link bug to build and release. */
    $this->linkBugToBuild($bugID, $bug->resolvedBuild);
}
//**//
}