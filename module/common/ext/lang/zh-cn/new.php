<?php
$lang->patchbuild = new stdclass();

$lang->project->menu->patchbuild = array('link' => '补丁版本|patchbuild|patchbuild|objectID=%s&from=project', 'alias' => 'patchbuild,createpatchbuild,editpatchbuild,', 'subModule' => 'patchbuild');

$lang->qa->menu->patchbuild = array('link' => '补丁版本|patchbuild|patchbuild|objectID=0&from=qa', 'subModule' => 'patchbuild');
$lang->bug->menu->patchbuild = array('link' => '补丁版本|patchbuild|patchbuild|objectID=0&from=qa', 'subModule' => 'patchbuild');
$lang->testcase->menu->patchbuild = array('link' => '补丁版本|patchbuild|patchbuild|objectID=0&from=qa', 'subModule' => 'patchbuild');
//菜单配置
$lang->report->menu->test    = array('link' => '测试|report|bugcreate', 'alias' => 'bugassign,bugsummary,dailybugstatistics,bugbranchstatistics,bugresponsetimestatistics');

$lang->report->menu->prj     = array('link' => $lang->projectCommon . '|report|projectdeviation', 'alias' => 'storysummary,burnup,storycyclesummary,storytasksummary,tasksummary,taskplansummary');

//9312 补丁版本下增加各字段的搜索功能
$lang->searchObjects['patchbuild']         = '补丁版本';
$lang->searchObjects['storyreview']        = '需求评审';

$lang->report->menu->scripttask   = array('link' => '脚本任务|report|scripttask', 'alias' => 'viewscript,editscript');

$lang->searchObjects['testtask']    = '内测版本';
$lang->project->menu->testtask  = array('link' => '内测版本|project|testtask|projectID=%s');
$lang->qa->menu->testtask  = array('link' => '内测版本|testtask|browse|productID=%s');
$lang->bug->menu->testtask  = array('link' => '内测版本|testtask|browse|productID=%s');
$lang->testcase->menu->testtask  = array('link' => '内测版本|testtask|browse|productID=%s', 'alias' => 'view,create,edit,linkcase,cases,start,close,batchrun,groupcase,report');
$lang->caselib->menu->testtask  = array('link' => '内测版本|testtask|browse|');

$lang->storyreview = new stdclass();

$lang->project->menu->storyreview = array('link' => '需求评审|storyreview|storyreview|objectID=%s&from=project', 'alias' => 'storyreview,createstoryreview,editstoryreview,', 'subModule' => 'storyreview');

$lang->qa->menu->storyreview = array('link' => '需求评审|storyreview|storyreview|objectID=0&from=qa', 'subModule' => 'storyreview');
$lang->bug->menu->storyreview = array('link' => '需求评审|storyreview|storyreview|objectID=0&from=qa', 'subModule' => 'storyreview');
$lang->testcase->menu->storyreview = array('link' => '需求评审|storyreview|storyreview|objectID=0&from=qa', 'subModule' => 'storyreview');

$lang->menugroup->patchbuild        = 'project';
$lang->menugroup->storyreview       = 'project';

$lang->my->menu->todostory          = '进度预警|my|todostory';
$lang->todostory       = new stdclass();
$lang->todostory->menu = $lang->my->menu;

$lang->icons['storyReview']    = 'list-alt';
