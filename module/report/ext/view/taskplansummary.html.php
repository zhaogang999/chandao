<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/tablesorter.html.php';?>
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
            <th class="w-id"><?php echo $lang->report->adjustTaskCount;?></th>
            <th class="w-id"><?php echo $lang->report->delayTaskCount;?></th>
            <th width="240"><?php echo $lang->report->delayTaskIDs;?></th>
            <th class="w-id"><?php echo $lang->report->planTaskCount;?></th>
            <th width="240"><?php echo $lang->report->planTaskIDs;?></th>
            <th width="240"><?php echo $lang->report->noPlanTaskCount;?></th>
            <th width="240"><?php echo $lang->report->noPlanTaskIDs;?></th>
            <th width="240"><?php echo $lang->report->undoneAbnormalPlanTaskIDs;?></th>
            <th width="240"><?php echo $lang->report->doneAbnormalPlanTaskIDs;?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($info as $id  =>$project):?>
      <tr class="a-center">
        <td align="center"><?php echo $id;?></td>
        <td><?php echo $projects[$id];?></td>
        <td align="center"><?php echo isset($project['taskCount'])?$project['taskCount']:0;?></td>
        <td align="center"><?php echo isset($project['delayTaskCount'])?$project['delayTaskCount']:0;?></td>
        <td>
          <!--1086 统计项目内任务截止时间是否有修改，并增加链接直接定位任务  #4-->
          <?php if (isset($project['delayTaskIDs']))
          {
              foreach ($project['delayTaskIDs'] as $taskID => $date)
              {
                  if(!common::printLink('task', 'view', "task=$taskID", sprintf('%03d', $taskID))) printf('%03d', $taskID);
              }
          }
          ?>
        </td>
        <td align="center"><?php echo isset($project['planTaskCount'])?$project['planTaskCount']:0;?></td>
        <td>
          <?php if (isset($project['planTaskIDs']))
          {
              foreach ($project['planTaskIDs'] as $taskID => $date)
              {
                  if(!common::printLink('task', 'view', "task=$taskID", sprintf('%03d', $taskID))) printf('%03d', $taskID);
              }
          }
          ?>
        </td>
        <td align="center"><?php echo isset($project['noPlanTaskCount'])?$project['noPlanTaskCount']:0;?></td>
        <td>
          <?php if (isset($project['noPlanTaskCount']))
          {
              foreach ($project['noPlanTaskIDs'] as $taskID => $date)
              {
                  if(!common::printLink('task', 'view', "task=$taskID", sprintf('%03d', $taskID))) printf('%03d', $taskID);
              }
          }
          ?>
        </td>
        <td>
              <?php if (isset($project['undoneAbnormalPlanTaskIDs']))
              {
                  foreach ($project['undoneAbnormalPlanTaskIDs'] as $taskID => $date)
                  {
                      if(!common::printLink('task', 'view', "task=$taskID", sprintf('%03d', $taskID))) printf('%03d', $taskID);
                  }
              }
              ?>
          </td>
          <td>
              <?php if (isset($project['doneAbnormalPlanTaskIDs']))
              {
                  foreach ($project['doneAbnormalPlanTaskIDs'] as $taskID => $date)
                  {
                      if(!common::printLink('task', 'view', "task=$taskID", sprintf('%03d', $taskID))) printf('%03d', $taskID);
                  }
              }
              ?>
          </td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table> 
</div>
<?php include '../../../common/view/footer.html.php';?>
