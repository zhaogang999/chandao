<?php
$config->bug->search['params']['module']        = array('operator' => '=',  'control' => 'select', 'values' => 'modules');
$config->bug->search['params']['activatedCount']= array('operator' => '=',      'control' => 'input',  'values' => '');
$config->bug->search['params']['openedBuild']   = array('operator' => '=', 'control' => 'select', 'values' => 'builds');