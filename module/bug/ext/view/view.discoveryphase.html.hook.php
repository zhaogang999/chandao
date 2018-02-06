<?php
//2061 提bug页面增加一个字段“发现阶段”，该字段需要支持后续搜索
$discoveryPhaseHtml = '<tr><th>' . $lang->bug->discoveryPhase . '</th><td>' . $lang->bug->discoveryPhaseList[$bug->discoveryPhase] . '</td></tr>';
//增加bug转流出问题
$toIssueHtml = '';
 if($bug->toIssue != 0) {
$toIssueHtml = '<tr><th>' . $lang->bug->toIssue .'</th><td>' . html::a($this->createLink('issue', 'view', "storyID=$bug->toIssue"), "#$bug->toIssue", '_blank') . '</td></tr>';
 }
//增加bug转流出问题按钮
$bug2issueHtml = common::buildIconButton('bug', 'toissue', "fromBug=$bug->id", $bug, 'button', 'bug', '', '', false, '', 'bug转流出问题');
?>
<script language='Javascript'>
$(function(){
    $('.actions .btn-group:eq(0)').first().prepend(<?php echo json_encode($bug2issueHtml);?>);
    $('.actions .btn-group:eq(3)').first().prepend(<?php echo json_encode($bug2issueHtml);?>);
    $('#legendMisc tbody').append(<?php echo json_encode($toIssueHtml);?>);
    $('#legendBasicInfo table').append(<?php echo json_encode($discoveryPhaseHtml);?>);
})
</script>
