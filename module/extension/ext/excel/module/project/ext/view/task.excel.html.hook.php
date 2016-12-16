<?php
$link = common::hasPriv('task', 'exportTemplet') ? $this->createLink('task', 'exportTemplet', "project=$projectID") : '#';
$misc = common::hasPriv('task', 'exportTemplet') ? "class='exportTemplet'" : "class='disabled'";
$exportHtml = "<li>" . html::a($link, $lang->task->exportTemplet, '', $misc) . '</li>';

$link = common::hasPriv('task', 'import') ? $this->createLink('task', 'import', "project=$projectID") : '#';
$misc = common::hasPriv('task', 'import') ? "class='import'" : "class='disabled'";
$importHtml = "<li>" . html::a($link, $lang->task->import, '', $misc) . '</li>';
?>
<script language='Javascript'>
$(function()
{
    $('#exportActionMenu').append(<?php echo json_encode($exportHtml);?>);
    $('#importActionMenu').prepend(<?php echo json_encode($importHtml);?>);
    $(".import").colorbox({width:500, height:200, iframe:true, transition:'none'});
    $(".exportTemplet").colorbox({width:500, height:200, iframe:true, transition:'none'});
})
</script>
