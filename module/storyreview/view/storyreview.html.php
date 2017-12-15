<?php
/**
 * The storyReview view of storyReview module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     storyReview
 * @version     20171214
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('confirmDelete', $lang->storyreview->confirmDelete)?>
<div id='titlebar'>
  <div class='heading'>
    <?php echo html::icon($lang->icons['storyreview']);?> <?php echo $lang->storyreview->storyreview;?>
  </div>
  <?php if ($from == 'project'):?>
  <div class='actions'>
    <?php common::printIcon('storyreview', 'create', "project=$object->id", "", "button", "plus");?>
  </div>
  <?php endif;?>
  <!--<div id='querybox' class='show'></div>-->
</div>

<table class='table tablesorter table-fixed' id='storyReviewList'>
  <thead>
  <?php

  $vars = "objectID=$objectID&from=$from&type=$type&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  ?>
    <tr class='colhead'>
      <th class='w-id'><?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>
      <th class='w-150px'><?php common::printOrderLink('title', $orderBy, $vars, $lang->storyreview->title);?></th>
      <th class='w-id'><?php common::printOrderLink('storySource', $orderBy, $vars, $lang->storyreview->storySource);?></th>
      <th class='w-150px'><?php common::printOrderLink('application', $orderBy, $vars, $lang->storyreview->application);?></th>
      <th class='w-100px'><?php common::printOrderLink('storyReviewers', $orderBy, $vars, $lang->storyreview->storyReviewers);?></th>
      <th class='w-100px'><?php common::printOrderLink('devReviewers', $orderBy, $vars, $lang->storyreview->devReviewers);?></th>
      <th class='w-100px'><?php common::printOrderLink('testReviewers', $orderBy, $vars, $lang->storyreview->testReviewers);?></th>
      <th class='w-date'><?php common::printOrderLink('reviewDate', $orderBy, $vars, $lang->storyreview->reviewDate);?></th>
      <th class='w-id'><?php common::printOrderLink('needTest', $orderBy, $vars, $lang->storyreview->needTest);?></th>
      <th class='w-date'><?php common::printOrderLink('testDate', $orderBy, $vars, $lang->storyreview->testDate);?></th>
      <th class='w-date'><?php common::printOrderLink('acceptanceDate', $orderBy, $vars, $lang->storyreview->acceptanceDate);?></th>
      <th class='w-date'><?php common::printOrderLink('releasedDate', $orderBy, $vars, $lang->storyreview->releasedDate);?></th>
      <th class='w-80px'><?php echo $lang->actions;?></th>

    </tr>
  </thead>
  <tbody>
  <?php foreach($storyReviews as $storyReview):?>
  <tr class='text-center'>
    <td><?php echo $storyReview->id;?></td>
    <td class='text-left' title='<?php echo $storyReview->title?>'><?php echo html::a($this->createLink('storyreview', 'view', "storyReview=$storyReview->id&from=$from"), $storyReview->title);?></td>
    <td><?php echo $storyReview->storySource; ?></td>
    <td><?php echo $storyReview->application; ?></td>
    <td>
      <?php
      $storyReviewers = '';
      if (!empty($storyReview->storyReviewers))
      {
        foreach(explode(',', $storyReview->storyReviewers) as $account)
        {
          if(empty($account)) continue;
          $storyReviewers .=  $users[trim($account)] . '&nbsp;';
        }
      }
      echo $storyReviewers;
      ?>
    </td>
    <td>
      <?php
      $devReviewers = '';
      if (!empty($storyReview->devReviewers))
      {
        foreach(explode(',', $storyReview->devReviewers) as $account)
        {
          if(empty($account)) continue;
          $devReviewers .=  $users[trim($account)] . '&nbsp;';
        }
      }
      echo $devReviewers;
      ?>
    </td>
    <td>
      <?php
      $testReviewers = '';
      if (!empty($storyReview->testReviewers))
      {
        foreach(explode(',', $storyReview->testReviewers) as $account)
        {
          if(empty($account)) continue;
          $testReviewers .=  $users[trim($account)] . '&nbsp;';
        }
      }
      echo $testReviewers;
      ?>
    </td>
    <td><?php echo $storyReview->reviewDate; ?></td>
    <td><?php echo $lang->storyreview->needTestList[$storyReview->needTest]; ?></td>
    <td><?php echo $storyReview->testDate; ?></td>
    <td><?php echo $storyReview->acceptanceDate; ?></td>
    <td><?php echo $storyReview->releasedDate; ?></td>
    <td>
      <?php

      common::printIcon('storyreview', 'edit',   "storyReviewID=$storyReview->id&objectID=$objectID&type=$from", '','list', 'pencil', '', '', false, '', $lang->storyreview->edit);
      if ($from == 'project')
      {
        if(common::hasPriv('storyreview', 'delete'))
        {
          $deleteURL = $this->createLink('storyreview', 'delete', "storyReviewID=$storyReview->id&confirm=yes");
          echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"storyReviewList\",confirmDelete)", '<i class="icon-remove"></i>', '', "class='btn-icon' title='{$lang->storyreview->delete}'");
        }
      }
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
  <tfoot><tr><td colspan='13'><?php $pager->show();?></td></tr></tfoot>
</table>
<script language="JavaScript">
  $(function()
  {
    setTimeout(function(){fixedTheadOfList('#storyreviewForm')}, 100);
  })
</script>
<?php include '../../common/view/footer.html.php';?>
