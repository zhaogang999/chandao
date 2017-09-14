<?php
$lang->patchbuild = new stdclass();

$lang->project->menu->patchbuild = array('link' => '补丁版本|patchbuild|patchbuild|objectID=%s&from=project', 'alias' => 'patchbuild,createpatchbuild,editpatchbuild,', 'subModule' => 'patchbuild');

$lang->qa->menu->patchbuild = array('link' => '补丁版本|patchbuild|patchbuild|objectID=%s&from=qa', 'subModule' => 'patchbuild');
$lang->bug->menu->patchbuild = array('link' => '补丁版本|patchbuild|patchbuild|objectID=%s&from=qa', 'subModule' => 'patchbuild');
$lang->testcase->menu->patchbuild = array('link' => '补丁版本|patchbuild|patchbuild|objectID=%s&from=qa', 'subModule' => 'patchbuild');
//菜单配置
$lang->report->menu->test    = array('link' => '测试|report|bugcreate', 'alias' => 'bugassign,bugsummary,dailybugstatistics,bugbranchstatistics,bugresponsetimestatistics');

$lang->report->menu->prj     = array('link' => $lang->projectCommon . '|report|projectdeviation', 'alias' => 'storysummary,burnup,storycyclesummary,storytasksummary,tasksummary,taskplansummary');