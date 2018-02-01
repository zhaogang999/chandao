<?php
$config->issue = new stdclass();

$config->issue->editor   = new stdclass();
$config->issue->editor->create = array('id' => 'reason', 'tools' => 'simpleTools');
$config->issue->editor->edit = array('id' => 'comment, reason', 'tools' => 'simpleTools');

global $lang;
$config->issue->search['module']                       = 'issue';
$config->issue->search['fields']['id']                 = $lang->issue->id;
$config->issue->search['fields']['issueDesc']          = $lang->issue->issueDesc;
$config->issue->search['fields']['platform']           = $lang->issue->platform;
$config->issue->search['fields']['discoveryDate']      = $lang->issue->discoveryDate;
$config->issue->search['fields']['environmentVersion'] = $lang->issue->environmentVersion;
$config->issue->search['fields']['influence']          = $lang->issue->influence;
$config->issue->search['fields']['reason']             = $lang->issue->reason;
$config->issue->search['fields']['shortTermMeasures']  = $lang->issue->shortTermMeasures;
$config->issue->search['fields']['longTermMeasures']   = $lang->issue->longTermMeasures;
$config->issue->search['fields']['openedBy']           = $lang->issue->openedBy;
$config->issue->search['fields']['openedTime']         = $lang->issue->openedTime;

$config->issue->search['params']['issueDesc']          = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->issue->search['params']['platform']           = array('operator' => '=', 'control' => 'select',  'values' => $lang->issue->platformList);
$config->issue->search['params']['discoveryDate']      = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->issue->search['params']['environmentVersion'] = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->issue->search['params']['reason']             = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->issue->search['params']['shortTermMeasures']  = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->issue->search['params']['longTermMeasures']   = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->issue->search['params']['openedBy']           = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->issue->search['params']['openedTime']         = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
