<?php
global $lang, $app;
$app->loadLang('bug');
$config->excel->editor['task']     = array('desc');
$config->excel->editor['story']    = array('spec', 'verify');
$config->excel->editor['bug']      = array('steps');

$config->excel->width          = new stdclass();
$config->excel->width->short   = 16;
$config->excel->width->middle  = 26;
$config->excel->width->long    = 41;

$config->excel->autoWidths   = array('product', 'module', 'project');
$config->excel->shortFields  = array('story','stepDesc', 'stepExpect', 'module', 'product', 'project', 'plan');
$config->excel->titleFields  = array('name', 'title');
$config->excel->centerFields = array('pri', 'type', 'stage', 'os', 'browser', 'severity');

$config->excel->testcase->initField['stepDesc']   = "1. \n2. \n3. ";
$config->excel->testcase->initField['stepExpect'] = "1. \n2. \n3. ";

$config->excel->bug->initField['steps']       = str_replace(array('<p>', '</p>'), array('', "\n"), $lang->bug->tplStep . $lang->bug->tplResult . $lang->bug->tplExpect);
$config->excel->bug->initField['openedBuild'] = 'trunk';

$config->excel->freeze           = new stdclass();
$config->excel->freeze->testcase = 'title';
$config->excel->freeze->bug      = 'title';
$config->excel->freeze->task     = 'name';
$config->excel->freeze->story    = 'title';

$config->excel->dateField  = array('deadline', 'estStarted', 'realStarted');
$config->excel->cellHeight = 20;
