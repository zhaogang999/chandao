<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
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
  <form method='post'>
    <div class='row' style='margin-bottom:5px;'>
      <div class='col-sm-4'>
        <div class='input-group input-group-sm'>
          <span class='input-group-addon'><?php echo $lang->report->deadline;?></span>
          <div class='datepicker-wrapper datepicker-date'><?php echo html::input('begin', $begin, "class='w-80px form-control' style='padding-right:10px'");?></div>
          <span class='input-group-addon fix-border'><?php echo $lang->report->to;?></span>
          <div class='datepicker-wrapper datepicker-date'><?php echo html::input('end', $end, "class='form-control' style='padding-right:10px'");?></div>
        </div>
      </div>
      <div class='col-sm-1'>
        <div class='input-group'><?php echo html::submitButton($lang->report->query);?></div>
      </div>
    </div>
  </form>
  <table class='table table-condensed table-striped table-bordered table-fixed active-disabled' id="userTaskSummary">
    <thead>
    <tr class='colhead'>
      <th class="w-100px"><?php echo $lang->report->user;?></th>
      <th><?php echo $lang->report->project;?></th>
      <th class="w-100px"><?php echo $lang->report->task;?></th>
      <th class="w-100px"><?php echo $lang->report->taskWaitSum;?></th>
      <th class="w-100px"><?php echo $lang->report->doing;?></th>
      <th class="w-100px"><?php echo $lang->report->taskPauseSum;?></th>
      <th class="w-100px"><?php echo $lang->report->taskDoneSum;?></th>
      <th class="w-100px"><?php echo $lang->report->delay;?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($userTasks as $account => $load):?>
      <?php if(!array_key_exists($account, $users)) continue;?>
      <tr class="a-center">
        <td rowspan="<?php echo count($load['task']);?>"><?php echo $users[$account];?></td>
        <?php $id = 1;?>
        <?php foreach($load['task'] as $project => $info):?>
        <?php if($id != 1) echo '<tr class="a-center">';?>
        <td><?php echo $project;?></td>
        <td class="text-center"><?php echo $info['count'];?></td>
        <td class="text-center"><?php echo $info['wait'];?></td>
        <td class="text-center"><?php echo $info['doing'];?></td>
        <td class="text-center"><?php echo $info['pause'];?></td>
        <td class="text-center"><?php echo $info['done'];?></td>
        <td class="text-center"><?php echo $info['delay'];?></td>
        <?php if($id != 1) echo '</tr>'; $id ++;?>
        <?php endforeach;?>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php include '../../../common/view/footer.html.php';?>
