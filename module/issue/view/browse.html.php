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
<?php js::set('confirmDelete', $lang->issue->confirmDelete)?>
<div id='featurebar'>
  <ul class='nav'>
    <?php
    if(common::hasPriv('issue', 'browse')) echo "<li class='active'>" . html::a(inlink('browse'),  $lang->issue->issue) . "</li>";
    ?>
  </ul>
  <div class='actions'>
    <?php common::printIcon('issue', 'create');?>
  </div>
  <!--<div id='querybox' class='show'></div>-->
</div>

<table class='table tablesorter table-fixed' id='issueList'>
  <thead>
  <?php
  $vars = "type=$type&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  ?>
    <tr class='colhead'>
      <th class='w-id'><?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>
      <th><?php common::printOrderLink('issueDesc', $orderBy, $vars, $lang->issue->issueDesc);?></th>
      <th class='w-100px'><?php common::printOrderLink('platform', $orderBy, $vars, $lang->issue->platform);?></th>
      <th class='w-date'><?php common::printOrderLink('discoveryDate', $orderBy, $vars, $lang->issue->discoveryDate);?></th>
      <th class='w-user'><?php common::printOrderLink('openedBy', $orderBy, $vars, $lang->issue->openedBy);?></th>
      <th class='w-80px'><?php echo $lang->actions;?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($issues as $issue):?>
  <tr class='text-center'>
    <td><?php echo html::a($this->createLink('issue', 'view', "issue=$issue->id"), $issue->id);?></td>
    <td class='text-left' title='<?php echo $issue->issueDesc?>'><?php echo html::a($this->createLink('issue', 'view', "issue=$issue->id"), $issue->issueDesc);?></td>
    <td><?php echo $lang->issue->platformList[$issue->platform]; ?></td>
    <td><?php echo $issue->discoveryDate; ?></td>
    <td><?php echo $issue->openedBy; ?></td>
    <td>
      <?php
      common::printIcon('issue', 'edit',   "storyReviewID=$issue->id", '','list', 'pencil', '', '', false, '', $lang->issue->edit);
      if(common::hasPriv('issue', 'delete'))
      {
        $deleteURL = $this->createLink('issue', 'delete', "issue=$issue->id&confirm=yes");
        echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"issueList\",confirmDelete)", '<i class="icon-remove"></i>', '', "class='btn-icon' title='{$lang->issue->delete}'");
      }
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
  <tfoot><tr><td colspan='6'><?php $pager->show();?></td></tr></tfoot>
</table>
<script language="JavaScript">
  $(function()
  {
    setTimeout(function(){fixedTheadOfList('#issueList')}, 100);
  })
</script>
<?php include '../../common/view/footer.html.php';?>
