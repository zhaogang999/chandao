<?php
$linkHtml = '';
if(common::hasPriv('bug', 'import'))
{
    $linkHtml = html::a($this->createLink('bug', 'import', "productID=$productID&branch=$branch"), '<i class="icon-upload-alt"></i> ' . $lang->bug->import, '', "class='btn import'");
}

$link = common::hasPriv('bug', 'exportTemplet') ? $this->createLink('bug', 'exportTemplet', "productID=$productID&branch=$branch") : '#';
$misc = common::hasPriv('bug', 'exportTemplet') ? "class='exportTemplet'" : "class='disabled'";
$exportHtml = "<li>" . html::a($link, $lang->bug->exportTemplet, '', $misc) . '</li>';
?>
<script language='Javascript'>
$(function(){
    $('#featurebar .actions').prepend(<?php echo json_encode($linkHtml)?>);
    $('#exportActionMenu').append(<?php echo json_encode($exportHtml)?>);
    $(".import").colorbox({width:500, height:200, iframe:true, transition:'none'});
    $(".exportTemplet").colorbox({width:500, height:200, iframe:true, transition:'none'});
})
</script>
