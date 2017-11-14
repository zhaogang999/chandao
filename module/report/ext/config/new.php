<?php
global $lang, $app;
$app->loadLang('task');

$config->report->editor = new stdclass();
$config->report->editor->editscript   = array('id' => 'notice', 'tools' => 'simpleTools');

$config->report->search['module']                   = 'report';
$config->report->search['fields']['scriptName']     = $lang->task->scriptName;
//$config->report->search['fields']['storyTitle']     = $lang->task->story;
//$config->report->search['fields']['finishedDate']     = $lang->task->finishedDate;
$config->report->search['fields']['scriptType']     = $lang->task->scriptType;
$config->report->search['fields']['lob']            = $lang->task->lob;
$config->report->search['fields']['performMode']    = $lang->task->performMode;
$config->report->search['fields']['performSystem']  = $lang->task->performSystem;
$config->report->search['fields']['releasedDate']   = $lang->task->releasedDate;
$config->report->search['fields']['tester']         = $lang->task->tester;
$config->report->search['fields']['AT']             = $lang->task->AT;
$config->report->search['fields']['released']       = $lang->task->released;

$config->report->search['params']['scriptName']     = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->report->search['params']['storyTitle']     = array('operator' => 'include', 'control' => 'input',  'values' => '');
//$config->report->search['params']['finishedDate']  = array('operator' => '=',      'control' => 'input',  'values' => '', 'class' => 'date');
$config->report->search['params']['scriptType']     = array('operator' => '=', 'control' => 'select',  'values' => $lang->task->scriptTypeList);
$config->report->search['params']['lob']            = array('operator' => '=', 'control' => 'select',  'values' => $lang->task->lobList);
$config->report->search['params']['performMode']    = array('operator' => '=', 'control' => 'select',  'values' => $lang->task->performModeList);
$config->report->search['params']['performSystem']  = array('operator' => '=', 'control' => 'select',  'values' => $lang->task->performSystemList);
$config->report->search['params']['releasedDate']   = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->report->search['params']['tester']         = array('operator' => '=', 'control' => 'select', 'values' => 'users');
$config->report->search['params']['AT']             = array('operator' => '=', 'control' => 'select',  'values' => $lang->task->ATList);
$config->report->search['params']['released']       = array('operator' => '=', 'control' => 'select',  'values' => $lang->task->releasedList);
