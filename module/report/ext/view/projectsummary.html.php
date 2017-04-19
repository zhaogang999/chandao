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
  <table class='table table-condensed table-striped table-bordered tablesorter active-disabled' style="word-break:break-all; word-wrap:break-all;">
    <thead>
        <tr class='colhead'>
          <th class='w-id'><?php echo $lang->report->projectID;?></th>
          <th class='w-200px'><?php echo $lang->report->projectName;?></th>
          <th class="w-id"><?php echo $lang->report->storySum;?></th>
          <th class="w-id"><?php echo $lang->report->taskSum;?></th>
          <th class="w-id"><?php echo $lang->report->develTaskSum;?></th>
          <th class="w-id"><?php echo $lang->report->develTaskDoneSum;?></th>
          <th class="w-id"><?php echo $lang->report->testSum;?></th>
          <th class="w-id"><?php echo $lang->report->testDoneSum;?></th>
          <th class="w-id"><?php echo $lang->report->delayedTaskSum;?></th>
          <th><?php echo $lang->report->delayedTask;?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($info as $id  =>$project):?>
      <tr class="a-center">
        <td align="center"><?php echo $id;?></td>
        <td><?php echo $project->projectInfo->name;?></td>
        <td><?php echo $project->storySum;?></td>
        <td><?php echo $project->taskSum;?></td>
        <td><?php echo $project->develTaskSum;?></td>
        <td><?php echo $project->develTaskDoneSum;?></td>
        <td><?php echo $project->testSum;?></td>
        <td><?php echo $project->testDoneSum;?></td>
        <td><?php echo $project->delayedTaskSum;?></td>
        <td><?php echo $project->delayedTasks;?></td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table> 
</div>
<?php include '../../../common/view/footer.html.php';?>
