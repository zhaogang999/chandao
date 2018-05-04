<?php
//禅道任务增加关键字字段；需求：858
$lang->task->keywords = '关键字';
$lang->task->testDate = '提测计划';

$lang->task->error->doneError = '『实际开始』不能为空';
$lang->task->error->reviewError = '『评审』类型的任务不能批量完成';
//$lang->task->error->undoingError = '请先开始/继续任务或通过编辑填写任务『实际开始』时间，再点击关闭';
//测试类型的任务增加文字模板
$lang->task->testTaskComment = "<p>[测试用例成果]</p><p>[测试执行通过率]</p><p>[未测试范围]</p>";
//1754 增加开发任务关闭成果展示内容 
$lang->task->develTaskComment = "<p>[开发任务成果]</p><p>[开发任务达成率]</p><p>[未开发内容]</p>";
//9195 需求类型的任务完成后填写生成需求ID
$lang->task->storyTaskComment = "<p>[生成需求ID号]</p>";
$lang->task->error->undoingError = '请先开始任务';

$lang->task->scriptID           = '文档ID';
$lang->task->script             = '脚本文档';
$lang->task->scriptName         = '脚本名称';
$lang->task->scriptType         = '脚本分类';
$lang->task->lob                = '业务线';
$lang->task->frequency          = '使用频率';
$lang->task->configurationFile  = '配置文件';
$lang->task->output             = '输出';
$lang->task->precondition       = '执行前提';
$lang->task->performBody        = '环境依赖';
$lang->task->performMode        = '执行方式';
$lang->task->performSystem      = '执行系统';
$lang->task->scriptPath         = '脚本路径';
$lang->task->releasedDate       = '实际发版';
$lang->task->tester             = '测试者';
$lang->task->AT                 = '测试验收';
$lang->task->released           = '运维发布';
$lang->task->notice             = '注意事项';

$lang->task->typeList['script']  = '脚本';

$lang->task->scriptTypeList['']         = '';
$lang->task->scriptTypeList['init']     = '初始化';
$lang->task->scriptTypeList['dataFlow'] = '数据流';

$lang->task->lobList['']                = '';
$lang->task->lobList['road']            = '道路业务';
$lang->task->lobList['poi']             = 'POI业务';
$lang->task->lobList['incrementUpdate'] = '增量更新';
$lang->task->lobList['dateLine']        = '日线质检';
$lang->task->lobList['monthLine']       = '月线质检';
$lang->task->lobList['multisource']     = '多源';
$lang->task->lobList['doorstep']        = '代理店';
$lang->task->lobList['crowd']           = '众包';
$lang->task->lobList['vectorization']   = '情报矢量化';
$lang->task->lobList['metadata']        = '元数据';
$lang->task->lobList['pretreatment']    = '内业预处理';
$lang->task->lobList['ChargingPile']    = '充电桩';
$lang->task->lobList['other']           = '其他';

$lang->task->performModeList['']        = '';
$lang->task->performModeList['sh']      = '.sh';
$lang->task->performModeList['sql']     = '.sql';
$lang->task->performModeList['other']   = '其他';

$lang->task->performSystemList['']        = '';
$lang->task->performSystemList['windows'] = 'windows';
$lang->task->performSystemList['linux']   = 'linux';

$lang->task->ATList['']                 = '';
$lang->task->ATList['pass']             = '通过';
$lang->task->ATList['noPass']           = '不通过';
$lang->task->ATList['partPass']         = '部分通过';
$lang->task->ATList['withoutApproval']  = '免验收';

$lang->task->releasedList['']            = '';
$lang->task->releasedList['release']    = '已发布';
$lang->task->releasedList['noRelease']  = '未发布';
$lang->task->releasedList['partRelease'] = '部分发布';

$lang->task->error->scriptNameEmpty         = '脚本名称不能为空';
$lang->task->error->scriptTypeEmpty         = '脚本分类不能为空';
$lang->task->error->lobEmpty                = '业务线不能为空';
$lang->task->error->frequencyEmpty          = '使用频率不能为空';
$lang->task->error->configurationFileEmpty  = '配置文件不能为空';
$lang->task->error->outputEmpty             = '输出不能为空';
$lang->task->error->preconditionDocEmpty    = '执行前提不能为空';
$lang->task->error->performBodyEmpty        = '执行环节不能为空';
$lang->task->error->performModeEmpty        = '执行方式不能为空';
$lang->task->error->performSystemEmpty      = '执行系统不能为空';
$lang->task->error->scriptPathEmpty         = '脚本路径不能为空';

$lang->task->batchEditDate = '批量修改截止时间';
