<?php
/**
 * The edit view of storyReview module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     storyReview
 * @version     20171214
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div class='container'>
  <div id='titlebar'>
    <div class='heading'>
      <strong><small class='text-muted'><?php echo html::icon($lang->icons['edit']);?></small> <?php echo $lang->storyreview->edit;?></strong>
    </div>
  </div>
  <form class='form-condensed' method='post' target='hiddenwin' id='dataform' enctype='multipart/form-data'>
    <table class='table table-form'>
      <?php if ($form == 'project'):?>
      <tr>
        <th class='w-80px'><?php echo $lang->storyreview->project;?></th>
        <td colspan="3"><?php echo html::select('project', $projects, $storyReview->project, 'class="form-control chosen"');?></td>
      </tr>
      <?php endif;?>
      <tr>
        <th><?php echo $lang->storyreview->title;?></th>
        <td colspan="3"><?php echo html::input('title', $storyReview->title, "class='form-control' autocomplete='off'");?></td>
      </tr>
      <?php if ($from == 'project'):?>
      <tr>
        <th><?php echo $lang->storyreview->reviewStories;?></th>
        <td colspan="3"><?php

          echo html::select('reviewStories[]', $stories, str_replace(' ' , '', $storyReview->reviewStories), 'multiple class="form-control chosen"');
          ?>
        </td>
      </tr>
      <?php endif;?>
      <tr>
        <th><?php echo $lang->storyreview->storySource;?></th>
        <td colspan="3"><?php echo html::input('storySource', $storyReview->storySource, "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->solvedProblem;?></th>
        <td colspan="3"><?php echo html::textarea('solvedProblem', $storyReview->solvedProblem, "rows='3' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->storyReviewers;?></th>
        <td><?php echo html::select('storyReviewers[]', $users, str_replace(' ' , '', $storyReview->storyReviewers), 'multiple class="form-control chosen"');?></td>
        <td width="330">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->devReviewers;?></span>
            <?php echo html::select('devReviewers[]', $users, str_replace(' ' , '', $storyReview->devReviewers), "multiple class='form-control chosen'");?>
          </div>
        </td>
        <td width="330">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->testReviewers;?></span>
            <?php echo html::select('testReviewers[]', $users, str_replace(' ' , '', $storyReview->testReviewers), "multiple class='form-control chosen'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->otherReviewers;?></th>
        <td><?php echo html::select('otherReviewers[]', $users, str_replace(' ' , '', $storyReview->otherReviewers), 'multiple class="form-control chosen"');?></td>
        <td  colspan="2">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->reviewDate;?></span>
            <?php echo html::input('reviewDate', $storyReview->reviewDate, "class='form-control form-date'; style='width:250px';");?>
            <span class='input-group-addon fix-border br-0'><?php echo $lang->storyreview->teamDev;?></span>
            <?php echo html::select('teamDev[]', $users, str_replace(' ' , '', $storyReview->teamDev), 'multiple class="form-control chosen"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->users;?></th>
        <td><?php echo html::input('users', $storyReview->users, "class='form-control' autocomplete='off'");?></td>
        <td colspan="2">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->application;?></span>
            <?php echo html::input('application', $storyReview->application, "class='form-control' autocomplete='off'");?>
            <span class='input-group-addon fix-border br-0'><?php echo $lang->storyreview->frequency;?></span>
            <?php echo html::input('frequency', $storyReview->frequency, "class='form-control' autocomplete='off'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->mailto;?></th>
        <td colspan="3"><?php echo html::select('mailto[]', $users, str_replace(' ' , '', $storyReview->mailto), 'multiple class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->influence;?></th>
        <td colspan="3"><?php echo html::textarea('influence', $storyReview->influence, "rows='6' class='form-control' placeholder='{$lang->storyreview->influenceAB}'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->problemTracking;?></th>
        <td colspan="3"><?php echo html::textarea('problemTracking', $storyReview->problemTracking, "rows='5' class='form-control' placeholder='{$lang->storyreview->problemTrackingAB}'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->risk;?></th>
        <td colspan="3"><?php echo html::textarea('risk', $storyReview->risk, "rows='3' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->deliverables;?></th>
        <td><?php echo html::input('deliverables', $storyReview->deliverables, "class='form-control' autocomplete='off' placeholder={$lang->storyreview->deliverablesAB}");?></td>
        <td colspan="2">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->needTest;?></span>
            <?php echo html::select('needTest', $lang->storyreview->needTestList, $storyReview->needTest, 'class="form-control"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->testDate;?></th>
        <td><?php echo html::input('testDate', $storyReview->testDate, "class='form-control form-date'");?></td>
        <td colspan="2">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->acceptanceDate;?></span>
            <?php echo html::input('acceptanceDate', $storyReview->acceptanceDate, "class='form-control form-date'");?>
            <span class='input-group-addon fix-border br-0'><?php echo $lang->storyreview->releasedDate;?></span>
            <?php echo html::input('releasedDate', $storyReview->releasedDate, "class='form-control form-date'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->result;?></th>
        <td colspan="3"><?php echo html::textarea('result', $storyReview->result, "rows='4' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->comment;?></th>
        <td colspan="3"><?php echo html::textarea('comment', $storyReview->comment, "rows='4' class='form-control' placeholder='{$lang->storyreview->commentAB}'");?></td>
      </tr>
      <tr><td></td><td colspan="3"><?php echo html::submitButton() . html::backButton();?></td></tr>
      <tr><td colspan="4"><div class='alert alert-info'><?php echo $lang->storyreview->notice?></div></td></tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
