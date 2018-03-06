<?php
$config->riskManage = new stdclass();

$config->riskManage->editor   = new stdclass();

$config->riskManage->editor->create   = array('id' => 'desc,preventiveMeasure,emergencyMeasure', 'tools' => 'simpleTools');
$config->riskManage->editor->edit     = array('id' => 'desc,preventiveMeasure,emergencyMeasure', 'tools' => 'simpleTools');

global $lang;
$config->riskManage->search['module']                       = 'riskManage';
$config->riskManage->search['fields']['id']                 = $lang->riskManage->id;
$config->riskManage->search['fields']['title']              = $lang->riskManage->title;
$config->riskManage->search['fields']['riskType']           = $lang->riskManage->riskType;
$config->riskManage->search['fields']['desc']               = $lang->riskManage->desc;
$config->riskManage->search['fields']['object']             = $lang->riskManage->object;
$config->riskManage->search['fields']['posedDepart']        = $lang->riskManage->posedDepart;
$config->riskManage->search['fields']['riskLife']           = $lang->riskManage->riskLife;
$config->riskManage->search['fields']['riskAnalysis']       = $lang->riskManage->riskAnalysis;
$config->riskManage->search['fields']['probability']        = $lang->riskManage->probability;
$config->riskManage->search['fields']['riskScore']          = $lang->riskManage->riskScore;
$config->riskManage->search['fields']['pri']                = $lang->riskManage->pri;
$config->riskManage->search['fields']['preventiveMeasure']  = $lang->riskManage->preventiveMeasure;
$config->riskManage->search['fields']['emergencyMeasure']   = $lang->riskManage->emergencyMeasure;
$config->riskManage->search['fields']['responsibleDepart']  = $lang->riskManage->responsibleDepart;
$config->riskManage->search['fields']['responsiblePerson']  = $lang->riskManage->responsiblePerson;
$config->riskManage->search['fields']['remissionCycle']     = $lang->riskManage->remissionCycle;
$config->riskManage->search['fields']['monitoringTime']     = $lang->riskManage->monitoringTime;
$config->riskManage->search['fields']['monitoringResult']   = $lang->riskManage->monitoringResult;
$config->riskManage->search['fields']['stateTracking']      = $lang->riskManage->stateTracking;
$config->riskManage->search['fields']['kpi']                = $lang->riskManage->kpi;

$config->riskManage->search['params']['title']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['riskType']  = array('operator' => '=', 'control' => 'select', 'values' => $lang->riskManage->riskTypeList);
$config->riskManage->search['params']['title']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['testReviewers']   = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->riskManage->search['params']['otherReviewers']  = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->riskManage->search['params']['reviewDate']      = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->riskManage->search['params']['storySource']     = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['solvedProblem']   = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['users']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['application']     = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['frequency']       = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['testDate']        = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->riskManage->search['params']['acceptanceDate']  = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->riskManage->search['params']['releasedDate']    = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->riskManage->search['params']['leftProblem']     = array('operator' => '=', 'control' => 'select',  'values' => $lang->riskManage->leftProblemList);
$config->riskManage->search['params']['needTest']        = array('operator' => '=', 'control' => 'select',  'values' => $lang->riskManage->needTestList);
$config->riskManage->search['params']['influence']       = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['problemTracking'] = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['risk']            = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['comment']         = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskManage->search['params']['result']          = array('operator' => 'include', 'control' => 'input',  'values' => '');
