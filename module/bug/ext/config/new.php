<?php
//增加legendComment字段；（导出bug的备注）
$config->bug->list->exportFields = 'id, product, branch, module, project, story, task, 
    title, keywords, severity, pri, type, os, browser,
    steps, status, activatedCount, confirmed, mailto,
    openedBy, openedDate, openedBuild, 
    assignedTo, assignedDate,
    resolvedBy, resolution, resolvedBuild, resolvedDate,
    closedBy, closedDate, 
    duplicateBug, linkBug, 
    case,
    lastEditedBy,
    lastEditedDate, legendComment, files';