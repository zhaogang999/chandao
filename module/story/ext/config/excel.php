<?php
$config->story->export                 = new stdclass();
$config->story->import                 = new stdclass();
$config->story->export->listFields     = explode(',', "module,plan,source,pri");
$config->story->export->sysListFields  = explode(',', "module,plan");
$config->story->export->templateFields = explode(',', "product,module,plan,title,spec,verify,source,pri,estimate,keywords");
$config->story->import->ignoreFields   = explode(',', "status,stage,openedBy,openedDate,assignedTo,assignedDate,mailto,reviewedBy,reviewedDate,closedBy,closedDate,closedReason,lastEditedBy,lastEditedDate,childStories,linkStories,duplicateStory,files");

//2670 需求导出列表中，需要增加需求的期望发版时间字段
$config->story->list->exportFields      = '
    id, product, branch, module, customPlan, plan, source, sourceNote, title, spec, verify, keywords,
    pri, estimate, status, stage, taskCountAB, bugCountAB, caseCountAB,
    openedBy, openedDate, assignedTo, assignedDate, mailto,
    reviewedBy, reviewedDate,
    closedBy, closedDate, closedReason,
    lastEditedBy, lastEditedDate,
    childStories, linkStories, duplicateStory, files';
