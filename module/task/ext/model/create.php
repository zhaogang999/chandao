<?php
/**
 * Create a task.
 *
 * @param  int    $projectID
 * @access public
 * @return void
 */
public function create($projectID)
{
    $taskIdList  = array();
    $taskFiles = array();
    $taskDetail = new stdClass();

    $this->loadModel('file');
    $task = fixer::input('post')
        ->add('project', (int)$projectID)
        //->setDefault('estimate, left, story', 0)
        ->setDefault('story', 0)
        ->setDefault('status', 'wait')
        ->setIF($this->post->estimate != false, 'left', $this->post->estimate)
        ->setIF($this->post->story != false, 'storyVersion', $this->loadModel('story')->getVersion($this->post->story))
        ->setDefault('estStarted', '0000-00-00')
        ->setDefault('deadline', '0000-00-00')
        ->setIF(strpos($this->config->task->create->requiredFields, 'estStarted') !== false, 'estStarted', $this->post->estStarted)
        ->setIF(strpos($this->config->task->create->requiredFields, 'deadline') !== false, 'deadline', $this->post->deadline)
        ->setDefault('openedBy',   $this->app->user->account)
        ->setDefault('openedDate', helper::now())
        ->setDefault('releasedDate', '0000-00-00')
        ->stripTags($this->config->task->editor->create['id'], $this->config->allowedTags)
        ->join('mailto', ',')
        ->remove('after,files,labels,assignedTo,uid,storyEstimate,storyDesc,storyPri,team,teamEstimate,teamMember,multiple,teams')
        ->get();

    foreach($this->post->assignedTo as $assignedTo)
    {
        /* When type is affair and has assigned then ignore none. */
        if($task->type == 'affair' and count($this->post->assignedTo) > 1 and empty($assignedTo)) continue;

        $task->assignedTo = $assignedTo;
        if($assignedTo) $task->assignedDate = helper::now();

        $teams = array();
        if($this->post->multiple)
        {
            $estimate = 0;
            $left     = 0;
            foreach($this->post->team as $row => $account)
            {
                if(empty($account) or isset($team[$account])) continue;
                $member = new stdClass();
                $member->project  = 0;
                $member->account  = $account;
                $member->role     = $assignedTo;
                $member->join     = helper::today();
                $member->estimate = $this->post->teamEstimate[$row] ? (float)$this->post->teamEstimate[$row] : 0;
                $member->left     = $member->estimate;
                $member->order    = $row;
                $teams[$account]  = $member;

                $estimate += (float)$member->estimate;
                $left     += (float)$member->left;
            }

            if(!empty($teams))
            {
                $firstMember        = reset($teams);
                $task->assignedTo   = $firstMember->account;
                $task->assignedDate = helper::now();
                $task->estimate     = $estimate;
                $task->left         = $left;
            }
        }

        /* Check duplicate task. */
        if($task->type != 'affair')
        {
            $result = $this->loadModel('common')->removeDuplicate('task', $task, "project=$projectID and story=$task->story");
            if($result['stop'])
            {
                $taskIdList[$assignedTo] = array('status' => 'exists', 'id' => $result['duplicate']);
                continue;
            }
        }

        $task = $this->file->processImgURL($task, $this->config->task->editor->create['id'], $this->post->uid);

        //任务数据新增
        $taskDetail->source = $task->source;
        $taskDetail->module = $task->module;
        $taskDetail->type = $task->type;
        $taskDetail->story = $task->story;
        $taskDetail->color = $task->color;
        $taskDetail->name = $task->name;
        $taskDetail->pri = $task->pri;
        $taskDetail->estimate = $task->estimate;
        $taskDetail->desc = $task->desc;
        $taskDetail->estStarted = $task->estStarted;
        $taskDetail->deadline = $task->deadline;
        $taskDetail->mailto = $task->mailto;
        $taskDetail->project = $task->project;
        $taskDetail->left = $task->left;
        $taskDetail->status = $task->status;
        if ($this->post->story != false)
        {
            $taskDetail->storyVersion = $task->storyVersion;
        }
        $taskDetail->openedBy = $task->openedBy;
        $taskDetail->openedDate = $task->openedDate;
        $taskDetail->assignedTo = $task->assignedTo;
        $taskDetail->assignedDate = $task->assignedDate;
        //禅道任务增加关键字字段；需求：858；行号：72-73
        $taskDetail->keywords    = $task->keywords;

        //源代码
        $this->dao->insert(TABLE_TASK)->data($taskDetail)
            ->autoCheck()
            ->batchCheck($this->config->task->create->newRequiredFields, 'notempty')
            ->checkIF($taskDetail->estimate != '', 'estimate', 'float')
            ->checkIF($taskDetail->deadline != '0000-00-00', 'deadline', 'ge', $task->estStarted)
            ->exec();

        if(!dao::isError())
        {
            $taskID = $this->dao->lastInsertID();
            if($this->post->story) $this->loadModel('story')->setStage($this->post->story);
            $this->file->updateObjectID($this->post->uid, $taskID, 'task');
            if(!empty($taskFiles))
            {
                foreach($taskFiles as $taskFile)
                {
                    $taskFile->objectID = $taskID;
                    $this->dao->insert(TABLE_FILE)->data($taskFile)->exec();
                }
            }
            else
            {
                $taskFileTitle = $this->file->saveUpload('task', $taskID);
                $taskFiles = $this->dao->select('*')->from(TABLE_FILE)->where('id')->in(array_keys($taskFileTitle))->fetchAll('id');
                foreach($taskFiles as $fileID => $taskFile) unset($taskFiles[$fileID]->id);
            }

            if(!empty($teams))
            {
                foreach($teams as $team)
                {
                    $team->task = $taskID;
                    $this->dao->insert(TABLE_TEAM)->data($team)->autoCheck()->exec();
                }
            }

            if(!dao::isError()) $this->loadModel('score')->create('task', 'create', $taskID);
            $taskIdList[$assignedTo] = array('status' => 'created', 'id' => $taskID);
        }
        else
        {
            return false;
        }

        if ($task->type == 'script')
        {
            $scriptDetail = new stdClass();
            $scriptDetail->task = $taskID;
            $scriptDetail->scriptName = $task->scriptName;
            $scriptDetail->scriptType = $task->scriptType;
            $scriptDetail->lob = $task->lob;
            $scriptDetail->frequency = $task->frequency;
            $scriptDetail->configurationFile = $task->configurationFile;
            $scriptDetail->output = $task->output;
            $scriptDetail->precondition = $task->precondition;
            $scriptDetail->performBody = $task->performBody;
            $scriptDetail->performMode = $task->performMode;
            $scriptDetail->performSystem = $task->performSystem;
            $scriptDetail->scriptPath = $task->scriptPath;
            $scriptDetail->notice = $task->notice;

            $this->dao->insert(TABLE_SCRIPT)->data($scriptDetail)
                ->autoCheck()
                ->exec();

            if (!dao::isError()) {
                $scriptDetail->id = $this->dao->lastInsertID();
            } else {
                return false;
            }
        }

        if ($task->source == 'QA') {
            $num = count($task->auditID);

            for ($i = 0; $i < $num; $i++)
            {
                $auditDetail["$i"] = new stdClass();
                $auditDetail["$i"]->task = $taskID;
                $auditDetail["$i"]->auditID = $task->auditID["$i"];
                $auditDetail["$i"]->noDec = $task->noDec["$i"];
                $auditDetail["$i"]->noType = $task->noType["$i"];
                $auditDetail["$i"]->serious = $task->serious["$i"];
                $auditDetail["$i"]->cause = $task->cause["$i"];
                $auditDetail["$i"]->measures = $task->measures["$i"];

                $this->dao->insert(TABLE_QAAUDIT)->data($auditDetail["$i"])
                    ->autoCheck()
                    ->batchCheck($this->config->task->create->newRequiredFields, 'notempty')
                    ->exec();

                if (!dao::isError()) {
                    $auditDetail["$i"]->id = $this->dao->lastInsertID();
                } else {
                    return false;
                }
            }
        }
    }
    return $taskIdList;
}