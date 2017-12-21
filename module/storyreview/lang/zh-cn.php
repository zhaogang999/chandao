<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/12/5
 * Time: 16:07
 */
$lang->storyreview = new stdClass();

$lang->storyreview->common      = '需求评审';       //权限登记的当前模块名
$lang->storyreview->create      = '创建需求评审单';
$lang->storyreview->edit        = '编辑需求评审单';
$lang->storyreview->view        = '需求评审单详情';
$lang->storyreview->delete      = '删除需求评审单';
$lang->storyreview->storyreview = '需求评审';
$lang->storyreview->basicInfo   = '基本信息';
$lang->storyreview->product     = '所属产品';
$lang->storyreview->project     = '所属项目';
$lang->storyreview->id          = '评审单号';

$lang->storyreview->title           = '评审内容';
$lang->storyreview->reviewStories   = '评审需求';
$lang->storyreview->storyReviewers  = '需求参评者';
$lang->storyreview->devReviewers    = '开发参评者';
$lang->storyreview->testReviewers   = '测试参评者';
$lang->storyreview->otherReviewers  = '其他参评者';
$lang->storyreview->reviewDate      = '评审日期';
$lang->storyreview->storySource     = '需求来源';
$lang->storyreview->solvedProblem   = '解决问题';
$lang->storyreview->users           = '使用用户';
$lang->storyreview->application     = '使用环节';
$lang->storyreview->frequency       = '使用频率';
$lang->storyreview->teamDev         = '开发团队';
$lang->storyreview->testDate        = '提测时间';
$lang->storyreview->acceptanceDate  = '验收时间';
$lang->storyreview->releasedDate    = '上线时间';
$lang->storyreview->deliverables    = '成果物';
$lang->storyreview->needTest        = '是否测试';
$lang->storyreview->risk            = '风险';
$lang->storyreview->mailto          = '抄送给';
$lang->storyreview->influence       = '影响范围';
$lang->storyreview->problemTracking = '问题记录';
$lang->storyreview->result          = '评审结论';
$lang->storyreview->progressInfo    = '进度信息';
$lang->storyreview->comment         = '备注';

$lang->storyreview->needTestList['']    = '';
$lang->storyreview->needTestList['1']   = '是';
$lang->storyreview->needTestList['0']   = '否';

$lang->storyreview->confirmDelete       = '您确认删除该条记录吗？';

$lang->storyreview->deliverablesAB  = '例如：1、脚本；2、接口；3、平台功能';
$lang->storyreview->influenceAB     = "主要是影响的功能和范围两方面，可以从耦合关系，数据流，任务流，操作控制等角度考虑。具体解释：" . PHP_EOL . "1、数据耦合：A、B共用一份数据，或数据有一部分重叠。" . PHP_EOL . "2、流程耦合：A、B为流程中前后串联的两个环节。" . PHP_EOL . "3、任务耦合：A、B单独无完成任务，但A+B能完成任务。（无前后顺序）" . PHP_EOL . "4、操作耦合：A向B发送控制指令，或A的状态影响到B。" . PHP_EOL . "例如1、日编要素变更要考虑关联维护是否受影响；2、采集端tips字段变更要考虑tips上传下载及日编显示是否受影响；3、web界面变更要考虑功能应用是否受影响。";
$lang->storyreview->problemTrackingAB = "第一部分：有结论问题。为需求评审过程中提出有结论的问题，记录问题和结论；" . PHP_EOL . "1、对测试有帮助、有启发的问题。" . PHP_EOL . "2、重大注意事项。" . PHP_EOL . "第二部分：无结论问题。为无结论的问题，要记录问题，后续问题结论要做补充（不论是邮件还是QQ的回复方式，都要把结论补充进来）";
$lang->storyreview->commentAB = "第一类：与本需求类似的功能：主要是开发实现方式类似的，评审过程中可以进行确认，并记录。程序开发可作为参考，测试也可作为参考。例如：1、LU和LC。2、电子眼和限高限重。第二类：与本需求有业务联系的功能：可评审后补充。例如：1、点限速和线限速";
$lang->storyreview->notice = "风险样例：1、开发实现难度大；2、提交时间晚；3、影响范围广；4、需求疑问点多，不确定性强；5、有需求项可测试性差，难以验证；";

$lang->storyreview->mail = new stdclass();
$lang->storyreview->mail->create = new stdclass();
$lang->storyreview->mail->edit   = new stdclass();
$lang->storyreview->mail->close  = new stdclass();
$lang->storyreview->mail->create->title = "%s创建了需求评审单 #%s:%s";
$lang->storyreview->mail->edit->title   = "%s编辑了需求评审单 #%s:%s";
$lang->storyreview->mail->close->title  = "%s关闭了需求评审单 #%s:%s";