<?php
$lang->patchbuild->common       = '补丁版本';
$lang->patchbuild->patchBuild   = '补丁版本';
$lang->patchbuild->product      = '所属产品';
$lang->patchbuild->project      = '所属项目';

$lang->patchbuild->basicInfo    = '基本信息';
$lang->patchbuild->view         = '版本详情';

$lang->patchbuild->createPatchBuild = '创建补丁版本';
$lang->patchbuild->editpatchbuild   = '编辑补丁版本';
$lang->patchbuild->deletePatchBuild = '删除补丁版本';
$lang->patchbuild->confirmDelete    = '您确认删除该版本吗？';

$lang->patchbuild->id            =  'ID';
$lang->patchbuild->patchType     = '补丁类型';
$lang->patchbuild->platform      = '所属平台';
$lang->patchbuild->version       = '对应版本';
$lang->patchbuild->last          = '上个版本';
$lang->patchbuild->patchContent  = '补丁内容';
$lang->patchbuild->reason        = '问题原因';
$lang->patchbuild->submitter     = '提交人';
$lang->patchbuild->group         = '所属组';
$lang->patchbuild->svnPath       = '下载地址';
$lang->patchbuild->patchProgram  = '补丁程序';
$lang->patchbuild->patchDate     = '创建日期';
$lang->patchbuild->releasedDate  = '发版日期';
$lang->patchbuild->testPass      = '测试验收';
$lang->patchbuild->testComment   = '验收备注';
$lang->patchbuild->testEnv       = '发布运维';
$lang->patchbuild->testEnvComment = '发布备注';
$lang->patchbuild->notice        = '注意事项';
$lang->patchbuild->config        = '配置要求';
$lang->patchbuild->influence     = '影响范围';
$lang->patchbuild->mailto        = '抄送给';
$lang->patchbuild->assignedTo    = '指派给';
$lang->patchbuild->workSeason    = '目标环境';
$lang->patchbuild->linkStories   = '相关需求';
$lang->patchbuild->linkBugs      = '相关bug';
$lang->patchbuild->linkStoriesAndBugs = '相关需求及bug';

$lang->patchbuild->workSeasonList['']   = '';
$lang->patchbuild->workSeasonList['1']   = '17冬';
$lang->patchbuild->workSeasonList['2']   = '18春';
$lang->patchbuild->workSeasonList['3']   = '17冬+18春';
$lang->patchbuild->workSeasonList['4']   = '18夏';
$lang->patchbuild->workSeasonList['5']   = '18春+18夏';

$lang->patchbuild->patchTypeList['']              = '';
$lang->patchbuild->patchTypeList['alpha']         = '内测';
$lang->patchbuild->patchTypeList['production']    = '生产';

$lang->patchbuild->platformList['']                  = '';
$lang->patchbuild->platformList['pmc']               = '生管平台';
$lang->patchbuild->platformList['collection']        = '采集平台';
$lang->patchbuild->platformList['edition']           = '编辑平台';
$lang->patchbuild->platformList['domesticAid']       = '室内整理工具';
$lang->patchbuild->platformList['pretreatment ']     = '预处理平台';
$lang->patchbuild->platformList['presents']          = '出品平台';
$lang->patchbuild->platformList['metadataEditing']   = '元数据编辑平台';
$lang->patchbuild->platformList['message']           = '情报矢量化平台';
$lang->patchbuild->platformList['crowdsourcing']     = '众包';
$lang->patchbuild->platformList['multisource ']      = '多源';
$lang->patchbuild->platformList['dealership']        = '代理店';
$lang->patchbuild->platformList['tips']              = 'tips转mark';
$lang->patchbuild->platformList['script']            = '脚本';
$lang->patchbuild->platformList['limitLineNumber']   = '限行限号平台';
$lang->patchbuild->platformList['other']             = '其他';

$lang->patchbuild->reasonList['']                = '';
$lang->patchbuild->reasonList['codeError']       = '编码错误';
$lang->patchbuild->reasonList['packageError']    = '打包错误';
$lang->patchbuild->reasonList['optimum']         = '优化改善';
$lang->patchbuild->reasonList['storyChange']     = '需求变更';
$lang->patchbuild->reasonList['other']           = '其他';

$lang->patchbuild->groupList['']          = '';
$lang->patchbuild->groupList['web']       = 'web组';
$lang->patchbuild->groupList['mobile']    = '移动组';
$lang->patchbuild->groupList['fos']       = '服务组';
$lang->patchbuild->groupList['dt']        = '大数据组';
$lang->patchbuild->groupList['presents']  = '出品组';
$lang->patchbuild->groupList['other']     = '其他';

$lang->patchbuild->testPassList['']              = '';
$lang->patchbuild->testPassList['passed']        = '通过';
$lang->patchbuild->testPassList['notPassed']     = '未通过';
$lang->patchbuild->testPassList['partialPassed'] = '部分通过';
$lang->patchbuild->testPassList['withoutApproval'] = '免验收';

$lang->patchbuild->testEnvList['']                = '';
$lang->patchbuild->testEnvList['released']        = '发布';
$lang->patchbuild->testEnvList['notReleased']     = '未发布';
$lang->patchbuild->testEnvList['partialReleased'] = '部分发布';

$lang->patchbuild->mail = new stdclass();
$lang->patchbuild->mail->create = new stdclass();
$lang->patchbuild->mail->edit   = new stdclass();
$lang->patchbuild->mail->close  = new stdclass();
$lang->patchbuild->mail->create->title = "%s创建了补丁版本 #%s:%s";
$lang->patchbuild->mail->edit->title   = "%s编辑了补丁版本 #%s:%s";
$lang->patchbuild->mail->close->title  = "%s关闭了补丁版本 #%s:%s";

//$lang->patchbuild->featureBar['patchbuild']['all']          = $lang->project->allTasks;