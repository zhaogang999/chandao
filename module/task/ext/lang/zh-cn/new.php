<?php
//禅道任务增加关键字字段；需求：858
$lang->task->keywords = '关键字';
$lang->task->plan     = '所属计划';

$lang->task->error->doneError = '『实际开始』不能为空';
$lang->task->error->reviewError = '『评审』类型的任务不能批量完成';
//$lang->task->error->undoingError = '请先开始/继续任务或通过编辑填写任务『实际开始』时间，再点击关闭';
//测试类型的任务增加文字模板
$lang->task->testTaskComment = "<p>[测试用例成果]</p><p>[测试执行通过率]</p><p>[未测试范围]</p>";
//1754 增加开发任务关闭成果展示内容 
$lang->task->develTaskComment = "<p>[开发任务成果]</p><p>[开发任务达成率]</p><p>[未开发内容]</p>";