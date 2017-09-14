<?php
//权限控制
$lang->resource->project->batchChangeProject = 'batchChangeProject';//新增
$lang->resource->task->deleteAudit          = 'deleteAudit';//新增
$lang->resource->task->deleteReview         = 'deleteReview';
$lang->resource->report->bugSummary         = 'bugSummary';
$lang->resource->report->storySummary       = 'storySummary';
$lang->resource->report->storyTaskSummary   = 'storyTaskSummary';
$lang->resource->report->taskSummary        = 'taskSummary';
$lang->resource->report->taskPlanSummary    = 'taskPlanSummary';
$lang->resource->report->burnUp             = 'burnUp';
$lang->resource->report->storyCycleSummary  = 'storyCycleSummary';
$lang->resource->report->bugBranchStatistics  = 'bugBranchStatistics';
$lang->resource->report->bugResponseTimeStatistics  = 'bugResponseTimeStatistics';
$lang->resource->report->dailyBugStatistics = 'dailyBugStatistics';
$lang->resource->custom->loginDefaultPage   = 'loginDefaultPage';

/* patchbuild. */
$lang->moduleOrder[200] = 'patchBuild';
$lang->resource->patchbuild = new stdclass();
$lang->resource->patchbuild->patchBuild = 'patchBuild';
$lang->resource->patchbuild->createPatchBuild = 'createPatchBuild';
$lang->resource->patchbuild->editpatchbuild   = 'editpatchbuild';
$lang->resource->patchbuild->deletePatchBuild = 'deletePatchBuild';
$lang->resource->patchbuild->view             = 'view';

$lang->build->methodOrder[5]  = 'createpatchbuild';
$lang->build->methodOrder[10] = 'editpatchbuild';
$lang->build->methodOrder[15] = 'deletePatchBuild';
$lang->build->methodOrder[20] = 'patchBuild';
$lang->build->methodOrder[25] = 'view';