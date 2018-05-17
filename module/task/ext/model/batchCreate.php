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
    $preStory  = 0;

    /* Judge whether the current task is a parent. */
    $parentID = !empty($this->post->parent[0]) ? $this->post->parent[0] : 0;

    foreach($tasks->story as $key => $storyID)
    {
        if(empty($tasks->name[$key])) continue;
        if($tasks->type[$key] == 'affair') continue;
        if($tasks->type[$key] == 'ditto' && isset($tasks->type[$key - 1]) && $tasks->type[$key - 1] == 'affair') continue;

        if($storyID == 'ditto') $storyID = $preStory;
        $preStory = $storyID;

        $inNames = in_array($tasks->name[$key], $taskNames);
        if(!$inNames || ($inNames && !in_array($storyID, $storyIDs)))
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

    $story      = 0;
    $module     = 0;
    $type       = '';
    $assignedTo = '';

    /* Get task data. */
    $data = array();
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
        $data[$i]->parent     = $tasks->parent[$i];
        //禅道任务增加关键字字段；需求：858 批量添加任务，批量编辑任务增加关键字字段;行：69
        $data[$i]->keywords   = $tasks->keywords[$i];

        if($story) $data[$i]->storyVersion = $this->loadModel('story')->getVersion($data[$i]->story);
        if($assignedTo) $data[$i]->assignedDate = $now;
        if(strpos($this->config->task->create->requiredFields, 'estStarted') !== false and empty($tasks->estStarted[$i])) $data[$i]->estStarted = '';
        if(strpos($this->config->task->create->requiredFields, 'deadline') !== false and empty($tasks->deadline[$i]))     $data[$i]->deadline   = '';
    }

    /* check data. */
    foreach($data as $i => $task)
    {
        if($task->estimate and !preg_match("/^[0-9]+(.[0-9]{1,3})?$/", $task->estimate)) die(js::alert($this->lang->task->error->estimateNumber));
        foreach(explode(',', $this->config->task->create->requiredFields) as $field)
        {
            $field = trim($field);
            if($field and empty($task->$field)) die(js::alert(sprintf($this->lang->error->notempty, $this->lang->task->$field)));
        }
        if($task->estimate) $task->estimate = (float)$task->estimate;
    }

    foreach($data as $i => $task)
    {
        $this->dao->insert(TABLE_TASK)->data($task)
            ->autoCheck()
            ->batchCheck($this->config->task->create->requiredFields, 'notempty')
            ->checkIF($task->estimate != '', 'estimate', 'float')
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

    if(!dao::isError()) $this->loadModel('score')->create('ajax', 'batchCreate');
    if($parentID && !empty($taskID)) $this->updateParentStatus($taskID);
    return $mails;
}