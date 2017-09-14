<?php
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