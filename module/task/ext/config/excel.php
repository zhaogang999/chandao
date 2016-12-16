<?php
$config->task->export                 = new stdclass();
$config->task->import                 = new stdclass();
<<<<<<< HEAD
$config->task->export->listFields     = explode(',', "module,story,pri,type");
$config->task->export->sysListFields  = explode(',', "module,story");
$config->task->export->templateFields = explode(',', "project,module,name,desc,type,story,pri,estimate,estStarted,deadline");
$config->task->import->ignoreFields   = explode(',', "mailto,openedBy,openedDate,assignedTo,assignedDate,finishedBy,finishedDate,canceledBy,canceledDate,closedBy,closedDate,closedReason,lastEditedBy,lastEditedDate,files");
=======
//完善Excel任务导入，新增status下拉列表
$config->task->export->listFields     = explode(',', "module,story,pri,type,status");

$config->task->export->sysListFields  = explode(',', "module,story");
$config->task->export->templateFields = explode(',', "project,module,name,desc,type,story,pri,estimate,estStarted,deadline");
//完善Excel任务导入，删除mailto,assignedTo,assignedDate等（取消下面注释掉的内容）
//$config->task->import->ignoreFields   = explode(',', "openedBy");
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
$config->task->exportFields = '
    id, project, module, story,
    name, desc,
    type, pri, estStarted, realStarted, deadline, status,estimate, consumed, left,
    mailto,
    openedBy, openedDate, assignedTo, assignedDate,
    finishedBy, finishedDate, canceledBy, canceledDate,
    closedBy, closedDate, closedReason,
    lastEditedBy, lastEditedDate,files
    ';

