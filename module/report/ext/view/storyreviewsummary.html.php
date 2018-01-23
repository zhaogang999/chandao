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
        <th rowspan="2" width="35"><?php echo $lang->report->projectID;?></th>
        <th rowspan="2"><?php echo $lang->report->projectName;?></th>
        <th rowspan="2" width="35"><?php echo $lang->report->storySum;?></th>
        <th colspan="2" class="w-55px"><?php echo $lang->report->notReview;?></th>
        <th colspan="5" class="w-55px"><?php echo $lang->report->hasReveiw;?></th>
        <th colspan="5" class="w-55px"><?php echo $lang->report->freeReveiw;?></th>
      </tr>
      <tr>
        <th class="w-35px"><?php echo $lang->report->notReviewStoryCount;?></th>
        <th class="w-100px"><?php echo $lang->report->notReviewStoryIDs;?></th>
        <th class="w-35px"><?php echo $lang->report->hasReviewStoryCount;?></th>
        <th class="w-90px"><?php echo $lang->report->noTestDateStoryIDs;?></th>
        <th class="w-90px"><?php echo $lang->report->noSpecialPlanStoryIDs;?></th>
        <th class="w-90px"><?php echo $lang->report->zeroDevelTaskStories;?></th>
        <th class="w-90px"><?php echo $lang->report->zeroTestTaskStories;?></th>
        <th class="w-35px"><?php echo $lang->report->freeReviewStoryCount;?></th>
        <th class="w-100px"><?php echo $lang->report->noTestDateStoryIDs;?></th>
        <th class="w-90px"><?php echo $lang->report->noSpecialPlanStoryIDs;?></th>
        <th class="w-90px"><?php echo $lang->report->zeroDevelTaskStories;?></th>
        <th class="w-90px"><?php echo $lang->report->zeroTestTaskStories;?></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($info as $id  =>$project):?>
      <tr class="center">
        <td align="center"><?php echo $id;?></td>
        <td><?php echo $project->name;?></td>
        <td align="center"><?php echo $project->storyCount;?></td>
        <td align="center"><?php echo $project->notReviewStoryCount;?></td>
        <td>
          <?php
            foreach ($project->notReviewStories as $storyID)
            {
              if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
            }
          ?>
        </td>
        <td align="center"><?php echo $project->hasReviewStoryCount;?></td>
        <td>
          <?php
          foreach ($project->noTestDateHasReviewStories as $storyID)
          {
            if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
          }
          ?>
        </td>
        <td>
          <?php
          foreach ($project->noSpecialPlanHasReviewStories as $storyID)
          {
            if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
          }
          ?>
        </td>
        <td>
          <?php if (isset($project->zeroDevelTaskHasReviewStories))
          {
            foreach ($project->zeroDevelTaskHasReviewStories as $storyID => $story)
            {
              if(!common::printLink('story', 'view', "story=$storyID&version=$story->version&from=project&param=$id", sprintf('%03d', $storyID))) printf('%03d', $storyID);
            }
          }
          ?>
        </td>
        <td>
          <?php if (isset($project->zeroTestTaskHasReviewStories))
          {
            foreach ($project->zeroTestTaskHasReviewStories as $storyID => $story)
            {
              if(!common::printLink('story', 'view', "story=$storyID&version=$story->version&from=project&param=$id", sprintf('%03d', $storyID))) printf('%03d', $storyID);
            }
          }
          ?>
        </td>
        <td align="center"><?php echo $project->freeReviewStoryCount;?></td>
        <td>
          <?php
          foreach ($project->noTestDateFreeReviewStories as $storyID)
          {
            if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
          }
          ?>
        </td>
        <td>
          <?php
          foreach ($project->noSpecialPlanFreeReviewStories as $storyID)
          {
            if(!common::printLink('story', 'view', "story=$storyID", sprintf('%03d', $storyID))) printf('%03d', $storyID);
          }
          ?>
        </td>
        <td>
          <?php if (isset($project->zeroDevelTaskFreeReviewStories))
          {
            foreach ($project->zeroDevelTaskFreeReviewStories as $storyID => $story)
            {
              if(!common::printLink('story', 'view', "story=$storyID&version=$story->version&from=project&param=$id", sprintf('%03d', $storyID))) printf('%03d', $storyID);
            }
          }
          ?>
        </td>
        <td>
          <?php if (isset($project->zeroTestTaskFreeReviewStories))
          {
            foreach ($project->zeroTestTaskFreeReviewStories as $storyID => $story)
            {
              if(!common::printLink('story', 'view', "story=$storyID&version=$story->version&from=project&param=$id", sprintf('%03d', $storyID))) printf('%03d', $storyID);
            }
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
