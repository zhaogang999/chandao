<?php
//权限控制
$lang->resource->project->batchChangeProject = 'batchChangeProject';//新增
$lang->resource->project->storyProgress      = 'storyProgress';//新增
$lang->resource->task->deleteAudit          = 'deleteAudit';//新增
$lang->resource->task->deleteReview         = 'deleteReview';
$lang->resource->report->bugSummary         = 'bugSummary';
$lang->resource->report->storySummary       = 'storySummary';
$lang->resource->report->storyReviewSummary = 'storyReviewSummary';
$lang->resource->report->storyTaskSummary   = 'storyTaskSummary';
$lang->resource->report->taskSummary        = 'taskSummary';
$lang->resource->report->taskPlanSummary    = 'taskPlanSummary';
$lang->resource->report->burnUp             = 'burnUp';
$lang->resource->report->storyCycleSummary  = 'storyCycleSummary';
$lang->resource->report->bugBranchStatistics = 'bugBranchStatistics';
$lang->resource->report->bugResponseTimeStatistics = 'bugResponseTimeStatistics';
$lang->resource->report->editScript = 'editScript';
$lang->resource->report->scriptTask = 'scriptTask';
$lang->resource->report->viewScript = 'viewScript';
$lang->resource->report->dailyBugStatistics = 'dailyBugStatistics';
$lang->resource->custom->loginDefaultPage   = 'loginDefaultPage';

/* patchbuild. */
$lang->moduleOrder[200] = 'patchBuild';
$lang->resource->patchbuild = new stdclass();
$lang->resource->patchbuild->patchBuild       = 'patchBuild';
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
$lang->resource->storyreview->leftProblem   = 'leftProblem';
$lang->resource->storyreview->resolve       = 'resolve';

$lang->storyreview->methodOrder[5]  = 'create';
$lang->storyreview->methodOrder[10] = 'edit';
$lang->storyreview->methodOrder[15] = 'delete';
$lang->storyreview->methodOrder[20] = 'storyreview';
$lang->storyreview->methodOrder[25] = 'view';
$lang->storyreview->methodOrder[30] = 'leftProblem';
$lang->storyreview->methodOrder[35] = 'resolve';

$lang->resource->story->batchStoryReview = 'batchStoryReview';
$lang->resource->story->batchEditDate    = 'batchEditDate';

$lang->resource->my->todoStory    = 'todoStory';
//3286 创建需求时就可以选择关联需求，并且支持相关需求处显示“无”
$lang->resource->story->magicAuth = 'magicAuth';
$lang->resource->story->batchChangeIfLinkStories = 'batchChangeIfLinkStories';
$lang->resource->story->batchChangeTestStatus    = 'batchChangeTestStatus';
$lang->resource->story->batchChangeVerifyStatus  = 'batchChangeVerifyStatus';

/* issue. */
$lang->moduleOrder[205] = 'issue';
$lang->resource->issue = new stdclass();
$lang->resource->issue->browse = 'browse';
$lang->resource->issue->create = 'create';
$lang->resource->issue->edit   = 'edit';
$lang->resource->issue->view   = 'view';
$lang->resource->issue->delete = 'delete';

$lang->issue->methodOrder[5]  = 'browse';
$lang->issue->methodOrder[10] = 'create';
$lang->issue->methodOrder[15] = 'edit';
$lang->issue->methodOrder[20] = 'view';
$lang->issue->methodOrder[25] = 'delete';

$lang->moduleOrder[210] = 'riskmanage';
$lang->resource->riskmanage = new stdclass();
$lang->resource->riskmanage->browse = 'browse';
$lang->resource->riskmanage->create = 'create';
$lang->resource->riskmanage->edit   = 'edit';
$lang->resource->riskmanage->view   = 'view';
$lang->resource->riskmanage->delete = 'delete';
$lang->resource->riskmanage->close  = 'close';
$lang->resource->riskmanage->batchClose  = 'batchClose';

$lang->riskmanage->methodOrder[5]  = 'browse';
$lang->riskmanage->methodOrder[10] = 'create';
$lang->riskmanage->methodOrder[15] = 'edit';
$lang->riskmanage->methodOrder[20] = 'view';
$lang->riskmanage->methodOrder[25] = 'delete';
$lang->riskmanage->methodOrder[30] = 'close';
$lang->riskmanage->methodOrder[35] = 'batchClose';

$lang->resource->story->switchStoryLock = 'switchStoryLock';