<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/2/25
 * Time: 10:38
 */
$lang->riskManage = new stdClass();

$lang->riskManage->riskType         = '风险类别';
$lang->riskManage->title            = '活动、事项';
$lang->riskManage->desc             = '风险和机遇描述';
$lang->riskManage->object           = '对应的产品/项目/过程/组织级';
$lang->riskManage->posedDepart      = '提出部门';
$lang->riskManage->riskLife         = '风险存在的时间段';
$lang->riskManage->riskAnalysis     = '风险分析';
$lang->riskManage->influence        = '影响';
$lang->riskManage->probability      = '发送概率';
$lang->riskManage->riskScore        = '风险系数';
$lang->riskManage->pri              = '优先级';
$lang->riskManage->preventiveMeasure= '缓解/预防措施';
$lang->riskManage->emergencyMeasure = '应急措施';
$lang->riskManage->responsibleDepart= '责任部门';
$lang->riskManage->responsiblePerson= '责任人';
$lang->riskManage->remissionCycle   = '缓解/预防措施实施周期';
$lang->riskManage->monitoringTime   = '监控时间';
$lang->riskManage->monitoringResult = '缓解/预防措施的监控结果';
$lang->riskManage->stateTracking    = '状态跟踪';
$lang->riskManage->kpi              = '对应KPI指标(适用时)';

$lang->riskManage->riskTypeList['']                         = '';
$lang->riskManage->riskTypeList['legalRisk']                = '法律法规风险';
$lang->riskManage->riskTypeList['customerRisk']             = '客户风险';
$lang->riskManage->riskTypeList['technicalRisk']            = '技术风险';
$lang->riskManage->riskTypeList['marketRisk']               =  '市场风险';
$lang->riskManage->riskTypeList['personnelRisk']            = '人员风险';
$lang->riskManage->riskTypeList['competitiveRisk']          = '竞争风险';
$lang->riskManage->riskTypeList['socialEnvironmentRisk']    = '社会环境风险(文化、经济、社会等)';
$lang->riskManage->riskTypeList['organizationRisk']         = '组织管理风险';
$lang->riskManage->riskTypeList['environmentalFactor']      = '环境因素(针对ISO14001环境体系)';
$lang->riskManage->riskTypeList['complianceRisk']           = '合规性义务的风险(针对ISO14001环境体系)';
$lang->riskManage->riskTypeList['projectManagementRisk']    = '项目管理风险';
$lang->riskManage->riskTypeList['storyManagementRisk']      = '需求管理风险';
$lang->riskManage->riskTypeList['productDesignRisk']        = '产品设计风险';
$lang->riskManage->riskTypeList['processDesignRisk']        = '过程设计风险';
$lang->riskManage->riskTypeList['toolDevelopmentRisk']      = '工具开发风险';
$lang->riskManage->riskTypeList['outsourcingPurchasingRisk']= '外包采购风险';
$lang->riskManage->riskTypeList['equipmentMaintenanceRisk'] = '设备维护、保养风险';
$lang->riskManage->riskTypeList['dataCollectionRisk']       = '数据采集风险';
$lang->riskManage->riskTypeList['dataEntryRisk']            = '数据录入风险';
$lang->riskManage->riskTypeList['dataConversionRisk']       = '数据转换风险';
$lang->riskManage->riskTypeList['dataManagementRisk']       = '数据管理风险';
$lang->riskManage->riskTypeList['dataCompilationRisk']      = '数据编译风险';
$lang->riskManage->riskTypeList['mapReviewRisk']            = '地图审查风险';
$lang->riskManage->riskTypeList['productDeliveryRisk']      = '产品交付风险';
$lang->riskManage->riskTypeList['qualityManagementRisk']    = '品质管理风险';

$lang->riskManage->influenceList['1'] = '1';
$lang->riskManage->influenceList['2'] = '2';
$lang->riskManage->influenceList['3'] = '3';

$lang->riskManage->probabilityList['1'] = '1';
$lang->riskManage->probabilityList['2'] = '2';
$lang->riskManage->probabilityList['3'] = '3';

$lang->riskManage->priList['H'] = 'H';
$lang->riskManage->priList['M'] = 'M';
$lang->riskManage->priList['L'] = 'L';

$lang->riskManage->monitoringResultList['normal']     = '正常';
$lang->riskManage->monitoringResultList['delay']      = '推迟';
$lang->riskManage->monitoringResultList['unexecuted'] = '未执行';

$lang->riskManage->stateTrackingList['closed']        = '关闭';
$lang->riskManage->stateTrackingList['becomeProblem'] = '变成问题';
$lang->riskManage->stateTrackingList['implementing']  = '正在执行缓解/预防措施';
$lang->riskManage->stateTrackingList['notOccurring']  = '未发生';
$lang->riskManage->stateTrackingList['acceptable']    = '可接受';
