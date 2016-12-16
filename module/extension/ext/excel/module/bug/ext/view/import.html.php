<?php include '../../../common/view/header.lite.html.php';?>
<div id='titlebar'>
  <div class='heading'>
    <strong><?php echo $lang->bug->importCase;?></strong>
  </div>
</div>
<form class='form-condensed' enctype='multipart/form-data' method='post' target='hiddenwin' style='padding: 20px 5% 50px'>
<table class='table table-form'>
  <tr>
    <td class='w-p70'><input type='file' name='file' class='form-control'/></td>
    <td><?php echo html::submitButton();?></td>
  </tr>
</table>
</form>
<?php include '../../../common/view/footer.lite.html.php';?>
