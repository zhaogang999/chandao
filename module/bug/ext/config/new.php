<?php
//增加legendComment字段；（导出bug的备注）
/*$config->bug->list->exportFields = 'id, product, branch, module, project, story, task,
    title, keywords, severity, pri, type, os, browser,
    steps, status, activatedCount, confirmed, mailto,
    openedBy, openedDate, openedBuild, 
    assignedTo, assignedDate,
    resolvedBy, resolution, resolvedBuild, resolvedDate,
    closedBy, closedDate, 
    duplicateBug, linkBug, 
    case,
    lastEditedBy,
    lastEditedDate, legendComment, files';*/
//增加deadline字段导出
$config->bug->list->exportFields = 'id, product, branch, module, project, story, task, 
    title, keywords, severity, pri, type, os, browser,
    steps, status, activatedCount, confirmed, mailto,
    openedBy, openedDate, openedBuild,deadline, 
    assignedTo, assignedDate,
    resolvedBy, resolution, resolvedBuild, resolvedDate,
    closedBy, closedDate, 
    duplicateBug, linkBug, 
    case,
    lastEditedBy,
    lastEditedDate, files';

//1747 提bug时，限定某些字段为必填项
$config->bug->create->requiredFields  = 'module,project,openedBuild,title,severity,pri';
$config->bug->list->customCreateFields      = 'project,story,task,pri,severity,os,browser,mailto,keywords';