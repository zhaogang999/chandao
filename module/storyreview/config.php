<?php
$config->storyreview = new stdclass();

$config->storyreview->editor   = new stdclass();

$config->storyreview->editor->create   = array('id' => 'comment', 'tools' => 'simpleTools');
$config->storyreview->editor->edit     = array('id' => 'comment', 'tools' => 'simpleTools');

global $lang;
$config->storyreview->search['module']                   = 'storyreview';
$config->storyreview->search['fields']['id']             = $lang->storyreview->id;
$config->storyreview->search['fields']['title']          = $lang->storyreview->title;
//$config->storyreview->search['fields']['reviewStories']  = $lang->storyreview->reviewStories;
$config->storyreview->search['fields']['storyReviewers'] = $lang->storyreview->storyReviewers;
$config->storyreview->search['fields']['devReviewers']   = $lang->storyreview->devReviewers;
$config->storyreview->search['fields']['testReviewers']  = $lang->storyreview->testReviewers;
$config->storyreview->search['fields']['otherReviewers'] = $lang->storyreview->otherReviewers;
$config->storyreview->search['fields']['reviewDate']     = $lang->storyreview->reviewDate;
$config->storyreview->search['fields']['storySource']    = $lang->storyreview->storySource;
$config->storyreview->search['fields']['solvedProblem']  = $lang->storyreview->solvedProblem;
$config->storyreview->search['fields']['users']          = $lang->storyreview->users;
$config->storyreview->search['fields']['application']    = $lang->storyreview->application;
$config->storyreview->search['fields']['frequency']      = $lang->storyreview->frequency;
$config->storyreview->search['fields']['testDate']       = $lang->storyreview->testDate;
$config->storyreview->search['fields']['acceptanceDate'] = $lang->storyreview->acceptanceDate;
$config->storyreview->search['fields']['releasedDate']   = $lang->storyreview->releasedDate;
$config->storyreview->search['fields']['deliverables']   = $lang->storyreview->deliverables;
$config->storyreview->search['fields']['needTest']       = $lang->storyreview->needTest;
$config->storyreview->search['fields']['influence']      = $lang->storyreview->influence;
$config->storyreview->search['fields']['problemTracking']= $lang->storyreview->problemTracking;
$config->storyreview->search['fields']['risk']           = $lang->storyreview->risk;
$config->storyreview->search['fields']['result']         = $lang->storyreview->result;
$config->storyreview->search['fields']['comment']         = $lang->storyreview->comment;

$config->storyreview->search['params']['title']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['storyReviewers']  = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->storyreview->search['params']['devReviewers']    = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->storyreview->search['params']['testReviewers']   = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->storyreview->search['params']['otherReviewers']  = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->storyreview->search['params']['reviewDate']      = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->storyreview->search['params']['storySource']     = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['solvedProblem']   = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['users']           = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['application']     = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['frequency']       = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['testDate']        = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->storyreview->search['params']['acceptanceDate']  = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->storyreview->search['params']['releasedDate']    = array('operator' => '=', 'control' => 'input', 'values' => '',  'class' => 'date');
$config->storyreview->search['params']['needTest']        = array('operator' => '=', 'control' => 'select',  'values' => $lang->storyreview->needTestList);
$config->storyreview->search['params']['influence']       = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['problemTracking'] = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['risk']            = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['comment']         = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->storyreview->search['params']['result']          = array('operator' => 'include', 'control' => 'input',  'values' => '');
