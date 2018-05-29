<?php include '../../../common/view/header.html.php';?>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['report-file']);?></span>
    <strong> <?php echo $title;?></strong>
  </div>
</div>
<div class='side'>
  <?php include '../../view/blockreportlist.html.php';?>
  <div class='panel panel-body' style='padding: 10px 6px'>
    <div class='text proversion'>
      <strong class='text-danger small text-latin'>PRO</strong> &nbsp;<span class='text-important'><?php echo $lang->report->proVersion;?></span>
    </div>
  </div>
</div>
<div class='main'>
  <table class='table table-condensed table-striped table-bordered tablesorter table-fixed active-disabled' id='bugAssign'>
    <thead>
    <tr class='colhead'>
      <th class="w-100px"><?php echo $lang->report->user;?></th>
      <th><?php echo $lang->report->project;?></th>
      <th class="w-100px"><?php echo $lang->report->bugTotal;?></th>
      <th class="w-100px"><?php echo $lang->bug->statusList['active'];?></th>
      <th class="w-100px"><?php echo $lang->bug->statusList['resolved'];?></th>
      <th class="w-100px"><?php echo $lang->bug->priList['4'];?></th>
      <th class="w-100px"><?php echo $lang->bug->priList['1'];?></th>
      <th class="w-100px"><?php echo $lang->bug->priList['2'];?></th>
      <th class="w-100px"><?php echo $lang->bug->priList['3'];?></th>
    </tr>
    </thead>
    <tbody>
      <?php foreach($assigns as $account => $assign):?>
        <?php if(!array_key_exists($account, $users)) continue;?>
        <tr class="a-center">
          <td rowspan="<?php echo count($assign['bug']);?>"><?php echo $users[$account];?></td>
          <?php $id = 1;?>
          <?php foreach($assign['bug'] as $project => $count):?>
          <?php if($id != 1) echo '<tr class="a-center">';?>
          <td><?php echo $project;?></td>
          <td class="text-center"><?php echo $count['count'];?></td>
          <td class="text-center"><?php echo $count['active'];?></td>
          <td class="text-center"><?php echo $count['resolved'];?></td>
          <td class="text-center"><?php echo $count['pri4'];?></td>
          <td class="text-center"><?php echo $count['pri1'];?></td>
          <td class="text-center"><?php echo $count['pri2'];?></td>
          <td class="text-center"><?php echo $count['pri3'];?></td>
          <?php if($id != 1) echo '</tr>'; $id ++;?>
          <?php endforeach;?>
        </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php include '../../../common/view/footer.html.php';?>
<script language="JavaScript">
  $(document).ready(function()
  {
    setTimeout(function(){fixedTheadOfList('#bugAssign')}, 100);
  });
</script>
