<?php
/**
 * The create view of storyReview module of ZenTaoPMS.
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
      <strong><small class='text-muted'><?php echo html::icon($lang->icons['create']);?></small> <?php echo $lang->storyreview->create;?></strong>
    </div>
  </div>
  <form class='form-condensed' method='post' target='hiddenwin' id='dataform' enctype='multipart/form-data'>
    <table class='table table-form'> 
      <tr>
        <th><?php echo $lang->storyreview->title;?></th>
        <td colspan="3"><?php echo html::input('title', '', "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->reviewStories;?></th>
        <td colspan="3"><?php echo html::select('reviewStories[]', $stories, '', 'multiple class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->storySource;?></th>
        <td colspan="2"><?php echo html::input('storySource', '', "class='form-control' autocomplete='off'");?></td>
        <td width="330">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->consumed;?></span>
            <?php echo html::input('consumed', '', "class='form-control' autocomplete='off' placeholder={$lang->storyreview->consumedAB}");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->solvedProblem;?></th>
        <td colspan="3"><?php echo html::textarea('solvedProblem', '', "rows='3' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->storyReviewers;?></th>
        <td><?php echo html::select('storyReviewers[]', $users, '', 'multiple class="form-control chosen"');?></td>
        <td width="330">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->devReviewers;?></span>
            <?php echo html::select('devReviewers[]', $users, '', "multiple class='form-control chosen'");?>
          </div>
        </td>
        <td width="330">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->testReviewers;?></span>
            <?php echo html::select('testReviewers[]', $users, '', "multiple class='form-control chosen'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->otherReviewers;?></th>
        <td><?php echo html::select('otherReviewers[]', $users, '', 'multiple class="form-control chosen"');?></td>
        <td  colspan="2">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->reviewDate;?></span>
            <?php echo html::input('reviewDate', helper::today(), "class='form-control form-date'; style='width:250px';");?>
            <span class='input-group-addon fix-border br-0'><?php echo $lang->storyreview->teamDev;?></span>
            <?php echo html::input('teamDev', '', "class='form-control' autocomplete='off' style='width:270px';");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->users;?></th>
        <td><?php echo html::input('users', '', "class='form-control' autocomplete='off'");?></td>
        <td colspan="2">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->application;?></span>
            <?php echo html::input('application', '', "class='form-control' autocomplete='off'");?>
            <span class='input-group-addon fix-border br-0'><?php echo $lang->storyreview->frequency;?></span>
            <?php echo html::input('frequency', '', "class='form-control' autocomplete='off'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->mailto;?></th>
        <td colspan="3"><?php echo html::select('mailto[]', $users, '', "multiple class='form-control chosen' data-placeholder='{$lang->storyreview->mailtoAB}'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->influence;?></th>
        <td colspan="3"><?php echo html::textarea('influence', '', "rows='6' class='form-control' placeholder='{$lang->storyreview->influenceAB}'");?></td>
      </tr>
      <tr>
        <th width="80"><?php echo $lang->storyreview->leftProblem;?></th>
        <td colspan="3"><?php echo html::select('leftProblem', $lang->storyreview->leftProblemList, '', "class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->problemTracking;?></th>
        <td colspan="3"><?php echo html::textarea('problemTracking', '', "rows='5' class='form-control' placeholder='{$lang->storyreview->problemTrackingAB}'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->risk;?></th>
        <td colspan="3"><?php echo html::textarea('risk', '', "rows='3' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->deliverables;?></th>
        <td><?php echo html::input('deliverables', '', "class='form-control' autocomplete='off' placeholder={$lang->storyreview->deliverablesAB}");?></td>
        <td colspan="2">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->needTest;?></span>
            <?php echo html::select('needTest', $lang->storyreview->needTestList, '', 'class="form-control"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->testDate;?></th>
        <td><?php echo html::input('testDate', '', "class='form-control form-date'");?></td>
        <td colspan="2">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->storyreview->acceptanceDate;?></span>
            <?php echo html::input('acceptanceDate', '', "class='form-control form-date'");?>
            <span class='input-group-addon fix-border br-0'><?php echo $lang->storyreview->releasedDate;?></span>
            <?php echo html::input('releasedDate', '', "class='form-control form-date'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->result;?></th>
        <td colspan="3"><?php echo html::textarea('result', '', "rows='4' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->storyreview->comment;?></th>
        <td colspan="3"><?php echo html::textarea('comment', '', "rows='4' class='form-control' placeholder='{$lang->storyreview->commentAB}'");?></td>
      </tr>
      <tr><td></td>
        <td colspan="3">
          <?php
          $actionLink = $this->createLink('storyreview', 'create', "projectID=$projectID&type=draft");
          echo html::submitButton($lang->storyreview->draft, "onclick=\"setFormAction('$actionLink')\"") . html::submitButton($lang->storyreview->finished) . html::backButton();
          ?>
          <sapn class='alert-danger'><?php echo $lang->storyreview->danger;?></sapn>
        </td></tr>
      <tr><td colspan="4"><div class='alert alert-info'><?php echo $lang->storyreview->notice
            ?></div></td></tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
