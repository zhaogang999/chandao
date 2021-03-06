<?php
/**
 * Update a task.
 *
 * @param  int    $taskID
 * @access public
 * @return void
 */
public function update($taskID)
{
    //新增
    $reviewDetail = array();
    $auditDetail = array();
    $taskDetail = new stdClass();
    $emptyReviewDetail = new stdclass();
    $reviewDetailChanges = array();
    $changes = array();

    $emptyReviewDetail->reviewID = '';
    $emptyReviewDetail->number = '';
    $emptyReviewDetail->reviewer = '';
    $emptyReviewDetail->item = '';
    $emptyReviewDetail->line = '';
    $emptyReviewDetail->severity = '';
    $emptyReviewDetail->description = '';
    $emptyReviewDetail->proposal = '';
    $emptyReviewDetail->changed = '';
    $emptyReviewDetail->action = '';
    $emptyReviewDetail->chkd = '';

    $oldTask = $this->dao->select('*')->from(TABLE_TASK)->where('id')->eq((int)$taskID)->fetch();
    if(!empty($_POST['lastEditedDate']) and $oldTask->lastEditedDate != $this->post->lastEditedDate)
    {
        dao::$errors[] = $this->lang->error->editedByOther;
        return false;
    }

    $now  = helper::now();
    $task = fixer::input('post')
        ->setDefault('story, estimate, left, consumed', 0)
        ->setDefault('estStarted', '0000-00-00')
        ->setDefault('deadline', '0000-00-00')
        ->setIF(strpos($this->config->task->edit->requiredFields, 'estStarted') !== false, 'estStarted', $this->post->estStarted)
        ->setIF(strpos($this->config->task->edit->requiredFields, 'deadline') !== false, 'deadline', $this->post->deadline)
        ->setIF($this->post->story != false and $this->post->story != $oldTask->story, 'storyVersion', $this->loadModel('story')->getVersion($this->post->story))

        ->setIF($this->post->status == 'done', 'left', 0)
        ->setIF($this->post->status == 'done'   and !$this->post->finishedBy,   'finishedBy',   $this->app->user->account)
        ->setIF($this->post->status == 'done'   and !$this->post->finishedDate, 'finishedDate', $now)

        ->setIF($this->post->status == 'cancel' and !$this->post->canceledBy,   'canceledBy',   $this->app->user->account)
        ->setIF($this->post->status == 'cancel' and !$this->post->canceledDate, 'canceledDate', $now)
        ->setIF($this->post->status == 'cancel', 'assignedTo',   $oldTask->openedBy)
        ->setIF($this->post->status == 'cancel', 'assignedDate', $now)

        ->setIF($this->post->status == 'closed' and !$this->post->closedBy,     'closedBy',     $this->app->user->account)
        ->setIF($this->post->status == 'closed' and !$this->post->closedDate,   'closedDate',   $now)
        ->setIF($this->post->consumed > 0 and $this->post->left > 0 and $this->post->status == 'wait', 'status', 'doing')

        ->setIF($this->post->assignedTo != $oldTask->assignedTo, 'assignedDate', $now)

        ->setIF($this->post->status == 'wait' and $this->post->left == $oldTask->left and $this->post->consumed == 0, 'left', $this->post->estimate)

        ->add('lastEditedBy',   $this->app->user->account)
        ->add('lastEditedDate', $now)
        ->stripTags($this->config->task->editor->edit['id'], $this->config->allowedTags)
        ->join('mailto', ',')
        ->remove('comment,files,labels,uid,multiple,team,teamEstimate,teamConsumed,teamLeft')
        ->get();

    if($task->consumed < $oldTask->consumed) die(js::error($this->lang->task->error->consumedSmall));

    /* Fix bug#1388, Check children task projectID and moduleID. */
    if($task->project != $oldTask->project)
    {
        $this->dao->update(TABLE_TASK)->set('project')->eq($task->project)->set('module')->eq($task->module)->where('parent')->eq($taskID)->exec();
    }

    $task = $this->loadModel('file')->processImgURL($task, $this->config->task->editor->edit['id'], $this->post->uid);

    $teams = array();
    if($this->post->multiple)
    {
        foreach($this->post->team as $row => $account)
        {
            if(empty($account) or isset($team[$account])) continue;

            $member = new stdClass();
            $member->account  = $account;
            $member->role     = $task->assignedTo;
            $member->join     = helper::today();
            $member->root     = $taskID;
            $member->type     = 'task';
            $member->estimate = $this->post->teamEstimate[$row] ? $this->post->teamEstimate[$row] : 0;
            $member->consumed = $this->post->teamConsumed[$row] ? $this->post->teamConsumed[$row] : 0;
            $member->left     = $this->post->teamLeft[$row] ? $this->post->teamLeft[$row] : ($member->estimate - $member->consumed);
            $member->order    = $row;
            $teams[$account]  = $member;
            if($task->status == 'done') $member->left = 0;
        }
    }

    /* Save team. */
    $this->dao->delete()->from(TABLE_TEAM)->where('root')->eq($taskID)->andWhere('type')->eq('task')->exec();
    if(!empty($teams))
    {
        foreach($teams as $member) $this->dao->insert(TABLE_TEAM)->data($member)->autoCheck()->exec();
        $task = $this->computeHours4Multiple($oldTask, $task);
    }

    //需求1340 任务点击完成时，开启时间和完成时间改为必填项。
    if($task->status == 'done' || $task->status == 'doing')
    {
        if ($task->realStarted =='0000-00-00')
        {
            die(js::error($this->lang->task->error->doneError));
        }
    }

    //任务数据新增
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
    if (isset($task->status))
    {
        $taskDetail->status = $task->status;
    }
    //禅道任务增加关键字字段；需求：858；行号：100-101
    $taskDetail->keywords    = $task->keywords;

    if ($this->post->story != false and $this->post->story != $oldTask->story)
    {
        $taskDetail->storyVersion = $task->storyVersion;
    }
    $taskDetail->assignedTo = $task->assignedTo;
    if (!empty($task->assignedDate))
    {
        $taskDetail->assignedDate = $task->assignedDate;
    }
    $taskDetail->consumed = $task->consumed;
    $taskDetail->realStarted = $task->realStarted;
    $taskDetail->finishedBy = $task->finishedBy;
    $taskDetail->finishedDate = $task->finishedDate;
    $taskDetail->canceledBy = $task->canceledBy;
    $taskDetail->canceledDate = $task->canceledDate;
    $taskDetail->closedBy = $task->closedBy;
    $taskDetail->closedReason = $task->closedReason;
    $taskDetail->closedDate = $task->closedDate;
    $taskDetail->lastEditedBy = $task->lastEditedBy;
    $taskDetail->lastEditedDate = $task->lastEditedDate;
    //1 task
    $this->dao->begin();
    $this->dao->update(TABLE_TASK)->data($taskDetail)
        ->autoCheck()
        ->batchCheckIF($taskDetail->status != 'cancel', $this->config->task->edit->requiredFields, 'notempty')
        ->checkIF($taskDetail->deadline != '0000-00-00', 'deadline', 'ge', $task->estStarted)

        ->checkIF($taskDetail->estimate != false, 'estimate', 'float')
        ->checkIF($taskDetail->left     != false, 'left',     'float')
        ->checkIF($taskDetail->consumed != false, 'consumed', 'float')
        ->checkIF($taskDetail->status != 'wait' and $taskDetail->left == 0 and $taskDetail->status != 'cancel' and $taskDetail->status != 'closed', 'status', 'equal', 'done')

        ->batchCheckIF($taskDetail->status == 'wait' or $taskDetail->status == 'doing', 'finishedBy, finishedDate,canceledBy, canceledDate, closedBy, closedDate, closedReason', 'empty')

        ->checkIF($taskDetail->status == 'done', 'consumed', 'notempty')
        ->checkIF($taskDetail->status == 'done' and $taskDetail->closedReason, 'closedReason', 'equal', 'done')
        ->batchCheckIF($taskDetail->status == 'done', 'canceledBy, canceledDate', 'empty')

        ->checkIF($taskDetail->status == 'closed', 'closedReason', 'notempty')
        ->batchCheckIF($taskDetail->closedReason == 'cancel', 'finishedBy, finishedDate', 'empty')
        ->where('id')->eq((int)$taskID)->exec();

    if(dao::isError())
    {
        $this->dao->rollback();
        return false;
    }else
    {
        $changes = common::createChanges($oldTask, $taskDetail);
    }
    //QA审计;
    if ($oldTask->source == 'QA')
    {
        $emptyAuditDetail = new stdclass();
        $emptyAuditDetail->auditID = '';
        $emptyAuditDetail->noDec = '';
        $emptyAuditDetail->noType = '';
        $emptyAuditDetail->serious = '';
        $emptyAuditDetail->cause = '';
        $emptyAuditDetail->measures = '';
        //不符合项
        $num = count($task->auditID);
        for ($i = 0; $i < $num; $i++)
        {
            $auditDetail["$i"] = new stdClass();
            //$auditDetail["$i"]->aid       = $task->aid["$i"];
            $auditDetail["$i"]->auditID  = $task->auditID["$i"];
            $auditDetail["$i"]->noDec    = $task->noDec["$i"];
            $auditDetail["$i"]->noType   = $task->noType["$i"];
            $auditDetail["$i"]->serious  = $task->serious["$i"];
            $auditDetail["$i"]->cause     = $task->cause["$i"];
            $auditDetail["$i"]->measures   = $task->measures["$i"];
            //过滤空记录
            if ($auditDetail["$i"]->noDec == '')
            {
                continue;
            }
            $oldAuditDetail = $this->dao->select('*')
                ->from(TABLE_QAAUDIT)
                ->where('id')->eq($task->aid["$i"])
                ->andWhere('deleted')->eq('0')
                ->fetch();
            //新增不合格项详情
            if ($task->aid["$i"] == '')
            {
                if(empty($auditDetail["$i"]->noType)) die(js::error($this->lang->task->error->emptyNoType));
                if(empty($auditDetail["$i"]->serious)) die(js::error($this->lang->task->error->emptySerious));
                //unset($auditDetail["$i"]->id);
                $auditDetail["$i"]->task   = $taskID;
                $this->dao->insert(TABLE_QAAUDIT)->data($auditDetail["$i"])
                    ->autoCheck()
                    ->batchCheck($this->config->task->edit->requiredFields, 'notempty')
                    ->exec();
                if (!dao::isError()) {
                    unset($auditDetail["$i"]->task);
                    $auditDetailChanges["$i"] = common::createChanges($emptyAuditDetail, $auditDetail["$i"]);
                } else {
                    $this->dao->rollback();
                    return false;
                }
            }
            //编辑不合格项详情
            else
            {
                $this->dao->update(TABLE_QAAUDIT)->data($auditDetail["$i"])
                    ->autoCheck()
                    ->batchCheck($this->config->task->edit->requiredFields, 'notempty')
                    ->where('id')->eq($task->aid["$i"])->exec();
                if (!dao::isError())
                {
                    $auditDetailChanges["$i"] = common::createChanges($oldAuditDetail, $auditDetail["$i"]);
                }
                else
                {
                    $this->dao->rollback();
                    return false;
                }
            }
        }
        //成功操作
        foreach($auditDetailChanges as $auditDetailChange)
        {
            $changes = array_merge($changes,$auditDetailChange);
        }
    }

    if ($task->type == 'review' && $task->status == 'done')
    {
        $review = new stdClass();
        $review->fileNO = $task->fileNO;
        $review->recorder = $task->recorder;
        $review->reviewName = $task->reviewName;
        $review->task = $taskID;
        $review->doc = $task->doc;
        $review->referenceDoc = $task->referenceDoc;
        $review->reference = $task->reference;
        $review->pages = $task->pages;
        $review->reviewers = $task->reviewers;
        $review->reviewDate = $task->reviewDate;
        $review->reviewScope = $task->reviewScope;
        $review->reviewPlace = $task->reviewPlace;
        $review->effort = $task->effort;
        $review->conclusion = $task->conclusion;

        //编辑评审
        $oldReview = $this->dao->select('*')
            ->from(TABLE_REVIEW)
            ->where('id')
            ->eq("$task->reviewID")
            ->fetch();
        //review
        if (!$oldReview)
        {
            //附件为空跳出
            if($_FILES['files']['size']['0'] == '0') die(js::error($this->lang->task->error->fileNotEmpty));

            $this->dao->insert(TABLE_REVIEW)->data($review)
                ->autoCheck()
                ->batchCheck($this->config->task->finish->requiredFields, 'notempty')
                ->exec();
            if (!dao::isError()) {
                $task->reviewID = $this->dao->lastInsertID();
            } else {
                $this->dao->rollback();
                return false;
            }
        }
        else
        {
            $review->id = $task->reviewID;
            $this->dao->update(TABLE_REVIEW)->data($review)
                ->autoCheck()
                ->batchCheckIF($task->status != 'cancel', $this->config->task->edit->requiredFields, 'notempty')
                ->where('id')->eq($review->id)->limit(1)->exec();
            if(dao::isError())
            {
                $this->dao->rollback();
                return false;
            }
        }

        //reviewDetail
        $num = count($task->number);
        for ($i = 0; $i < $num; $i++)
        {
            $reviewDetail["$i"] = new stdClass();
            $reviewDetail["$i"]->id = $task->id["$i"];
            $reviewDetail["$i"]->reviewID = $task->reviewID;
            $reviewDetail["$i"]->number = $task->number["$i"];
            $reviewDetail["$i"]->reviewer = $task->reviewer["$i"];
            $reviewDetail["$i"]->item = $task->item["$i"];
            $reviewDetail["$i"]->line = $task->line["$i"];
            $reviewDetail["$i"]->severity = $task->severity["$i"];
            $reviewDetail["$i"]->description = $task->description["$i"];
            $reviewDetail["$i"]->proposal = $task->proposal["$i"];
            $reviewDetail["$i"]->changed = $task->changed["$i"];
            $reviewDetail["$i"]->action = $task->action["$i"];
            $reviewDetail["$i"]->chkd = $task->chkd["$i"];
            //过滤空记录
            if ($reviewDetail["$i"]->description == '')
            {
                continue;
            }
            $oldreViewDetail = $this->dao->select('*')
                ->from(TABLE_REVIEWDETAIL)
                ->where('id')->eq($reviewDetail["$i"]->id)
                ->andWhere('deleted')->eq('0')
                ->fetch();
            //新增评审详情
            if (!$oldreViewDetail)
            {
                unset($reviewDetail["$i"]->id);

                $this->dao->insert(TABLE_REVIEWDETAIL)->data($reviewDetail["$i"])
                    ->autoCheck()
                    ->batchCheck($this->config->task->create->requiredFields, 'notempty')
                    ->exec();
                if (!dao::isError()) {
                    $emptyReviewDetail->reviewID = $task->reviewID;
                    $reviewDetailChanges["$i"] = common::createChanges($emptyReviewDetail, $reviewDetail["$i"]);
                } else {
                    $this->dao->rollback();
                    return false;
                }
            }
            //编辑任务详情
            else
            {
                $this->dao->update(TABLE_REVIEWDETAIL)->data($reviewDetail["$i"])
                    ->autoCheck()
                    ->batchCheckIF($task->status != 'cancel', $this->config->task->edit->requiredFields, 'notempty')
                    ->where('id')->eq($reviewDetail["$i"]->id)->exec();
                if (!dao::isError())
                {
                    $reviewDetailChanges["$i"] = common::createChanges($oldreViewDetail, $reviewDetail["$i"]);
                }
                else
                {
                    $this->dao->rollback();
                    return false;
                }
            }
        }
        //成功操作
        $reviewChange = common::createChanges($oldReview, $review);
        $changes = array_merge($changes,$reviewChange);

        foreach($reviewDetailChanges as $reviewDetailChange)
        {
            $changes = array_merge($changes,$reviewDetailChange);
        }
    }

    if ($task->type == 'script')
    {
        $oldScriptDetail = $this->dao->select('*')
            ->from(TABLE_SCRIPT)
            ->where('task')->eq("$taskID")
            ->andWhere('deleted')->eq('0')
            ->fetch();
        
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

        if ($oldScriptDetail)
        {
            $this->dao->update(TABLE_SCRIPT)->data($scriptDetail)
                ->autoCheck()
                ->batchCheck($this->config->task->finshScript->requiredFields, 'notempty')
                ->where('id')->eq($task->scriptID)->limit(1)->exec();

            if(dao::isError())
            {
                $this->dao->rollback();
                return false;
            }
            else
            {
                $scriptChange = common::createChanges($oldScriptDetail, $scriptDetail);
                $changes = array_merge($changes, $scriptChange);
            }
        }
        else
        {
            $this->dao->insert(TABLE_SCRIPT)->data($scriptDetail)
                ->autoCheck()
                ->exec();

            if(dao::isError())
            {
                $this->dao->rollback();
                return false;
            }
        }
    }

    $this->dao->commit();
    if($oldTask->parent) $this->updateParentStatus($taskID);
    
    if($this->post->story != false) $this->loadModel('story')->setStage($this->post->story);
    
    if($task->status == 'done')   $this->loadModel('score')->create('task', 'finish', $taskID);
    if($task->status == 'closed') $this->loadModel('score')->create('task', 'close', $taskID);
    $this->file->updateObjectID($this->post->uid, $taskID, 'task');
    return $changes;
}
