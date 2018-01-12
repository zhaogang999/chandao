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
        <th rowspan="3" width="35"><?php echo $lang->report->projectID;?></th>
        <th rowspan="3"><?php echo $lang->report->projectName;?></th>
        <th colspan="2" class="w-55px"><?php echo $lang->report->notReview;?></th>
        <th colspan="8" class="w-55px"><?php echo $lang->report->hasReveiw;?></th>
        <th colspan="2" class="w-55px"><?php echo $lang->report->freeReveiw;?></th>
      </tr>
      <tr>
        <th rowspan="2" class="w-35px"><?php echo $lang->report->notReviewStoryCount;?></th>
        <th rowspan="2" class="w-130px"><?php echo $lang->report->notReviewStoryIDs;?></th>
        <th colspan="3" class="w-55px"><?php echo $lang->report->testSummary;?></th>
        <th colspan="3" class="w-55px"><?php echo $lang->report->releaseSummary;?></th>
        <th colspan="2" class="w-55px"><?php echo $lang->report->zeroTaskStorySummary;?></th>
        <th rowspan="2" class="w-35px"><?php echo $lang->report->freeReviewStoryCount;?></th>
        <th rowspan="2" class="w-110px"><?php echo $lang->report->freeReviewStoryIDs;?></th>
      </tr>
      <tr>
        <th class="w-35px"><?php echo $lang->report->hasTestDateStoryCount;?></th>
        <th class="w-35px"><?php echo $lang->report->noTestDateStoryCount;?></th>
        <th class="w-100px"><?php echo $lang->report->noTestDateStoryIDs;?></th>
        <th class="w-35px"><?php echo $lang->report->hasSpecialPlanStoryCount;?></th>
        <th class="w-35px"><?php echo $lang->report->noSpecialPlanStoryCount;?></th>
        <th class="w-100px"><?php echo $lang->report->noSpecialPlanStoryIDs;?></th>
        <th class="w-100px"><?php echo $lang->report->zeroDevelTaskStories;?></th>
        <th class="w-100px"><?php echo $lang->report->zeroTestTaskStories;?></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($info as $id  =>$project):?>
      <tr class="center">
        <td align="center"><?php echo $id;?></td>
        <td><?php echo $project->name;?></td>
        <td align="center"><?php echo $project->notReviewStoryCount;?></td>
        <td>
          <?php
            foreach ($project->notReviewStories as $storyID)
            {
              if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
            }
          ?>
        </td>
        <td align="center"><?php echo $project->hasTestDateCount;?></td>
        <td align="center"><?php echo $project->noTestDateCount;?></td>
        <td>
          <?php
          foreach ($project->noTestDateStories as $storyID)
          {
            if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
          }
          ?>
        </td>
        <td align="center"><?php echo $project->hasSpecialPlanCount;?></td>
        <td align="center"><?php echo $project->noSpecialPlanCount;?></td>
        <td>
          <?php
          foreach ($project->noSpecialPlanStories as $storyID)
          {
            if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
          }
          ?>
        </td>
        <td align="center">
          <?php if (isset($project->zeroDevelTaskStories))
          {
            foreach ($project->zeroDevelTaskStories as $storyID => $story)
            {
              if(!common::printLink('story', 'view', "story=$storyID&version=$story->version&from=project&param=$id", sprintf('%03d', $storyID))) printf('%03d', $storyID);
            }
          }
          ?>
        </td>
        <td align="center">
          <?php if (isset($project->zeroTestTaskStories))
          {
            foreach ($project->zeroTestTaskStories as $storyID => $story)
            {
              if(!common::printLink('story', 'view', "story=$storyID&version=$story->version&from=project&param=$id", sprintf('%03d', $storyID))) printf('%03d', $storyID);
            }
          }
          ?>
        </td>
        <td align="center"><?php echo $project->freeReviewStoryCount;?></td>
        <td>
          <?php
          foreach ($project->freeReviewStories as $storyID)
          {
            if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
          }
          ?>
        </td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table> 
</div>
<script language="JavaScript">
  $(function()
  {
    setTimeout(function(){fixedTheadOfList('#storyList')}, 100);
  })
</script>
<?php include '../../../common/view/footer.html.php';?>
