<?php
$config->task->create->requiredFields      = 'name,type,estimate';
$config->task->edit->requiredFields      = 'name,type,fileNO,recorder,reviewName,referenceDoc,reference,pages,reviewers,reviewDate,reviewScope,reviewPlace,effort,conclusion,doc,auditID,noDec,noType,serious,cause,measures';
$config->task->finish->requiredFields    = 'consumed,file,fileNO,recorder,reviewName,referenceDoc,reference,pages,reviewers,reviewDate,reviewScope,reviewPlace,effort,conclusion,doc,scriptName,scriptType,lob,frequency,configurationFile,output,precondition,performBody,performMode,performSystem,scriptPath';
$config->task->create->newRequiredFields    = 'name,type,estimate,auditID,noDec,noType,serious,cause,measures';
//禅道任务增加关键字字段；需求：858 批量添加任务，批量编辑任务增加关键字字段
$config->task->customBatchCreateFields = 'module,story,assignedTo,estimate,estStarted,deadline,desc,pri,keywords';
$config->task->customBatchEditFields   = 'module,assignedTo,status,pri,estimate,record,left,estStarted,deadline,finishedBy,canceledBy,closedBy,closedReason,keywords,realStarted';

//在任务列表页面增加关键字字段
$config->task->datatable->fieldList['keywords']['title']    = 'keywords';
$config->task->datatable->fieldList['keywords']['fixed']    = 'left';
$config->task->datatable->fieldList['keywords']['width']    = '40';
$config->task->datatable->fieldList['keywords']['required'] = 'no';

//在任务列表页面增加任务关联需求的所属计划字段;title:高级表标题；fixed：left|right|no 是否固定在左右两侧；sort：yes|no 是否排序；width：数字 该字段所占宽度；required：yes|no 是否为必选项
$config->task->datatable->fieldList['plan']['title']    = 'plan';
$config->task->datatable->fieldList['plan']['fixed']    = 'no';
$config->task->datatable->fieldList['plan']['sort']    = 'no';
$config->task->datatable->fieldList['plan']['width']    = '140';
$config->task->datatable->fieldList['plan']['required'] = 'no';

//$config->task->editor->create   = array('id' => 'desc,notice', 'tools' => 'simpleTools');
$config->task->editor->edit     = array('id' => 'desc,comment,notice', 'tools' => 'simpleTools');
$config->task->editor->finish   = array('id' => 'comment,notice', 'tools' => 'simpleTools');