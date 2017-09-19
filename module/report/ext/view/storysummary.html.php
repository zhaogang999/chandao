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

  <table class='table table-condensed table-striped table-bordered tablesorter active-disabled' id="storyList" style="word-break:break-all; word-wrap:break-word;">
    <thead>
        <tr class='colhead'>
          <th width="35"><?php echo $lang->report->projectID;?></th>
          <th width="200"><?php echo $lang->report->projectName;?></th>
          <th class="w-55px"><?php echo $lang->report->storySum;?></th>
          <th class="w-55px"><?php echo $lang->report->storyWaitSum;?></th>
          <th class="w-55px"><?php echo $lang->report->storyDevelopingSum;?></th>
          <th class="w-55px"><?php echo $lang->report->storyDevelopedSum;?></th>
          <th class="w-55px"><?php echo $lang->report->storyTestingSum;?></th>
          <th class="w-55px"><?php echo $lang->report->storyTestedSum;?></th>
          <th class="w-55px"><?php echo $lang->report->storyReleasedSum;?></th>
          <th class="w-55px"><?php echo $lang->report->storyCountBeforProject;?></th>
          <th class="w-55px"><?php echo $lang->report->storyCountOneWeek;?></th>
          <th class="w-55px"><?php echo $lang->report->storyCountTwoWeek;?></th>
          <th class="w-55px"><?php echo $lang->report->storyChangeCount;?></th>
          <th class="w-55px"><?php echo $lang->report->storyChangeRate;?></th>
          <th class="w-100px"><?php echo $lang->report->zeroTaskStoryCount;?></th>
          <th class="w-100px"><?php echo $lang->report->zeroDevelTaskStories;?></th>
          <th class="w-100px"><?php echo $lang->report->zeroTestTaskStories;?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($info as $id  =>$project):?>
      <tr class="a-center">
        <td align="center"><?php echo $id;?></td>
        <td><?php echo $project->projectInfo;?></td>
        <td align="center"><?php echo !empty($project->storySum)?array_sum($project->storySum):0;?></td>
        <td align="center"><?php echo isset($project->storySum['projected'])?$project->storySum['projected']:0;?></td>
        <td align="center"><?php echo isset($project->storySum['developing'])?$project->storySum['developing']:0;?></td>
        <td align="center"><?php echo isset($project->storySum['developed'])?$project->storySum['developed']:0;?></td>
        <td align="center"><?php echo isset($project->storySum['testing'])?$project->storySum['testing']:0;?></td>
        <td align="center"><?php echo isset($project->storySum['tested'])?$project->storySum['tested']:0;?></td>
        <td align="center"><?php echo isset($project->storySum['released'])?$project->storySum['released']:0;?></td>
        <td align="center"><?php echo $project->storyCountByTime['before'];?></td>
        <td align="center"><?php echo $project->storyCountByTime['oneWeek'];?></td>
        <td align="center"><?php echo $project->storyCountByTime['twoWeek'];?></td>
        <td align="center"><?php echo $project->storyChange['count'];?></td>
        <td align="center"><?php echo $project->storyChange['rate'];?></td>
        <td align="center">
          <?php if (isset($project->zeroTaskStories))
          {
            echo count($project->zeroTaskStories) . ' (';
            foreach ($project->zeroTaskStories as $taskID)
            {
              if(!common::printLink('task', 'view', "task=$taskID", sprintf('%03d', $taskID))) printf('%03d', $taskID);
            }
            echo ')';
          }
          ?>
        </td>
        <td align="center">
          <?php if (isset($project->zeroDevelTaskStories))
          {
            foreach ($project->zeroDevelTaskStories as $taskID)
            {
              if(!common::printLink('task', 'view', "task=$taskID", sprintf('%03d', $taskID))) printf('%03d', $taskID);
            }
          }
          ?>
        </td>
        <td align="center">
          <?php if (isset($project->zeroTestTaskStories))
          {
            foreach ($project->zeroTestTaskStories as $taskID)
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
