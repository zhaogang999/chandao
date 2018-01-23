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
<div id='featurebar'>
  <ul class='nav'>
    <?php
    $allClass     = $status=='all'?'active':'';
    $unfixedClass = $status=='unfixed'?'active':'';
    if(common::hasPriv('storyReview', 'storyReview')) echo "<li>" . html::a(inlink('storyReview', "objectID=$objectID&from=$from"),  $lang->storyreview->storyreview) . "</li>";
    if(common::hasPriv('storyReview', 'leftProblem'))echo "<li class=$allClass>"   . html::a(inlink('leftProblem', "objectID=$objectID&from=$from&status=all"), $lang->storyreview->leftProblemAB) . "</li>";
    if(common::hasPriv('storyReview', 'leftProblem'))echo "<li class=$unfixedClass>"   . html::a(inlink('leftProblem', "objectID=$objectID&from=$from&status=unfixed"), $lang->storyreview->unfixed) . "</li>";
    ?>
  </ul>
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
  $vars = "objectID=$objectID&from=$from&status=$status&type=$type&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  ?>
    <tr class='colhead'>
      <th class='w-40px'><?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>
      <th class='w-200px'><?php common::printOrderLink('projectName', $orderBy, $vars, $lang->storyreview->project);?></th>
      <th><?php common::printOrderLink('problemTracking', $orderBy, $vars, $lang->storyreview->problemTracking);?></th>
      <th class='w-user'><?php common::printOrderLink('openedBy', $orderBy, $vars, $lang->storyreview->openedBy);?></th>
      <th class='w-date'><?php common::printOrderLink('reviewDate', $orderBy, $vars, $lang->storyreview->reviewDate);?></th>
      <th class='w-70px'><?php common::printOrderLink('resolution', $orderBy, $vars, $lang->storyreview->resolution);?></th>
      <th class='w-60px'><?php common::printOrderLink('solver', $orderBy, $vars, $lang->storyreview->solver);?></th>
      <th class='w-date'><?php common::printOrderLink('resolvedDate', $orderBy, $vars, $lang->storyreview->resolvedDate);?></th>
      <th class='w-80px'><?php echo $lang->actions;?></th>

    </tr>
  </thead>
  <tbody>
  <?php foreach($storyReviews as $storyReview):?>
  <tr class='text-center'>
    <td><?php echo html::a($this->createLink('storyreview', 'view', "storyReview=$storyReview->id$from=$from"), $storyReview->id);?></td>
    <td><?php echo $storyReview->projectName;?></td>
    <td class='text-left' title='<?php echo $storyReview->problemTracking?>'><?php echo html::a($this->createLink('storyreview', 'view', "storyReview=$storyReview->id&from=$from"), $storyReview->problemTracking);?></td>
    <td><?php echo $users[$storyReview->openedBy]; ?></td>
    <td><?php echo $storyReview->reviewDate; ?></td>
    <td><?php echo $lang->storyreview->resolutionList[$storyReview->resolution]; ?></td>
    <td><?php echo $users[$storyReview->solver]; ?></td>
    <td><?php echo $storyReview->resolvedDate; ?></td>
    <td>
      <?php
      common::printIcon('storyreview', 'resolve', "storyReviewID=$storyReview->id", $storyReview, 'list', '', '', 'iframe', true);
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
  <tfoot><tr><td colspan='9'><?php $pager->show();?></td></tr></tfoot>
</table>
<script language="JavaScript">
  $(function()
  {
    setTimeout(function(){fixedTheadOfList('#storyReviewList')}, 100);
  })
</script>
<?php include '../../common/view/footer.html.php';?>
