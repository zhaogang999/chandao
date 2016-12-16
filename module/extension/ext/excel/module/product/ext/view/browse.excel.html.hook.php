<?php
$linkHtml = '';
if(common::hasPriv('story', 'import')) $linkHtml = html::a($this->createLink('story', 'import', "productID=$productID&branch=$branch"), '<i class="icon-upload-alt"></i> ' . $lang->story->import, '', "class='btn import'");

$link = common::hasPriv('story', 'exportTemplet') ? $this->createLink('story', 'exportTemplet', "productID=$productID&branch=$branch") : '#';
$misc = common::hasPriv('story', 'exportTemplet') ? "class='exportTemplet'" : "class='disabled'";
$exportHtml = "<li>" . html::a($link, $lang->story->exportTemplet, '', $misc) . '</li>';
?>
<script language='Javascript'>
$(function(){
    $('#featurebar .actions').prepend(<?php echo json_encode($linkHtml)?>);
    $('#exportActionMenu').append(<?php echo json_encode($exportHtml)?>);
    $(".import").colorbox({width:500, height:200, iframe:true, transition:'none'});
    $(".exportTemplet").colorbox({width:500, height:200, iframe:true, transition:'none'});
})
</script>
