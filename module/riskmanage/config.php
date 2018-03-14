<?php
$config->riskmanage = new stdclass();

$config->riskmanage->editor   = new stdclass();

$config->riskmanage->editor->create   = array('id' => 'desc,preventiveMeasure,emergencyMeasure', 'tools' => 'simpleTools');
$config->riskmanage->editor->edit     = array('id' => 'desc,preventiveMeasure,emergencyMeasure', 'tools' => 'simpleTools');

$config->riskmanage->create = new stdClass();
$config->riskmanage->create->requiredFields = 'title,influence,probability';
$config->riskmanage->edit = new stdClass();
$config->riskmanage->edit->requiredFields = 'title,influence,probability';

global $lang;
$config->riskmanage->search['module']                       = 'riskmanage';
$config->riskmanage->search['fields']['title']              = $lang->riskmanage->title;
$config->riskmanage->search['fields']['id']                 = $lang->idAB;
$config->riskmanage->search['fields']['riskType']           = $lang->riskmanage->riskType;
$config->riskmanage->search['fields']['desc']               = $lang->riskmanage->desc;
$config->riskmanage->search['fields']['object']             = $lang->riskmanage->object;
$config->riskmanage->search['fields']['posedDepart']        = $lang->riskmanage->posedDepart;
$config->riskmanage->search['fields']['riskLife']           = $lang->riskmanage->riskLife;
$config->riskmanage->search['fields']['influence']       = $lang->riskmanage->influence;
$config->riskmanage->search['fields']['probability']        = $lang->riskmanage->probability;
$config->riskmanage->search['fields']['riskScore']          = $lang->riskmanage->riskScore;
$config->riskmanage->search['fields']['pri']                = $lang->riskmanage->pri;
$config->riskmanage->search['fields']['preventiveMeasure']  = $lang->riskmanage->preventiveMeasure;
$config->riskmanage->search['fields']['emergencyMeasure']   = $lang->riskmanage->emergencyMeasure;
$config->riskmanage->search['fields']['responsibleDepart']  = $lang->riskmanage->responsibleDepart;
$config->riskmanage->search['fields']['responsiblePerson']  = $lang->riskmanage->responsiblePerson;
$config->riskmanage->search['fields']['remissionCycle']     = $lang->riskmanage->remissionCycle;
$config->riskmanage->search['fields']['monitoringTime']     = $lang->riskmanage->monitoringTime;
$config->riskmanage->search['fields']['monitoringResult']   = $lang->riskmanage->monitoringResult;
$config->riskmanage->search['fields']['stateTracking']      = $lang->riskmanage->stateTracking;
$config->riskmanage->search['fields']['kpi']                = $lang->riskmanage->kpi;

$config->riskmanage->search['params']['title']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['riskType']  = array('operator' => '=', 'control' => 'select', 'values' => $lang->riskmanage->riskTypeList);
$config->riskmanage->search['params']['title']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['desc']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['object']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['posedDepart']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['riskLife']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['influence']     = array('operator' => '=', 'control' => 'select',  'values' => $lang->riskmanage->influenceList);
$config->riskmanage->search['params']['probability']     = array('operator' => '=', 'control' => 'select',  'values' => $lang->riskmanage->probabilityList);
$config->riskmanage->search['params']['riskScore']      = array('operator' => '=', 'control' => 'input', 'values' => '');
$config->riskmanage->search['params']['pri']     = array('operator' => '=', 'control' => 'select',  'values' => $lang->riskmanage->priList);
$config->riskmanage->search['params']['preventiveMeasure']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['emergencyMeasure']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['responsibleDepart']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['responsiblePerson']           = array('operator' => 'include', 'control' => 'input',  'values' => 'users');
$config->riskmanage->search['params']['remissionCycle']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->riskmanage->search['params']['monitoringTime']        = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->riskmanage->search['params']['monitoringResult']     = array('operator' => '=', 'control' => 'select',  'values' => $lang->riskmanage->monitoringResultList);
$config->riskmanage->search['params']['stateTracking']     = array('operator' => '=', 'control' => 'select',  'values' => $lang->riskmanage->stateTrackingList);
$config->riskmanage->search['params']['kpi']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
