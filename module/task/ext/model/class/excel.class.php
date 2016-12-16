<?php
class excelTask extends taskModel
{
    public function setListValue($projectID)
    {
        $project   = $this->loadModel('project')->getByID($projectID);
        $modules   = $this->loadModel('tree')->getTaskOptionMenu($projectID);
        $stories   = $this->loadModel('story')->getProjectStories($projectID);
        $priList   = $this->lang->task->priList;
        $typeList  = $this->lang->task->typeList;
<<<<<<< HEAD

        unset($typeList['']);
=======
        //完善任务导入功能，新增status下拉列表
        $statusList = $this->lang->task->statusList;

        unset($statusList['']);
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5

        foreach($modules  as $id => $module) $modules[$id] .= "(#$id)";
        foreach($stories  as $id => $story)  $stories[$id]  = "$story->title(#$story->id)";

        $this->post->set('moduleList',   array_values($modules));
        $this->post->set('storyList',    array_values($stories));
        $this->post->set('priList',      join(',', $priList));
        $this->post->set('typeList',     join(',', $typeList));
<<<<<<< HEAD
=======
        //完善任务导入功能，新增status下拉列表
        $this->post->set('statusList',   join(',', $statusList));

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $this->post->set('listStyle',  $this->config->task->export->listFields);
        $this->post->set('extraNum',   0);
        $this->post->set('project',    $project->name);
    }

    public function createFromImport($projectID)
    {
        $this->loadModel('action');
        $this->loadModel('file');
        $this->loadModel('story');
        $now  = helper::now();
        $data = fixer::input('post')->get();

        if(!empty($_POST['id'])) $oldTasks = $this->dao->select('*')->from(TABLE_TASK)->where('id')->in(($_POST['id']))->andWhere('project')->eq($projectID)->fetchAll('id');

        foreach($data->project as $key => $project)
        {
            $taskData = new stdclass();

<<<<<<< HEAD
=======
            $oldID                   = $data->id[$key];
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
            $taskData->project      = $project;
            $taskData->module       = (int)$data->module[$key];
            $taskData->name         = $data->name[$key];
            $taskData->desc         = nl2br($data->desc[$key]);
            $taskData->story        = (int)$data->story[$key];
            $taskData->pri          = (int)$data->pri[$key];
            $taskData->type         = $data->type[$key];
<<<<<<< HEAD
            $taskData->estimate     = (float)$data->estimate[$key];
            $taskData->estStarted   = empty($data->estStarted[$key]) ? '0000-00-00' : $data->estStarted[$key];
            $taskData->deadline     = empty($data->deadline[$key]) ? '0000-00-00' : $data->deadline[$key];
=======
//完善任务导入功能，增加指派给，指派时间，mailto
            $assingedToAccount = $this->dao->select('account')->from(TABLE_USER)->where('realname')->eq(trim($data->assignedTo[$key]))->fetch();
            $taskData->assignedTo  =  empty($assingedToAccount)?'':$assingedToAccount->account;
            $taskData->assignedDate  =  $data->assignedDate[$key];
            $taskData->mailto       =  $data->mailto[$key];

            $taskData->estimate     = (float)$data->estimate[$key];
            $taskData->estStarted   = empty($data->estStarted[$key]) ? '0000-00-00' : $data->estStarted[$key];
            $taskData->deadline     = empty($data->deadline[$key]) ? '0000-00-00' : $data->deadline[$key];
            /*完善任务导入功能，新增status,mailto,openedBy,openedDate,assignedTo,assignedDate,finishedBy,finishedDate,canceledBy,canceledDate,closedBy,closedDate,closedReason,lastEditedBy,lastEditedDate,files*/
            $taskData->status          =  $data->status[$key];
            $taskData->consumed        =  $data->consumed[$key];
            $taskData->left            =  $data->left[$key];
            $openedByAccount = $this->dao->select('account')->from(TABLE_USER)->where('realname')->eq(trim($data->openedBy[$key]))->fetch();
            $taskData->openedBy        =  empty($openedByAccount)?'':$openedByAccount->account;
            $taskData->openedDate      =  $data->openedDate[$key];
            $taskData->realStarted     =  $data->realStarted[$key];
            $finishedByAccount = $this->dao->select('account')->from(TABLE_USER)->where('realname')->eq(trim($data->finishedBy[$key]))->fetch();
            $taskData->finishedBy      =  empty($finishedByAccount)?'':$finishedByAccount->account;
            $taskData->finishedDate    =  $data->finishedDate[$key];
            $canceledByAccount = $this->dao->select('account')->from(TABLE_USER)->where('realname')->eq(trim($data->canceledBy[$key]))->fetch();
            $taskData->canceledBy      =  empty($canceledByAccount)?'':$canceledByAccount->account;
            $taskData->canceledDate    =  $data->canceledDate[$key];
            $closedByAccount = $this->dao->select('account')->from(TABLE_USER)->where('realname')->eq(trim($data->closedBy[$key]))->fetch();
            $taskData->closedBy        =  empty($closedByAccount)?'':$closedByAccount->account;
            $taskData->closedReason    =  $data->closedReason[$key];
            $lastEditedByAccount = $this->dao->select('account')->from(TABLE_USER)->where('realname')->eq(trim($data->lastEditedBy[$key]))->fetch();
            $taskData->lastEditedBy    =  empty($lastEditedByAccount)?'':$lastEditedByAccount->account;
            $taskData->lastEditedDate  =  $data->lastEditedDate[$key];
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5

            if(isset($this->config->task->create->requiredFields))
            {
                $requiredFields = explode(',', $this->config->task->create->requiredFields);
                $invalid = false;
                foreach($requiredFields as $requiredField)
                {
                    $requiredField = trim($requiredField);
                    if(empty($taskData->$requiredField)) $invalid = true;
                }
                if($invalid) continue;
            }

            $taskID = 0;
            if(!empty($_POST['id'][$key]) and empty($_POST['insert']))
            {
                $taskID = $data->id[$key];
                if(!isset($oldTasks[$taskID])) $taskID = 0;
            }

            if($taskID)
            {
                if($taskData->story != $oldTasks[$taskID]->story) $taskData->storyVersion = $this->story->getVersion($taskData->story);
                $taskData->desc         = str_replace('src="' . common::getSysURL() . '/', 'src="', $taskData->desc);
                $taskData->status       = $oldTasks[$taskID]->status;

                $oldTask = (array)$oldTasks[$taskID];
                $newTask = (array)$taskData;
                $oldTask['desc'] = trim($this->file->excludeHtml($oldTask['desc'], 'noImg'));
                $newTask['desc'] = trim($this->file->excludeHtml($newTask['desc'], 'noImg'));
                $changes = common::createChanges((object)$oldTask, (object)$newTask);
                if(empty($changes)) continue;

                if($oldTask['estimate'] == 0 and $oldTask['left'] == 0) $taskData->left = $taskData->estimate;

                $taskData->lastEditedBy   = $this->app->user->account;
                $taskData->lastEditedDate = $now;

                $this->dao->update(TABLE_TASK)->data($taskData)
                    ->autoCheck()
                    ->where('id')->eq((int)$taskID)->exec();

                $actionID = $this->action->create('task', $taskID, 'Edited', '');
                $this->action->logHistory($actionID, $changes);
                $tasksID[$key] = $taskID;
            }
            else
            {
                if($taskData->story != false) $taskData->storyVersion = $this->loadModel('story')->getVersion($taskData->story);
<<<<<<< HEAD
                $taskData->left       = $taskData->estimate;
                $taskData->status     = 'wait';
                $taskData->openedBy   = $this->app->user->account;
                $taskData->openedDate = $now;

                if($taskData->deadline != '0000-00-00' and strtotime($taskData->deadline) < strtotime($taskData->estStarted)) continue;
                $this->dao->insert(TABLE_TASK)->data($taskData)
                    ->autoCheck()
                    ->exec();

                if(!dao::isError())
                {
                    $taskID = $this->dao->lastInsertID();
                    $this->loadModel('action')->create('task', $taskID, 'Opened', '');
                    $tasksID[$key] = $taskID;
                }
=======
                /*完善任务导入功能，删除项*/
                //$taskData->left       = $taskData->estimate;
                //$taskData->status     = 'wait';
                //$taskData->openedBy   = $this->app->user->account;
                //$taskData->openedDate = $now;

                if($taskData->deadline != '0000-00-00' and strtotime($taskData->deadline) < strtotime($taskData->estStarted)) continue;
                
                $this->dao->insert(TABLE_TASK)->data($taskData)
                    ->autoCheck()
                    ->exec();
                //完善任务导入功能,增加任务历史操作记录功能做出的改动
                if(!dao::isError())
                {
                    $taskID = $this->dao->lastInsertID();
                    $actions = $this->dao->select('*')->from(TABLE_ACTION)->where('objectType')->eq('task')->andWhere('objectID')->eq($oldID)->fetchAll();
                    foreach($actions as  $action)
                    {
                        $histories = $this->dao->select('*')->from(TABLE_HISTORY)->where('action')->eq($action->id)->fetchAll();
                        $action->id  = '';
                        $action->objectID = $taskID;
                        $this->dao->insert(TABLE_ACTION)->data($action)
                            ->exec();
                        $AID = $this->dao->lastInsertID();
                        foreach($histories as $history)
                        {
                            $history->id = '';
                            $history->action = $AID;
                            $this->dao->insert(TABLE_HISTORY)->data($history)
                                ->exec();
                        }
                    }
                }
                //源代码
                /*if(!dao::isError())
                {
                    $taskID = $this->dao->lastInsertID();
                    $this->loadModel('action')->create('task', $taskID, 'Opened', '');
                    $tasksID[$key] = $taskID;
                }*/
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
                else
                {
                    dao::getError();
                }
            }
        }

        unlink($this->session->importFile);
        unset($_SESSION['importFile']);

        return $tasksID;
    }
}
