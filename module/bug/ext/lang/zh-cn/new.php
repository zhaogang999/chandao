<?php
/* 模板。*/
$lang->bug->tplReason   = "<p>[问题原因]</p>\n";
$lang->bug->tplProject = "<p>[解决方案]</p>\n";
$lang->bug->tplInfluence = "<p>[影响范围]</p>\n";
$lang->bug->tplExpectedSolutionVersion = "<p>[预计解决版本]</p>";

$lang->bug->tplVerificationResults = "<p>[验证结果]</p>";
$lang->bug->tplVerificationVersion = "<p>[验证版本]</p>";
$lang->bug->tplVerificationContent = "<p>[验证内容]</p>";

//优化搜索功能搜索条件增加空选项
$lang->bug->confirmedList[''] = '';
$lang->bug->severityList[''] = '';

//新增bug截止日期统计
$lang->bug->report->charts['bugsDeadline']              = 'Bug截止日期统计';
$lang->bug->report->bugsDeadline                        = new stdclass();
$lang->bug->report->bugsDeadline->graph                 = new stdclass();
$lang->bug->report->bugsDeadline->type                  = 'bar';
$lang->bug->report->bugsDeadline->graph->xAxisName     = '日期';

//1747 提bug时，限定某些字段为必填项
$lang->bug->severityList[''] = '';

//2061 提bug页面增加一个字段“发现阶段”，该字段需要支持后续搜索
$lang->bug->discoveryPhase = '发现阶段';

$lang->bug->discoveryPhaseList[''] = '';
$lang->bug->discoveryPhaseList['Check-in'] = '提测阶段';
$lang->bug->discoveryPhaseList['alpha'] = '内测阶段';
$lang->bug->discoveryPhaseList['acceptance'] = '验收阶段';
$lang->bug->discoveryPhaseList['production'] = '生产阶段';
