<?php
//需求可以指派多个人；搜索条件改为include。
$config->product->search['params']['assignedTo']     = array('operator' => 'include',       'control' => 'select', 'values' => 'users');

//需求增加一个字段“”期望实现时间“，该字段的值采用下拉菜单格式，并且下拉菜单最好能调用产品-计划中的未关闭计划
$insert_array = array('customPlan' =>$lang->story->customPlan);
$first_array = array_splice ($config->product->search['fields'], 0, 6);
$config->product->search['fields'] = array_merge ($first_array, $insert_array, $config->product->search['fields']);
$config->product->search['params']['customPlan']  = array('operator' => '=', 'control' => 'select',  'values' => '');

$insert_array = array('testDate' =>$lang->story->testDate);
$first_array = array_splice ($config->product->search['fields'], 0, 11);
$config->product->search['fields'] = array_merge ($first_array, $insert_array, $config->product->search['fields']);
$config->product->search['params']['testDate']  = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');

$insert_array = array('specialPlan' =>$lang->story->specialPlan);
$first_array = array_splice ($config->product->search['fields'], 0, 12);
$config->product->search['fields'] = array_merge ($first_array, $insert_array, $config->product->search['fields']);
$config->product->search['params']['specialPlan']  = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');

$config->product->search['fields']['reviewStatus'] = $lang->story->reviewStatus;
$config->product->search['params']['reviewStatus'] = array('operator' => '=', 'control' => 'select', 'values' => $lang->story->reviewStatusList);

$config->product->search['fields']['ifLinkStories'] = $lang->story->ifLinkStories;
$config->product->search['params']['ifLinkStories'] = array('operator' => '=', 'control' => 'select', 'values' => $lang->story->ifLinkStoriesList);
