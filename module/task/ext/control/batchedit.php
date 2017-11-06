<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/11/2
 * Time: 10:57
 */
include '../../control.php';
class myTask extends task
{
    /**
     * Batch edit task.
     *
     * @param  int    $projectID
     * @access public
     * @return void
     */
    public function batchEdit($projectID = 0)
    {
        if($this->post->names)
        {
            $allChanges = $this->task->batchUpdate();

            if(!empty($allChanges))
            {
                foreach($allChanges as $taskID => $changes)
                {
                    if(empty($changes)) continue;

                    $actionID = $this->loadModel('action')->create('task', $taskID, 'Edited');
                    $this->action->logHistory($actionID, $changes);
                    $this->task->sendmail($taskID, $actionID);

                    $task = $this->task->getById($taskID);

                    foreach($changes as $change)
                    {
                        if(($change['field'] == 'type' and $change['old'] == 'script') or ($task->type == 'script' and $change['field'] == 'status' and $change['new'] == 'cancel'))
                        {
                            $script = $this->dao->select('*')->from(TABLE_SCRIPT)->where('task')->eq($taskID)->andWhere('deleted')->eq('0')->fetch();
                            //$this->loadModel('report')->delete(TABLE_SCRIPT, $script->id);
                            $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(1)->where('id')->eq($script->id)->exec();
                        }
                        if(($change['field'] == 'type' and $change['new'] == 'script') or ($task->type == 'script' and $change['field'] == 'status' and $change['old'] == 'cancel'))
                        {
                            $script = $this->dao->select('*')->from(TABLE_SCRIPT)->where('task')->eq($taskID)->andWhere('deleted')->eq('1')->fetch();
                            if ($script)
                            {
                                $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(0)->where('id')->eq($script->id)->exec();
                            }
                        }
                    }
                    
                    if($task->fromBug != 0)
                    {
                        foreach($changes as $change)
                        {
                            if($change['field'] == 'status')
                            {
                                $confirmURL = $this->createLink('bug', 'view', "id=$task->fromBug");
                                $cancelURL  = $this->server->HTTP_REFERER;
                                die(js::confirm(sprintf($this->lang->task->remindBug, $task->fromBug), $confirmURL, $cancelURL, 'parent', 'parent'));
                            }
                        }
                    }
                }
            }
            die(js::locate($this->session->taskList, 'parent'));
        }

        $taskIDList = $this->post->taskIDList ? $this->post->taskIDList : die(js::locate($this->session->taskList, 'parent'));

        /* The tasks of project. */
        if($projectID)
        {
            $project = $this->project->getById($projectID);
            $this->project->setMenu($this->project->getPairs(), $project->id);

            /* Set modules and members. */
            $modules = $this->tree->getTaskOptionMenu($projectID);
            $modules = array('ditto' => $this->lang->task->ditto) + $modules;
            $members = $this->project->getTeamMemberPairs($projectID, 'nodeleted');
            $members = array('' => '', 'ditto' => $this->lang->task->ditto) + $members;
            $members['closed'] = 'Closed';

            $this->view->title      = $project->name . $this->lang->colon . $this->lang->task->batchEdit;
            $this->view->position[] = html::a($this->createLink('project', 'browse', "project=$project->id"), $project->name);
            $this->view->project    = $project;
            $this->view->modules    = $modules;
            $this->view->members    = $members;
        }
        /* The tasks of my. */
        else
        {
            $this->lang->task->menu = $this->lang->my->menu;
            $this->lang->set('menugroup.task', 'my');
            $this->lang->task->menuOrder = $this->lang->my->menuOrder;
            $this->loadModel('my')->setMenu();
            $this->view->position[] = html::a($this->createLink('my', 'task'), $this->lang->my->task);
            $this->view->title      = $this->lang->task->batchEdit;
            $this->view->users      = $this->loadModel('user')->getPairs('noletter');
        }

        /* Get edited tasks. */
        $tasks = $this->dao->select('*')->from(TABLE_TASK)->where('id')->in($taskIDList)->fetchAll('id');

        /* Judge whether the editedTasks is too large and set session. */
        $countInputVars  = count($tasks) * (count(explode(',', $this->config->task->custom->batchEditFields)) + 3);
        $showSuhosinInfo = common::judgeSuhosinSetting($countInputVars);
        if($showSuhosinInfo) $this->view->suhosinInfo = extension_loaded('suhosin') ? sprintf($this->lang->suhosinInfo, $countInputVars) : sprintf($this->lang->maxVarsInfo, $countInputVars);

        /* Set Custom*/
        foreach(explode(',', $this->config->task->customBatchEditFields) as $field) $customFields[$field] = $this->lang->task->$field;
        $this->view->customFields = $customFields;
        $this->view->showFields   = $this->config->task->custom->batchEditFields;

        /* Assign. */
        $this->view->position[]  = $this->lang->task->common;
        $this->view->position[]  = $this->lang->task->batchEdit;
        $this->view->projectID   = $projectID;
        $this->view->priList     = array('0' => '', 'ditto' => $this->lang->task->ditto) + $this->lang->task->priList;
        $this->view->statusList  = array('' => '',  'ditto' => $this->lang->task->ditto) + $this->lang->task->statusList;
        $this->view->typeList    = array('' => '',  'ditto' => $this->lang->task->ditto) + $this->lang->task->typeList;
        $this->view->taskIDList  = $taskIDList;
        $this->view->tasks       = $tasks;
        $this->view->projectName = isset($project) ? $project->name : '';

        $this->display();
    }
}