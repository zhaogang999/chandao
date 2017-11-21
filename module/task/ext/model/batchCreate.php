<?php
/**
 * Create a batch task.
 *
 * @param  int    $projectID
 * @access public
 * @return void
 */
public function batchCreate($projectID)
{
    $this->loadModel('action');
    $now      = helper::now();
    $mails    = array();
    $tasks    = fixer::input('post')->get();
    $batchNum = count(reset($tasks));

    $storyIDs  = array();
    $taskNames = array();
    foreach($tasks->story as $key => $storyID)
    {
        if(empty($tasks->name[$key])) continue;
        if($tasks->type[$key] == 'affair') continue;
        if($tasks->type[$key] == 'ditto' && isset($tasks->type[$key - 1]) && $tasks->type[$key - 1] == 'affair') continue;

        $inNames = in_array($tasks->name[$key], $taskNames);
        if(!$inNames || $inNames && !in_array($storyID, $storyIDs))
        {
            $storyIDs[]  = $storyID;
            $taskNames[] = $tasks->name[$key];
        }
        else
        {
            dao::$errors['message'][] = sprintf($this->lang->duplicate, $this->lang->task->common);
            die(js::error(dao::getError()));
        }
    }

    $result = $this->loadModel('common')->removeDuplicate('task', $tasks, "project=$projectID and story " . helper::dbIN($storyIDs));
    $tasks  = $result['data'];

    /* check estimate. */
    for($i = 0; $i < $batchNum; $i++)
    {
        if(!empty($tasks->name[$i]) and $tasks->estimate[$i] and !preg_match("/^[0-9]+(.[0-9]{1,3})?$/", $tasks->estimate[$i]))
        {
            die(js::alert($this->lang->task->error->estimateNumber));
        }
        if(!empty($tasks->name[$i]) and empty($tasks->type[$i])) die(js::alert(sprintf($this->lang->error->notempty, $this->lang->task->type)));
    }

    $story      = 0;
    $module     = 0;
    $type       = '';
    $assignedTo = '';

    for($i = 0; $i < $batchNum; $i++)
    {
        $story      = !isset($tasks->story[$i]) || $tasks->story[$i]           == 'ditto' ? $story     : $tasks->story[$i];
        $module     = !isset($tasks->module[$i]) || $tasks->module[$i]         == 'ditto' ? $module    : $tasks->module[$i];
        $type       = !isset($tasks->type[$i]) || $tasks->type[$i]             == 'ditto' ? $type      : $tasks->type[$i];
        $assignedTo = !isset($tasks->assignedTo[$i]) || $tasks->assignedTo[$i] == 'ditto' ? $assignedTo: $tasks->assignedTo[$i];

        if(empty($tasks->name[$i])) continue;

        $data[$i]             = new stdclass();
        $data[$i]->story      = (int)$story;
        $data[$i]->type       = $type;
        $data[$i]->module     = (int)$module;
        $data[$i]->assignedTo = $assignedTo;
        $data[$i]->color      = $tasks->color[$i];
        $data[$i]->name       = $tasks->name[$i];
        $data[$i]->desc       = nl2br($tasks->desc[$i]);
        $data[$i]->pri        = $tasks->pri[$i];
        $data[$i]->estimate   = $tasks->estimate[$i];
        $data[$i]->left       = $tasks->estimate[$i];
        $data[$i]->project    = $projectID;
        $data[$i]->estStarted = empty($tasks->estStarted[$i]) ? '0000-00-00' : $tasks->estStarted[$i];
        $data[$i]->deadline   = empty($tasks->deadline[$i]) ? '0000-00-00' : $tasks->deadline[$i];
        $data[$i]->status     = 'wait';
        $data[$i]->openedBy   = $this->app->user->account;
        $data[$i]->openedDate = $now;
        //禅道任务增加关键字字段；需求：858 批量添加任务，批量编辑任务增加关键字字段;行：69
        $data[$i]->keywords   = $tasks->keywords[$i];

        $data[$i]->parent     = $tasks->parent[$i];
        if($story) $data[$i]->storyVersion = $this->loadModel('story')->getVersion($data[$i]->story);
        if($assignedTo) $data[$i]->assignedDate = $now;

        $this->dao->insert(TABLE_TASK)->data($data[$i])
            ->autoCheck()
            ->batchCheck($this->config->task->create->requiredFields, 'notempty')
            ->checkIF($data[$i]->estimate != '', 'estimate', 'float')
            ->exec();

        if(dao::isError()) die(js::error(dao::getError()));

        $taskID = $this->dao->lastInsertID();
        if($story) $this->story->setStage($tasks->story[$i]);
        $actionID = $this->action->create('task', $taskID, 'Opened', '');
        if(!dao::isError()) $this->loadModel('score')->create('task', 'create', $taskID);

        $mails[$i] = new stdclass();
        $mails[$i]->taskID   = $taskID;
        $mails[$i]->actionID = $actionID;
    }

    $this->computeWorkingHours($tasks->parent[0]);
    if(!dao::isError()) $this->loadModel('score')->create('ajax', 'batchCreate');
    return $mails;
}