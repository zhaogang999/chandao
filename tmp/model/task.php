<?php
helper::import('H:\zentao\chandao\module\task\model.php');
class exttaskModel extends taskModel 
{
/**
 * Create a task.
 *
 * @param  int    $projectID
 * @access public
 * @return void
 */
public function create($projectID)
{
    $tasksID  = array();
    $taskFiles = array();
    $taskDetail = '';
    $auditDetail = '';
    $this->loadModel('file');
    $task = fixer::input('post')
        ->add('project', (int)$projectID)
        ->setDefault('estimate, left, story', 0)
        ->setDefault('estStarted', '0000-00-00')
        ->setDefault('deadline', '0000-00-00')
        ->setDefault('status', 'wait')
        ->setIF($this->post->estimate != false, 'left', $this->post->estimate)
        ->setIF($this->post->story != false, 'storyVersion', $this->loadModel('story')->getVersion($this->post->story))
        ->setDefault('openedBy',   $this->app->user->account)
        ->setDefault('openedDate', helper::now())
        ->stripTags($this->config->task->editor->create['id'], $this->config->allowedTags)
        ->join('mailto', ',')
        ->remove('after,files,labels,assignedTo,uid')
        ->get();

    foreach($this->post->assignedTo as $assignedTo)
    {
        $task->assignedTo = $assignedTo;
        if($assignedTo) $task->assignedDate = helper::now();

        /* Check duplicate task. */
        if($task->type != 'affair')
        {
            $result = $this->loadModel('common')->removeDuplicate('task', $task, "project=$projectID");
            if($result['stop'])
            {
                $tasksID[$assignedTo] = array('status' => 'exists', 'id' => $result['duplicate']);
                continue;
            }
        }

        $task = $this->file->processEditor($task, $this->config->task->editor->create['id'], $this->post->uid);

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
        $taskDetail->status = $task->status;
        $taskDetail->storyVersion = $task->storyVersion;
        $taskDetail->openedBy = $task->openedBy;
        $taskDetail->openedDate = $task->openedDate;
        $taskDetail->assignedTo = $task->assignedTo;
        $taskDetail->assignedDate = $task->assignedDate;

        if ($task->source == 'QA')
        {
            $taskDetail->source = $task->source;
            $this->dao->begin();
            $this->dao->insert(TABLE_TASK)->data($taskDetail)
                ->autoCheck()
                ->batchCheck($this->config->task->create->newRequiredFields, 'notempty')
                ->checkIF($taskDetail->estimate != '', 'estimate', 'float')
                ->checkIF($taskDetail->deadline != '0000-00-00', 'deadline', 'ge', $taskDetail->estStarted)
                ->exec();
            if (!dao::isError()) {
                //taskId
                $taskID = $this->dao->lastInsertID();
            } else {
                $this->dao->rollback();
                return false;
            }
            $num = count($task->auditID);
           
            for ($i = 0; $i < $num; $i++) {
                $auditDetail["$i"]->task       = $taskID;
                $auditDetail["$i"]->auditID   = $task->auditID["$i"];
                $auditDetail["$i"]->noDec     = $task->noDec["$i"];
                $auditDetail["$i"]->noType    = $task->noType["$i"];
                $auditDetail["$i"]->serious   = $task->serious["$i"];
                $auditDetail["$i"]->cause     = $task->cause["$i"];
                $auditDetail["$i"]->measures   = $task->measures["$i"];

                $this->dao->insert(TABLE_QAAUDIT)->data($auditDetail["$i"])
                    ->autoCheck()
                    ->batchCheck($this->config->task->create->newRequiredFields, 'notempty')
                    ->exec();
                if (!dao::isError()) {
                    $auditDetail["$i"]->id = $this->dao->lastInsertID();
                } else {
                    $this->dao->rollback();
                    return false;
                }
            }

            //成功操作
            $this->dao->commit();
            //设置需求状态
            if ($this->post->story) $this->loadModel('story')->setStage($this->post->story);
            $this->file->updateObjectID($this->post->uid, $taskID, 'task');
            if (!empty($taskFile)) {
                $taskFile->objectID = $taskID;
                $this->dao->insert(TABLE_FILE)->data($taskFile)->exec();
            } else {
                $taskFileTitle = $this->file->saveUpload('task', $taskID);
                $taskFile = $this->dao->select('*')->from(TABLE_FILE)->where('id')->eq(key($taskFileTitle))->fetch();
                unset($taskFile->id);
            }
            $tasksID[$assignedTo] = array('status' => 'created', 'id' => $taskID);
        }
        else
        {
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
                $tasksID[$assignedTo] = array('status' => 'created', 'id' => $taskID);
            }
            else
            {
                return false;
            }
        }
    }
    return $tasksID;
}
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
    $taskDetail = '';
    $review = '';
    $emptyReviewDetail = new stdclass();
    $emptyAuditDetail = new stdclass();
    $reviewDetailChanges = array();
    $changes = array();
    $now  = helper::now();

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

    $oldTask = $this->getById($taskID);
    if(isset($_POST['lastEditedDate']) and $oldTask->lastEditedDate != $this->post->lastEditedDate)
    {
        dao::$errors[] = $this->lang->error->editedByOther;
        return false;
    }

    $now  = helper::now();
    $task = fixer::input('post')
        ->setDefault('story, estimate, left, consumed', 0)
        ->setDefault('deadline', '0000-00-00')
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
        ->remove('comment,files,labels,uid')
        ->get();

    if($task->consumed < $oldTask->consumed)
    {
        die(js::error($this->lang->task->error->consumedSmall));
    }
    elseif($task->consumed != $oldTask->consumed or $task->left != $oldTask->left)
    {
        $estimate = new stdClass();
        $estimate->consumed = $task->consumed - $oldTask->consumed;
        $estimate->left     = $task->left;
        $estimate->task     = $taskID;
        $estimate->account  = $this->app->user->account;
        $estimate->date     = helper::now();
        $this->addTaskEstimate($estimate);
    }

    $task = $this->loadModel('file')->processEditor($task, $this->config->task->editor->edit['id'], $this->post->uid);

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
    $taskDetail->status = $task->status;

    if ($this->post->story != false and $this->post->story != $oldTask->story)
    {
        $taskDetail->storyVersion = $task->storyVersion;
    }
    $taskDetail->assignedTo = $task->assignedTo;
    $taskDetail->assignedDate = $task->assignedDate;
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
        $this->dao->rollback;
        return false;
    }else
    {
        $changes = common::createChanges($oldTask, $taskDetail);
    }
    //QA审计;
    if ($oldTask->source == 'QA')
    {

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
                $this->dao->rollback;
                return false;
            }
        }

        //reviewDetail
        $num = count($task->number);
        for ($i = 0; $i < $num; $i++)
        {
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
    $this->dao->commit();
    if($this->post->story != false) $this->loadModel('story')->setStage($this->post->story);
    $this->file->updateObjectID($this->post->uid, $taskID, 'task');
    return $changes;
}
public function setListValue($productID)
{
    return $this->loadExtension('excel')->setListValue($productID);
}

public function createFromImport($productID)
{
    return $this->loadExtension('excel')->createFromImport($productID);
}
/**
 * Finish a task.
 *
 * @param  int      $taskID
 * @access public
 * @return void
 */
public function finish($taskID)
{
    $emptyReviewDetail  = '';
    $reviewDetail       = array();
    $emptyReview        = '';
    $review             = '';
    $taskDetail         = '';
    $estimate           = '';

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

    $oldTask = $this->getById($taskID);
    $now  = helper::now();
    $task = fixer::input('post')
        ->setDefault('left', 0)
        ->setDefault('assignedTo',   $oldTask->openedBy)
        ->setDefault('assignedDate', $now)
        ->setDefault('status', 'done')
        ->setDefault('finishedBy, lastEditedBy', $this->app->user->account)
        ->setDefault('finishedDate, lastEditedDate', $now)
        ->remove('comment,files,labels')
        ->get();

    if($task->finishedDate == substr($now, 0, 10)) $task->finishedDate = $now;
    if(!is_numeric($task->consumed)) die(js::error($this->lang->task->error->consumedNumber));

    /* Record consumed and left. */
    $consumed = $task->consumed - $oldTask->consumed;
    if($consumed < 0) die(js::error($this->lang->task->error->consumedSmall));
    /*$estimate = fixer::input('post')
        ->setDefault('account', $this->app->user->account)
        ->setDefault('task', $taskID)
        ->setDefault('date', date(DT_DATE1))
        ->setDefault('left', 0)
        ->remove('finishedDate,comment,assignedTo,files,labels,consumed')
        ->get();*/
    $estimate->uid = $task->uid;
    $estimate->account = $this->app->user->account;
    $estimate->task = $taskID;
    $estimate->date = date(DT_DATE1);
    $estimate->left = 0;
    $estimate->consumed = $consumed;
    if($estimate->consumed) $this->addTaskEstimate($estimate);

    $taskInfo = $this->dao->select('*')->from(TABLE_TASK)->where('id')->eq("$taskID")->fetch();
    if ($taskInfo->type == 'review')
    {
        $taskDetail->consumed = $task->consumed;
        $taskDetail->assignedTo = $task->assignedTo;
        $taskDetail->finishedDate = $task->finishedDate;
        $taskDetail->left = $task->left;
        $taskDetail->assignedDate = $task->assignedDate;
        $taskDetail->status = $task->status;
        $taskDetail->finishedBy = $task->finishedBy;
        $taskDetail->lastEditedBy = $task->lastEditedBy;
        $taskDetail->lastEditedDate = $task->lastEditedDate;

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

        //附件为空跳出
        if($_FILES['files']['size']['0'] == '0') die(js::error($this->lang->task->error->fileNotEmpty));

        if($task->fileNO == '') die(js::error($this->lang->task->error->fileNOEmpty));
        if($task->recorder == '') die(js::error($this->lang->task->error->recorderEmpty));
        if($task->reviewName == '') die(js::error($this->lang->task->error->reviewNameEmpty));
        if($task->reviewDate == '') die(js::error($this->lang->task->error->reviewDateEmpty));
        if($task->doc == '') die(js::error($this->lang->task->error->docEmpty));
        if($task->reviewScope == '') die(js::error($this->lang->task->error->reviewScopeEmpty));
        if($task->referenceDoc == '') die(js::error($this->lang->task->error->referenceDocEmpty));
        if($task->reviewPlace == '') die(js::error($this->lang->task->error->reviewPlaceEmpty));
        if($task->reference == '') die(js::error($this->lang->task->error->referenceEmpty));
        if($task->effort == '') die(js::error($this->lang->task->error->effortEmpty));
        if($task->pages == '') die(js::error($this->lang->task->error->pagesEmpty));
        if($task->conclusion == '') die(js::error($this->lang->task->error->conclusionEmpty));
        if($task->reviewers == '') die(js::error($this->lang->task->error->reviewersEmpty));

        if(!is_numeric($task->effort)) die(js::error($this->lang->task->error->effortNumber));
        if(!is_numeric($task->pages)) die(js::error($this->lang->task->error->pagesNumber));
        
        //添加评审
        //1.task
        $this->dao->begin();
        $this->dao->update(TABLE_TASK)->data($taskDetail)
            ->autoCheck()
            ->check('consumed', 'notempty')
            ->where('id')->eq((int)$taskID)->exec();
        if(dao::isError())
        {
            $this->dao->rollback;
            return false;
        }

        //2.insert review
        $this->dao->insert(TABLE_REVIEW)->data($review)
            ->autoCheck()
            ->batchCheck($this->config->task->finish->requiredFields, 'notempty')
            ->exec();
        if (!dao::isError()) {
            $reviewID = $this->dao->lastInsertID();
        } else {
            $this->dao->rollback();
            return false;
        }

        $emptyReviewDetail->reviewID = $reviewID;

        $num = count($task->number);
        for ($i = 0; $i < $num; $i++) {
            $reviewDetail["$i"]->reviewID = $reviewID;
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
            $this->dao->insert(TABLE_REVIEWDETAIL)->data($reviewDetail["$i"])
                ->autoCheck()
                ->batchCheck($this->config->task->create->requiredFields, 'notempty')
                ->exec();
            if (!dao::isError()) {
                $reviewDetailChanges["$i"] = common::createChanges($emptyReviewDetail, $reviewDetail["$i"]);
            } else {
                $this->dao->rollback();
                return false;
            }
        }
        //成功操作
        $this->dao->commit();
        //设置需求状态
        if($this->post->story != false) $this->loadModel('story')->setStage($this->post->story);
        //获得改变值
        $taskChange = common::createChanges($oldTask, $taskDetail);
        //建一个空对象
        $emptyReview->fileNO = '';
        $emptyReview->recorder = '';
        $emptyReview->reviewName = '';
        $emptyReview->task = $taskID;
        $emptyReview->doc = '';
        $emptyReview->referenceDoc = '';
        $emptyReview->reference = '';
        $emptyReview->pages = '';
        $emptyReview->reviewers = '';
        $emptyReview->reviewDate = '';
        $emptyReview->reviewScope = '';
        $emptyReview->reviewPlace = '';
        $emptyReview->effort = '';
        $emptyReview->conclusion = '';
        $reviewChange = common::createChanges($emptyReview, $review);
        $changes = array_merge($taskChange,$reviewChange);

        foreach($reviewDetailChanges as $reviewDetailChange)
        {
            $changes = array_merge($changes,$reviewDetailChange);
        }
        return $changes;
    }
    else
    {
        //源代码，非评审
        $this->dao->update(TABLE_TASK)->data($task)
            ->autoCheck()
            ->check('consumed', 'notempty')
            ->where('id')->eq((int)$taskID)->exec();

        if($oldTask->story) $this->loadModel('story')->setStage($oldTask->story);
        if(!dao::isError()) return common::createChanges($oldTask, $task);
    }
}
//**//
}