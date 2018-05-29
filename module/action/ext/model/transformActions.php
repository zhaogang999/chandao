<?php
/**
 * Transform the actions for display.
 *
 * @param  int    $actions
 * @access public
 * @return void
 */
public function transformActions($actions)
{
    $this->app->loadLang('todo');
    /* Get commiters. */
    $commiters = $this->loadModel('user')->getCommiters();

    /* Group actions by objectType, and get there name field. */
    foreach($actions as $object) $objectTypes[$object->objectType][] = $object->objectID;
    foreach($objectTypes as $objectType => $objectIds)
    {
        if(!isset($this->config->objectTables[$objectType])) continue;    // If no defination for this type, omit it.

        $objectIds   = array_unique($objectIds);
        $table       = $this->config->objectTables[$objectType];
        $field       = $this->config->action->objectNameFields[$objectType];
        if($table != TABLE_TODO)
        {
            $objectNames[$objectType] = $this->dao->select("id, $field AS name")->from($table)->where('id')->in($objectIds)->fetchPairs();
        }
        else
        {
            $todos = $this->dao->select("id, $field AS name, account, private, type, idvalue")->from($table)->where('id')->in($objectIds)->fetchAll('id');
            foreach($todos as $id => $todo)
            {
                if($todo->type == 'task') $todo->name = $this->dao->findById($todo->idvalue)->from(TABLE_TASK)->fetch('name');
                if($todo->type == 'bug')  $todo->name = $this->dao->findById($todo->idvalue)->from(TABLE_BUG)->fetch('title');
                if($todo->private == 1 and $todo->account != $this->app->user->account)
                {
                    $objectNames[$objectType][$id] = $this->lang->todo->thisIsPrivate;
                }
                else
                {
                    $objectNames[$objectType][$id] = $todo->name;
                }
            }
        }
    }
    $objectNames['user'][0] = 'guest';    // Add guest account.

    foreach($actions as $action)
    {
        /* Add name field to the actions. */
        $action->objectName = isset($objectNames[$action->objectType][$action->objectID]) ? $objectNames[$action->objectType][$action->objectID] : '';

        $actionType = strtolower($action->action);
        $objectType = strtolower($action->objectType);
        $action->date        = date(DT_MONTHTIME2, strtotime($action->date));
        $action->actionLabel = isset($this->lang->action->label->$actionType) ? $this->lang->action->label->$actionType : $action->action;
        $action->objectLabel = $objectType;
        if(isset($this->lang->action->label->$objectType))
        {
            $objectLabel = $this->lang->action->label->$objectType;
            if(!is_array($objectLabel)) $action->objectLabel = $objectLabel;
            if(is_array($objectLabel) and isset($objectLabel[$actionType])) $action->objectLabel = $objectLabel[$actionType];
        }

        /* If action type is login or logout, needn't link. */
        if($actionType == 'svncommited')
        {
            $action->actor = isset($commiters[$action->actor]) ? $commiters[$action->actor] : $action->actor;
        }

        /* Other actions, create a link. */
        if(strpos($action->objectLabel, '|') !== false)
        {
            list($objectLabel, $moduleName, $methodName, $vars) = explode('|', $action->objectLabel);
            $action->objectLink = '';
            if(common::hasPriv($moduleName, $methodName))
            {
                $action->objectLink  = helper::createLink($moduleName, $methodName, sprintf($vars, $action->objectID));
                if($action->objectType == 'user') $action->objectLink  = helper::createLink($moduleName, $methodName, sprintf($vars, $action->actor));
            }
            $action->objectLabel = $objectLabel;
        }
        else
        {
            $action->objectLink = '';
        }

        if($action->project != '0' and $action->objectType === 'story' or  $action->objectType === 'task' or $action->objectType === 'bug' or $action->objectType === 'build' or $action->objectType === 'patchbuild') $action->projectName = $this->dao->findById($action->project)->from(TABLE_PROJECT)->fetch('code');
        if($action->objectType === 'task' and $action->project != '0') $action->projectName = $this->dao->findById($action->project)->from(TABLE_PROJECT)->fetch('code');

        $action->deptPath = '';
        $user = $this->loadModel('user')->getById($action->actor);
        $deptPath = $this->loadModel('dept')->getParents($user->dept);
        if(empty($deptPath))
        {
            $action->deptPath = "/";
        }
        else
        {
            foreach($deptPath as $key => $dept)
            {
                if($dept->name) $action->deptPath .= $dept->name;
                if(isset($deptPath[$key + 1])) $action->deptPath .= $this->lang->fold;
            }
        }

    }

    return $actions;
}