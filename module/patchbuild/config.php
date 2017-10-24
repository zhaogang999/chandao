<?php
$config->patchbuild = new stdclass();
$config->patchbuild->createpatchbuild   = new stdclass();

$config->patchbuild->editor   = new stdclass();
$config->patchbuild->editor->createpatchbuild = array('id' => 'patchContent,influence,config,notice', 'tools' => 'simpleTools');
$config->patchbuild->editor->editpatchbuild = array('id' => 'patchContent,influence,config,notice,testComment,testEnvComment', 'tools' => 'simpleTools');

//9312 补丁版本下增加各字段的搜索功能
global $lang;
$config->patchbuild->search['module']                   = 'patchbuild';
$config->patchbuild->search['fields']['version']          = $lang->patchbuild->version;
$config->patchbuild->search['fields']['id']          = $lang->patchbuild->id;
$config->patchbuild->search['fields']['patchType']          = $lang->patchbuild->patchType;
$config->patchbuild->search['fields']['platform']          = $lang->patchbuild->platform;
$config->patchbuild->search['fields']['reason']          = $lang->patchbuild->reason;
$config->patchbuild->search['fields']['submitter']          = $lang->patchbuild->submitter;
$config->patchbuild->search['fields']['group']          = $lang->patchbuild->group;
$config->patchbuild->search['fields']['patchDate']          = $lang->patchbuild->patchDate;
$config->patchbuild->search['fields']['releasedDate']          = $lang->patchbuild->releasedDate;
$config->patchbuild->search['fields']['testPass']          = $lang->patchbuild->testPass;
$config->patchbuild->search['fields']['testEnv']          = $lang->patchbuild->testEnv;
$config->patchbuild->search['fields']['assignedTo']          = $lang->patchbuild->assignedTo;

$config->patchbuild->search['params']['version']         = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->patchbuild->search['params']['patchType']      = array('operator' => '=', 'control' => 'select',  'values' => $lang->patchbuild->patchTypeList);
$config->patchbuild->search['params']['platform']         = array('operator' => '=', 'control' => 'select',  'values' => $lang->patchbuild->platformList);
$config->patchbuild->search['params']['submitter']    = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->patchbuild->search['params']['assignedTo']    = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->patchbuild->search['params']['reason']        = array('operator' => '=',       'control' => 'select', 'values' => $lang->patchbuild->reasonList);
$config->patchbuild->search['params']['group']        = array('operator' => '=',       'control' => 'select', 'values' => $lang->patchbuild->groupList);

$config->patchbuild->search['params']['patchDate']  = array('operator' => '=',      'control' => 'input',  'values' => '', 'class' => 'date');
$config->patchbuild->search['params']['releasedDate']  = array('operator' => '=',      'control' => 'input',  'values' => '', 'class' => 'date');
$config->patchbuild->search['params']['testPass']         = array('operator' => '=', 'control' => 'select',  'values' => $lang->patchbuild->testPassList);
$config->patchbuild->search['params']['testEnv']         = array('operator' => '=', 'control' => 'select',  'values' => $lang->patchbuild->testEnvList);
