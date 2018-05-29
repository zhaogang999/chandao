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
  <table class='table table-condensed table-striped table-bordered active-disabled' id="storyList" style="word-break:break-all; word-wrap:break-word;">
    <thead>
      <tr class='colhead'>
        <th rowspan="2"><?php echo $lang->report->projectName;?></th>
        <th class="w-100px" rowspan="2"><?php echo $lang->report->testDate;?></th>
        <th class="w-80px" rowspan="2"><?php echo $lang->report->storySum;?></th>
        <th colspan="3"><?php echo $lang->report->stage;?></th>
        <th colspan="3"><?php echo $lang->report->testSummary;?></th>
        <th colspan="3"><?php echo $lang->report->verifySummary;?></th>
      </tr>
      <tr>
        <th class="w-80px"><?php echo $lang->report->storyWaitSum;?></th>
        <th class="w-80px"><?php echo $lang->report->storyDevelopedSum;?></th>
        <th class="w-80px"><?php echo $lang->report->storyTestedSum;?></th>
        <th class="w-80px"><?php echo $lang->report->tested;?></th>
        <th class="w-80px"><?php echo $lang->report->notTest;?></th>
        <th class="w-80px"><?php echo $lang->report->freeTest;?></th>
        <th class="w-80px"><?php echo $lang->report->pass;?></th>
        <th class="w-80px"><?php echo $lang->report->failed;?></th>
        <th class="w-80px" ><?php echo $lang->report->freeVerified;?></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($info as $project):?>
      <?php if ($project->rowspan == 0) continue;?>
      <tr class="a-center">
        <td rowspan="<?php echo $project->rowspan !=0 ? $project->rowspan : 1;?>"><?php echo $project->name;?></td>
        <?php $id = 1;?>
        <?php foreach($project->data as $date => $data):?>
          <?php if($id != 1) echo '<tr class="a-center">';?>
          <td align="center"><?php echo $date;?></td>
          <td align="center"><?php echo $data->storySum;?></td>
          <td align="center"><?php echo $data->stage->wait;?></td>
          <td align="center"><?php echo $data->stage->developed;?></td>
          <td align="center"><?php echo $data->stage->tested;?></td>
          <td align="center"><?php echo $data->testStatus->tested;?></td>
          <td align="center"><?php echo $data->testStatus->notTest;?></td>
          <td align="center"><?php echo $data->testStatus->freeTest;?></td>
          <td align="center"><?php echo $data->verifyStatus->pass;?></td>
          <td align="center"><?php echo $data->verifyStatus->failed;?></td>
          <td align="center"><?php echo $data->verifyStatus->freeVerified;?></td>
          <?php if($id != 1) echo '</tr>'; $id ++;?>
        <?php endforeach;?>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table> 
</div>
<?php include '../../../common/view/footer.html.php';?>
<script language="JavaScript">
  $(function()
  {
    setTimeout(function(){fixedTheadOfList('#storyList')}, '100');
  })
</script>
