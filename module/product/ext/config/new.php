<?php
//1084 产品需求下增加溯源号及搜索;需求搜索新增追溯号字段
//优化搜索功能；将追溯号放在搜索框的指定位置
$insert_array = array('sourcenote' =>'溯源号');
$first_array = array_splice ($config->product->search['fields'], 0, 4);
$config->product->search['fields'] = array_merge ($first_array, $insert_array, $config->product->search['fields']);

$config->product->search['params']['sourcenote']  = array('operator' => 'include', 'control' => 'input',  'values' => '');

//需求可以指派多个人；搜索条件改为include。
$config->product->search['params']['assignedTo']     = array('operator' => 'include',       'control' => 'select', 'values' => 'users');

//需求增加一个字段“”期望实现时间“，该字段的值采用下拉菜单格式，并且下拉菜单最好能调用产品-计划中的未关闭计划
$insert_array = array('customPlan' =>$lang->story->customPlan);
$first_array = array_splice ($config->product->search['fields'], 0, 10);
$config->product->search['fields'] = array_merge ($first_array, $insert_array, $config->product->search['fields']);
$config->product->search['params']['customPlan']  = array('operator' => '=', 'control' => 'select',  'values' => '');

$insert_array = array('testDate' =>$lang->story->testDate);
$first_array = array_splice ($config->product->search['fields'], 0, 11);
$config->product->search['fields'] = array_merge ($first_array, $insert_array, $config->product->search['fields']);
$config->product->search['params']['testDate']  = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');

$insert_array = array('releasedDate' =>$lang->story->releasedDate);
$first_array = array_splice ($config->product->search['fields'], 0, 12);
$config->product->search['fields'] = array_merge ($first_array, $insert_array, $config->product->search['fields']);
$config->product->search['params']['releasedDate']  = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');

$config->product->search['fields']['reviewed']      = $lang->story->reviewed;
$config->product->search['params']['reviewed']            = array('operator' => '=',       'control' => 'select', 'values' => $lang->story->storyReviewedList);
