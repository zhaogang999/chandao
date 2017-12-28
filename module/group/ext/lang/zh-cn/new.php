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
$lang->resource->report->editScript = 'editScript';
$lang->resource->report->scriptTask = 'scriptTask';
$lang->resource->report->viewScript = 'viewScript';
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

/* storyreview. */
$lang->moduleOrder[205] = 'storyreview';
$lang->resource->storyreview = new stdclass();
$lang->resource->storyreview->storyreview   = 'storyreview';
$lang->resource->storyreview->create        = 'create';
$lang->resource->storyreview->edit          = 'edit';
$lang->resource->storyreview->delete        = 'delete';
$lang->resource->storyreview->view          = 'view';

$lang->storyreview->methodOrder[5]  = 'create';
$lang->storyreview->methodOrder[10] = 'edit';
$lang->storyreview->methodOrder[15] = 'delete';
$lang->storyreview->methodOrder[20] = 'storyreview';
$lang->storyreview->methodOrder[25] = 'view';

$lang->resource->story->batchStoryReview = 'batchStoryReview';
$lang->resource->story->batchEditDate    = 'batchEditDate';

$lang->resource->my->todoStory    = 'todoStory';
