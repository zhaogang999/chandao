<?php
global $app;
helper::cd($app->getBasePath());
helper::import('.\module\action\model.php');
helper::cd();
class extactionModel extends actionModel 
{
/**
 * Get actions of an object.
 *
 * @param  int    $objectType
 * @param  int    $objectID
 * @access public
 * @return array
 */
public function getList($objectType, $objectID)
{
    $commiters = $this->loadModel('user')->getCommiters();

    $actions   = $this->dao->select('*')->from(TABLE_ACTION)
        ->beginIF($objectType == 'project')
        //
        ->where("objectType IN('project', 'testtask', 'build', 'patchbuild')")
        ->andWhere('project')->eq($objectID)
        ->fi()
        ->beginIF($objectType != 'project')
        ->where('objectType')->eq($objectType)
        ->andWhere('objectID')->eq($objectID)
        ->fi()
        ->orderBy('date, id')->fetchAll('id');
    
    $histories = $this->getHistory(array_keys($actions));
    $this->loadModel('file');

    if($objectType == 'project')
    {
        $this->app->loadLang('build');
        //
        $this->app->loadLang('patchbuild');
        $this->app->loadLang('testtask');
        $actions = $this->processProjectActions($actions);
    }

    foreach($actions as $actionID => $action)
    {
        $actionName = strtolower($action->action);
        if($actionName == 'svncommited' and isset($commiters[$action->actor]))
        {
            $action->actor = $commiters[$action->actor];
        }
        elseif($actionName == 'gitcommited' and isset($commiters[$action->actor]))
        {
            $action->actor = $commiters[$action->actor];
        }
        elseif($actionName == 'linked2project')
        {
            $name = $this->dao->select('name')->from(TABLE_PROJECT)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('project', 'story', "projectID=$action->extra"), $name);
        }
        elseif($actionName == 'linked2plan')
        {
            $title = $this->dao->select('title')->from(TABLE_PRODUCTPLAN)->where('id')->eq($action->extra)->fetch('title');
            if($title) $action->extra = html::a(helper::createLink('productplan', 'view', "planID=$action->extra"), $title);
        }
        elseif($actionName == 'linked2build')
        {
            $name = $this->dao->select('name')->from(TABLE_BUILD)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('build', 'view', "builID=$action->extra&type={$action->objectType}"), $name);
        }
        elseif($actionName == 'linked2release')
        {
            $name = $this->dao->select('name')->from(TABLE_RELEASE)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('release', 'view', "releaseID=$action->extra&type={$action->objectType}"), $name);
        }
        elseif($actionName == 'moved')
        {
            $name = $this->dao->select('name')->from(TABLE_PROJECT)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('project', 'task', "projectID=$action->extra"), "#$action->extra " . $name);
        }
        elseif($actionName == 'frombug')
        {
            $action->extra = html::a(helper::createLink('bug', 'view', "bugID=$action->extra"), $action->extra);
        }
        elseif($actionName == 'unlinkedfromproject')
        {
            $name = $this->dao->select('name')->from(TABLE_PROJECT)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('project', 'story', "projectID=$action->extra"), "#$action->extra " . $name);
        }
        elseif($actionName == 'unlinkedfrombuild')
        {
            $name = $this->dao->select('name')->from(TABLE_BUILD)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('build', 'view', "builID=$action->extra&type={$action->objectType}"), $name);
        }
        elseif($actionName == 'unlinkedfromrelease')
        {
            $name = $this->dao->select('name')->from(TABLE_RELEASE)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('release', 'view', "releaseID=$action->extra&type={$action->objectType}"), $name);
        }
        elseif($actionName == 'unlinkedfromplan')
        {
            $title = $this->dao->select('title')->from(TABLE_PRODUCTPLAN)->where('id')->eq($action->extra)->fetch('title');
            if($title) $action->extra = html::a(helper::createLink('productplan', 'view', "planID=$action->extra"), "#$action->extra " . $title);
        }
        elseif($actionName == 'tostory')
        {
            $title = $this->dao->select('title')->from(TABLE_STORY)->where('id')->eq($action->extra)->fetch('title');
            if($title) $action->extra = html::a(helper::createLink('story', 'view', "storyID=$action->extra"), "#$action->extra " . $title);
        }
        elseif($actionName == 'totask')
        {
            $name = $this->dao->select('name')->from(TABLE_TASK)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('task', 'view', "taskID=$action->extra"), "#$action->extra " . $name);
        }
        elseif($actionName == 'buildopened')
        {
            $name = $this->dao->select('name')->from(TABLE_BUILD)->where('id')->eq($action->objectID)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('build', 'view', "buildID=$action->objectID"), "#$action->objectID " . $name);
        }
        elseif($actionName == 'testtaskopened' or $actionName == 'testtaskstarted' or $actionName == 'testtaskclosed')
        {
            $name = $this->dao->select('name')->from(TABLE_TESTTASK)->where('id')->eq($action->objectID)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('testtask', 'view', "testtaskID=$action->objectID"), "#$action->objectID " . $name);
        }
        elseif($actionName == 'fromlib' and $action->objectType == 'case')
        {
            $name = $this->dao->select('name')->from(TABLE_TESTSUITE)->where('id')->eq($action->extra)->fetch('name');
            if($name) $action->extra = html::a(helper::createLink('testsuite', 'library', "libID=$action->extra"), $name);
        }
        elseif(($actionName == 'closed' and $action->objectType == 'story') or ($actionName == 'resolved' and $action->objectType == 'bug'))
        {
            $action->appendLink = '';
            if(strpos($action->extra, ':')!== false)
            {
                list($extra, $id) = explode(':', $action->extra);
                $action->extra    = $extra;
                if($id)
                {
                    $table = $action->objectType == 'story' ? TABLE_STORY : TABLE_BUG;
                    $name  = $this->dao->select('title')->from($table)->where('id')->eq($id)->fetch('title');
                    if($name) $action->appendLink = html::a(helper::createLink($action->objectType, 'view', "id=$id"), "#$id " . $name);
                }
            }
        }
        $action->history = isset($histories[$actionID]) ? $histories[$actionID] : array();
        $action->comment = $this->file->setImgSize($action->comment, $this->config->action->commonImgSize);
        $actions[$actionID] = $action;
    }

    return $actions;
}
/**
 * Get product and project of an object.
 *
 * @param  string $objectType
 * @param  int    $objectID
 * @access public
 * @return array
 */
public function getProductAndProject($objectType, $objectID)
{
    $emptyRecord = array('product' => ',0,', 'project' => 0);

    /* If objectType is product or project, return the objectID. */
    if($objectType == 'product') return array('product' => ",$objectID,", 'project' => 0);
    if($objectType == 'project')
    {
        $products = $this->dao->select('product')->from(TABLE_PROJECTPRODUCT)->where('project')->eq($objectID)->fetchPairs('product');
        $productList = ',' . join(',', array_keys($products)) . ',';
        return array('project' => $objectID, 'product' => $productList);
    }

    /* Only process these object types. */
    //增加patchbuild模块
    if(strpos('story, productplan, release, task, build. bug, case, testtask, doc, patchbuild', $objectType) !== false)
    {
        if(!isset($this->config->objectTables[$objectType])) return $emptyRecord;

        /* Set fields to fetch. */
        if(strpos('story, productplan, case',  $objectType) !== false) $fields = 'product';
        //增加patchbuild模块
        if(strpos('build, bug, testtask, doc, patchbuild', $objectType) !== false) $fields = 'product, project';
        if($objectType == 'release') $fields = 'product, build';
        if($objectType == 'task')    $fields = 'project, story';

        $record = $this->dao->select($fields)->from($this->config->objectTables[$objectType])->where('id')->eq($objectID)->fetch();

        /* Process story, release and task. */
        if($objectType == 'story')   $record->project = $this->dao->select('project')->from(TABLE_PROJECTSTORY)->where('story')->eq($objectID)->fetch('project');
        if($objectType == 'release') $record->project = $this->dao->select('project')->from(TABLE_BUILD)->where('id')->eq($record->build)->fetch('project');
        if($objectType == 'task')
        {
            if($record->story != 0)
            {
                $product = $this->dao->select('product')->from(TABLE_STORY)->where('id')->eq($record->story)->fetchPairs('product');
                $record->product = join(',', array_keys($product));
            }
            else
            {
                $products = $this->dao->select('product')->from(TABLE_PROJECTPRODUCT)->where('project')->eq($record->project)->fetchPairs('product');
                $record->product = join(',', array_keys($products));
            }
        }

        if($record)
        {
            $record = (array)$record;
            $record['product'] = isset($record['product']) ? ',' . $record['product'] . ',' : ',0,';
            if(!isset($record['project'])) $record['project'] = 0;
            return $record;
        }

        return $emptyRecord;
    }
    return $emptyRecord;
}
/**
 * Print changes of every action.
 *
 * @param  string    $objectType
 * @param  array     $histories
 * @access public
 * @return void
 */
public function printChanges($objectType, $histories)
{
    if(empty($histories)) return;

    $maxLength            = 0;          // The max length of fields names.
    $historiesWithDiff    = array();    // To save histories without diff info.
    $historiesWithoutDiff = array();    // To save histories with diff info.

    /* Diff histories by hasing diff info or not. Thus we can to make sure the field with diff show at last. */
    foreach($histories as $history)
    {
        $fieldName = $history->field;

        //2291 需求或任务修改记录中的值请显示前台调用的值，不要显示后台的ID号
        if ($fieldName == 'plan' || $fieldName == 'customPlan')
        {
            if ($history->old != '' && $history->old != 0)
            {
                $oldHistory = $this->loadModel('productplan')->getByID($history->old);
                $history->old = '#' . $history->old . ' ' . $oldHistory->title;
            }
            $newHistory = $this->loadModel('productplan')->getByID($history->new);
            $history->new = '#' . $history->new . ' ' . $newHistory->title;
        }
        if ($fieldName == 'module')
        {
            if ($history->new != 0 || $history->old != 0)
            {
                $oldHistory = $this->loadModel('tree')->getByID($history->old);
                $history->old = '#' . $history->old . ' ' . $oldHistory->name;
                $newHistory = $this->loadModel('tree')->getByID($history->new);
                $history->new = '#' . $history->new . ' ' . $newHistory->name;
           }
        }

        $history->fieldLabel = (isset($this->lang->$objectType) && isset($this->lang->$objectType->$fieldName)) ? $this->lang->$objectType->$fieldName : $fieldName;
        if(($length = strlen($history->fieldLabel)) > $maxLength) $maxLength = $length;
        $history->diff ? $historiesWithDiff[] = $history : $historiesWithoutDiff[] = $history;
    }
    $histories = array_merge($historiesWithoutDiff, $historiesWithDiff);

    foreach($histories as $history)
    {
        $history->fieldLabel = str_pad($history->fieldLabel, $maxLength, $this->lang->action->label->space);
        if($history->diff != '')
        {
            $history->diff      = str_replace(array('<ins>', '</ins>', '<del>', '</del>'), array('[ins]', '[/ins]', '[del]', '[/del]'), $history->diff);
            $history->diff      = ($history->field != 'subversion' and $history->field != 'git') ? htmlspecialchars($history->diff) : $history->diff;   // Keep the diff link.
            $history->diff      = str_replace(array('[ins]', '[/ins]', '[del]', '[/del]'), array('<ins>', '</ins>', '<del>', '</del>'), $history->diff);
            $history->diff      = nl2br($history->diff);
            $history->noTagDiff = preg_replace('/&lt;\/?([a-z][a-z0-9]*)[^\/]*\/?&gt;/Ui', '', $history->diff);
            printf($this->lang->action->desc->diff2, $history->fieldLabel, $history->noTagDiff, $history->diff);
        }
        else
        {
            printf($this->lang->action->desc->diff1, $history->fieldLabel, $history->old, $history->new);
        }
    }
}
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/11/1
 * Time: 17:17
 */

/**
 * Undelete a record.
 *
 * @param  int      $actionID
 * @access public
 * @return void
 */
public function undelete($actionID)
{
    $action = $this->getById($actionID);
    if($action->action != 'deleted') return;
    if($action->objectType == 'product')
    {
        $product = $this->dao->select('name,code')->from(TABLE_PRODUCT)->where('id')->eq($action->objectID)->fetch();
        $count   = $this->dao->select('COUNT(*) AS count')->from(TABLE_PRODUCT)->where('deleted')->eq('0')->andWhere("(`name`='{$product->name}' OR `code`='{$product->code}')")->fetch('count');
        if($count > 0)
        {
            echo js::alert(sprintf($this->lang->action->needEdit, $this->lang->action->objectTypes['product']));
            die(js::locate(helper::createLink('product', 'edit', "productID=$action->objectID&action=undelete&extra=$actionID"), 'parent'));
        }
    }
    elseif($action->objectType == 'project')
    {
        $project = $this->dao->select('name,code')->from(TABLE_PROJECT)->where('id')->eq($action->objectID)->fetch();
        $count   = $this->dao->select('COUNT(*) AS count')->from(TABLE_PROJECT)->where('deleted')->eq('0')->andWhere("(`name`='{$project->name}' OR `code`='{$project->code}')")->fetch('count');
        if($count > 0)
        {
            echo js::alert(sprintf($this->lang->action->needEdit, $this->lang->action->objectTypes['project']));
            die(js::locate(helper::createLink('project', 'edit', "projectID=$action->objectID&action=undelete&extra=$actionID"), 'parent'));
        }
    }

    /* Update deleted field in object table. */
    $table = $this->config->objectTables[$action->objectType];
    $this->dao->update($table)->set('deleted')->eq(0)->where('id')->eq($action->objectID)->exec();

    if ($action->objectType == 'task')
    {
        $script = $this->dao->select('*')->from(TABLE_SCRIPT)->where('task')->eq($action->objectID)->andWhere('deleted')->eq('1')->fetch();
        if ($script)
        {
            $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(0)->where('id')->eq($script->id)->exec();
        }
    }

    /* Revert doclib when undelet product or project. */
    if($action->objectType == 'project' or $action->objectType == 'product')
    {
        $this->dao->update(TABLE_DOCLIB)->set('deleted')->eq(0)->where($action->objectType)->eq($action->objectID)->exec();
    }

    /* Update action record in action table. */
    $this->dao->update(TABLE_ACTION)->set('extra')->eq(ACTIONMODEL::BE_UNDELETED)->where('id')->eq($actionID)->exec();
    $this->create($action->objectType, $action->objectID, 'undeleted');
}
//**//
}