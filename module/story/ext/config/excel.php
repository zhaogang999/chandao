<?php
$config->story->export                 = new stdclass();
$config->story->import                 = new stdclass();
$config->story->export->listFields     = explode(',', "module,plan,source,pri");
$config->story->export->sysListFields  = explode(',', "module,plan");
$config->story->export->templateFields = explode(',', "product,module,plan,title,spec,verify,source,pri,estimate,keywords");
$config->story->import->ignoreFields   = explode(',', "status,stage,openedBy,openedDate,assignedTo,assignedDate,mailto,reviewedBy,reviewedDate,closedBy,closedDate,closedReason,lastEditedBy,lastEditedDate,childStories,linkStories,duplicateStory,files");
