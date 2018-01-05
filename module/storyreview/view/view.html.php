<?php
/**
 * The view file of storyReview module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     storyReview
 * @version     20171214
 */
?>
<?php include '../../common/view/header.html.php';?>

<?php if(isonlybody()):?>
<style>
tbody tr td:last-child a{display:none;}
tbody tr td:first-child input{display:none;}
tfoot tr td .table-actions .btn{display:none;}
#titlebar .actions{display:none}
.row-table .col-side{display:none;}
</style>
<?php endif;?>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['storyReview']);?> <strong><?php echo $storyReview->id;?></strong></span>
    <strong><?php echo $storyReview->title;?></strong>
    <?php if($storyReview->deleted):?>
    <span class='label label-danger'><?php echo $lang->storyReview->deleted;?></span>
    <?php endif; ?>
  </div>
  <div class='actions'>
  <?php
  $browseLink = $this->session->storyreviewList ? $this->session->storyreviewList : $this->createLink('storyreview', 'storyreview', "objectID=$objectID&from=$from");
  if(!$storyReview->deleted)
  {
      echo "<div class='btn-group'>";
      common::printIcon('storyreview', 'edit',   "storyReviewID=$storyReview->id&objectID=$objectID&from=$from", '','list', 'pencil', '', '', false, '', $lang->storyreview->edit);
      echo '</div>';

      if ($from == 'project')
      {
        echo "<div class='btn-group'>";

        if(common::hasPriv('storyreview', 'delete'))
        {
          common::printIcon('storyreview', 'delete', "storyReviewID=$storyReview->id", '', 'list', 'remove', 'hiddenwin');
        }

        echo '</div>';
      }
  }
  echo common::printRPN($browseLink);
  ?>
  </div>
</div>
<div class='row-table'>
  <div class='col-main'>
    <div class='main'>
      <div class='tabs'>
        <fieldset>
          <legend><?php echo $lang->storyreview->solvedProblem;?></legend>
          <div class='article-content'><?php echo $storyReview->solvedProblem;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->storyreview->influence;?></legend>
          <div class='article-content'><?php echo $storyReview->influence;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->storyreview->problemTracking;?></legend>
          <div class='article-content'><?php echo $storyReview->problemTracking;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->storyreview->deliverables;?></legend>
          <div class='article-content'><?php echo $storyReview->deliverables;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->storyreview->risk;?></legend>
          <div class='article-content'><?php echo $storyReview->risk;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->storyreview->result;?></legend>
          <div class='article-content'><?php echo $storyReview->result;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->storyreview->comment;?></legend>
          <div class='article-content'><?php echo $storyReview->comment;?></div>
        </fieldset>
        <?php include '../../common/view/action.html.php';?>
      </div>
    </div>
  </div>
  <div class='col-side'>
    <div class='main-side main'>
      <fieldset>
        <legend><?php echo $lang->storyreview->basicInfo;?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->storyreview->product;?></th>
            <td><?php echo $storyReview->productName;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->storyreview->project;?></th>
            <td><?php echo $storyReview->projectName;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->storyreview->storySource;?></th>
            <td><?php echo $storyReview->storySource;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->storyreview->consumed;?></th>
            <td><?php echo $storyReview->consumed . $lang->storyreview->lblHour;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->storyReviewers;?></th>
            <td><?php $storyReviewers = explode(',', str_replace(' ', '', $storyReview->storyReviewers)); foreach($storyReviewers as $account) echo ' ' . zget($users, $account, $account);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->devReviewers;?></th>
            <td><?php $devReviewers = explode(',', str_replace(' ', '', $storyReview->devReviewers)); foreach($devReviewers as $account) echo ' ' . zget($users, $account, $account);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->testReviewers;?></th>
            <td><?php $testReviewers = explode(',', str_replace(' ', '', $storyReview->testReviewers)); foreach($testReviewers as $account) echo ' ' . zget($users, $account, $account);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->otherReviewers;?></th>
            <td><?php $otherReviewers = explode(',', str_replace(' ', '', $storyReview->otherReviewers)); foreach($otherReviewers as $account) echo ' ' . zget($users, $account, $account);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->reviewDate;?></th>
            <td><?php echo $storyReview->reviewDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->teamDev;?></th>
            <td><?php echo $storyReview->teamDev;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->users;?></th>
            <td style='word-break:break-all;'><?php echo $storyReview->users;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->application;?></th>
            <td style='word-break:break-all;'><?php echo $storyReview->application;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->frequency;?></th>
            <td style='word-break:break-all;'><?php echo $storyReview->frequency;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->mailto;?></th>
            <td><?php $mailto = explode(',', str_replace(' ', '', $storyReview->mailto)); foreach($mailto as $account) echo ' ' . zget($users, $account, $account);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->leftProblem;?></th>
            <td><?php echo $lang->storyreview->leftProblemList[$storyReview->leftProblem];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->needTest;?></th>
            <td><?php echo $lang->storyreview->needTestList[$storyReview->needTest];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->testDate;?></th>
            <td><?php echo $storyReview->testDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->acceptanceDate;?></th>
            <td><?php echo $storyReview->acceptanceDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->storyreview->releasedDate;?></th>
            <td><?php echo $storyReview->releasedDate;?></td>
          </tr>
        </table>
      </fieldset>
      <div class='main-side main'>
        <fieldset>
          <legend><?php echo $lang->storyreview->reviewStories;?></legend>
            <ul class='list-unstyled'>
              <?php
              if (!empty($storyReview->reviewStories))
              {
                foreach ($storyReview->reviewStories as $id =>$reviewStory)
                {
                  echo '<li>' . html::a($this->createLink('story', 'view', "storyID=$id"), "#$id " . $reviewStory) . '</li>';
                }
              }
              ?>
            </ul>
        </fieldset>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
