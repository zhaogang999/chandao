<?php
$lang->issue->issue              = '流出问题管理';
$lang->issue->issueDesc          = '问题描述';
$lang->issue->platform           = '所属平台';
$lang->issue->discoveryDate      = '发现时间';
$lang->issue->environmentVersion = '环境及版本';
$lang->issue->fromBug            = '来源Bug';
$lang->issue->influence          = '流出影响';
$lang->issue->reason             = '原因分析';
$lang->issue->longTermMeasures   = '长期对策';
$lang->issue->shortTermMeasures  = '短期对策';
$lang->issue->openedBy           = '由谁创建';
$lang->issue->openedTime         = '创建时间';
$lang->issue->mailto             = '抄送给';
$lang->issue->comment            = '备注';
$lang->issue->id                 = '编号';

$lang->issue->confirmDelete  = '确认删除该条流出问题吗？';
$lang->issue->common         = '流出问题管理';
$lang->issue->browse         = '流出问题管理';
$lang->issue->create         = '创建流出问题';
$lang->issue->edit           = '编辑流出问题';
$lang->issue->view           = '流出问题详情';
$lang->issue->delete         = '删除流出问题';

$lang->issue->deleted        = '已删除';
$lang->issue->basicInfo      = '基本信息';

$lang->issue->platformList['']                  = '';
$lang->issue->platformList['pmc']               = '生管平台';
$lang->issue->platformList['collection']        = '采集平台';
$lang->issue->platformList['edition']           = '编辑平台';
$lang->issue->platformList['domesticAid']       = '室内整理工具';
$lang->issue->platformList['pretreatment ']     = '预处理平台';
$lang->issue->platformList['presents']          = '出品平台';
$lang->issue->platformList['metadataEditing']   = '元数据编辑平台';
$lang->issue->platformList['message']           = '情报矢量化平台';
$lang->issue->platformList['crowdsourcing']     = '众包';
$lang->issue->platformList['multisource ']      = '多源';
$lang->issue->platformList['dealership']        = '代理店';
$lang->issue->platformList['tips']              = 'tips转mark';
$lang->issue->platformList['script']            = '脚本';
$lang->issue->platformList['limitLineNumber']   = '限行限号平台';
$lang->issue->platformList['other']             = '其他';

$lang->issue->mail = new stdclass();
$lang->issue->mail->create = new stdclass();
$lang->issue->mail->edit   = new stdclass();
$lang->issue->mail->close  = new stdclass();
$lang->issue->mail->create->title = "%s创建了流出问题 #%s:%s";
$lang->issue->mail->edit->title   = "%s编辑了流出问题 #%s:%s";
$lang->issue->mail->close->title  = "%s关闭了流出问题 #%s:%s";

$lang->issue->action = new stdClass();
$lang->issue->action->toissue = array('main' => '$date, 由 <strong>$actor</strong> Bug转化而来，Bug编号为 <strong>$extra</strong>。');