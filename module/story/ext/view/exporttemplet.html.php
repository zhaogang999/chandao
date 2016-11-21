<?php include '../../../common/view/header.lite.html.php';?>
<script>
function setDownloading()
{
    if($.browser.opera) return true;   // Opera don't support, omit it.

    $.cookie('downloading', 0);
    time = setInterval("closeWindow()", 300);
    return true;
}

function closeWindow()
{
    if($.cookie('downloading') == 1)
    {
        parent.$.closeModal(null, 'this');
        $.cookie('downloading', null);
        clearInterval(time);
    }
}
</script>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['export']);?></span>
    <strong><?php echo $lang->story->exportTemplet;?></strong>
  </div>
</div>
<form class='form-condensed' method='post' target='hiddenwin' onsubmit='setDownloading();' style='padding: 40px 5% 50px'>
<table class='w-p100 table-form'>
  <tr>
    <th class='w-120px'><?php echo $lang->story->num;?></th>
    <td class='w-80px'><?php echo html::input('num', '10', "class='form-control'");?></td>
    <td class='w-100px'><?php echo html::select('fileType', array('xlsx' => 'xlsx', 'xls' => 'xls'), 'xlsx', "class='form-control'");?>
    <td><?php echo html::submitButton();?></td>
  </tr>
</table>
</form>
<?php include '../../../common/view/footer.lite.html.php';?>
