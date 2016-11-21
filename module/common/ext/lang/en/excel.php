<?php
$lang->exportFileTypeList = array('xlsx' => 'xlsx', 'xls' => 'xls') + $lang->exportFileTypeList;

if(isset($lang->bug->menu->bug['alias']))           $lang->bug->menu->bug['alias'] .= ',showimport';

$lang->excel         = new stdclass();
$lang->excel->noData     = 'Excel is no data';
$lang->excel->canNotRead = 'Can not parse this file';
$lang->excel->insert     = 'New insertion';
