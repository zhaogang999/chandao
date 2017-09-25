<?php
//2061 提bug页面增加一个字段“发现阶段”，该字段需要支持后续搜索
$discoveryPhaseHtml = '<tr><th>' . $lang->bug->discoveryPhase . '</th><td>' . $lang->bug->discoveryPhaseList[$bug->discoveryPhase] . '</td></tr>';
?>
<script language='Javascript'>
$(function(){
    $('#legendBasicInfo table').append(<?php echo json_encode($discoveryPhaseHtml);?>);
})
</script>
