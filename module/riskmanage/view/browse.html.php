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
<?php js::set('confirmDelete', $lang->riskmanage->confirmDelete)?>
<div id='featurebar'>
  <ul class='nav'>
    <?php
    $allClass     = $status=='all'?'active':'';
    $unclosedClass = $status=='unclosed'?'active':'';
    //var_dump($status == 'unclosed');die;
    if(common::hasPriv('riskmanage', 'browse')) echo "<li class=$unclosedClass>" . html::a(inlink('browse'),  $lang->riskmanage->undone) . "</li>";
    echo "<li class=$allClass>"   . html::a(inlink('browse', "status=all"), $lang->riskmanage->all) . "</li>";
    ?>
  </ul>
  <div class='actions'>
    <?php common::printIcon('riskmanage', 'create');?>
  </div>
  <div id='querybox' class='show'></div>
</div>
<form method='post' id='riskManageForm'>
  <table class='table tablesorter table-fixed table-selectable' id='riskManageList'>
    <thead>
    <?php
    $vars = "type=$type&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
    ?>
      <tr class='colhead'>
        <th class='w-id'><?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>
        <th><?php common::printOrderLink('title', $orderBy, $vars, $lang->riskmanage->title);?></th>
        <th class='w-100px'><?php common::printOrderLink('riskType', $orderBy, $vars, $lang->riskmanage->riskType);?></th>
        <th class='w-100px'><?php common::printOrderLink('posedDepart', $orderBy, $vars, $lang->riskmanage->posedDepart);?></th>
        <th class='w-100px'><?php common::printOrderLink('object', $orderBy, $vars, $lang->riskmanage->object);?></th>
        <th class='w-100px'><?php common::printOrderLink('riskLife', $orderBy, $vars, $lang->riskmanage->riskLife);?></th>
        <th class='w-50px'><?php common::printOrderLink('influence', $orderBy, $vars, $lang->riskmanage->influence);?></th>
        <th class='w-70px'><?php common::printOrderLink('probability', $orderBy, $vars, $lang->riskmanage->probability);?></th>
        <th class='w-70px'><?php common::printOrderLink('riskScore', $orderBy, $vars, $lang->riskmanage->riskScore);?></th>
        <th class='w-60px'><?php common::printOrderLink('pri', $orderBy, $vars, $lang->riskmanage->pri);?></th>
        <th class='w-100px'><?php common::printOrderLink('responsibleDepart', $orderBy, $vars, $lang->riskmanage->responsibleDepart);?></th>
        <th class='w-user'><?php common::printOrderLink('responsiblePerson', $orderBy, $vars, $lang->riskmanage->responsiblePerson);?></th>
        <th class='w-date'><?php common::printOrderLink('monitoringTime', $orderBy, $vars, $lang->riskmanage->monitoringTime);?></th>
        <th class='w-user'><?php common::printOrderLink('monitoringResult', $orderBy, $vars, $lang->riskmanage->monitoringResult);?></th>
        <th class='w-user'><?php common::printOrderLink('stateTracking', $orderBy, $vars, $lang->riskmanage->stateTracking);?></th>
        <th class='w-user'><?php common::printOrderLink('kpi', $orderBy, $vars, $lang->riskmanage->kpi);?></th>
        <th class='w-80px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <?php $canBatchClose = (common::hasPriv('riskmanage', 'batchClose'));?>
    <tbody>
    <?php foreach($riskManages as $riskManage):?>
    <tr class='text-center'>
      <td class='cell-id'>
      <?php if($canBatchClose):?><input type='checkbox' name='riskManageIDList[<?php echo $riskManage->id;?>]' value='<?php echo $riskManage->id;?>' /><?php endif;?>
        <?php echo html::a($this->createLink('riskmanage', 'view', "riskmanage=$riskManage->id"), $riskManage->id);?>
      </td>
      <td class='text-left' title='<?php echo $riskManage->title?>'><?php echo html::a($this->createLink('riskmanage', 'view', "riskmanage=$riskManage->id"), $riskManage->title);?></td>
      <td><?php echo $lang->riskmanage->riskTypeList[$riskManage->riskType]; ?></td>
      <td><?php echo $riskManage->object; ?></td>
      <td><?php echo $riskManage->posedDepart; ?></td>
      <td><?php echo $riskManage->riskLife; ?></td>
      <td><?php echo $lang->riskmanage->influenceList[$riskManage->influence]; ?></td>
      <td><?php echo $lang->riskmanage->probabilityList[$riskManage->probability]; ?></td>
      <td><?php echo $riskManage->riskScore; ?></td>
      <td><?php echo $lang->riskmanage->priList[$riskManage->pri]; ?></td>
      <td><?php echo $riskManage->responsibleDepart; ?></td>
      <td><?php echo $users[$riskManage->responsiblePerson]; ?></td>
      <td><?php echo $riskManage->monitoringTime; ?></td>
      <td><?php echo $lang->riskmanage->monitoringResultList[$riskManage->monitoringResult]; ?></td>
      <td><?php echo $lang->riskmanage->stateTrackingList[$riskManage->stateTracking]; ?></td>
      <td><?php echo $riskManage->kpi; ?></td>
      <td>
        <?php
        common::printIcon('riskmanage', 'edit',   "riskManageID=$riskManage->id", '','list', 'pencil', '', '', false, '', $lang->riskmanage->edit);
        common::printIcon('riskmanage', 'close', "riskManageID=$riskManage->id", $riskManage, 'list', '', 'hiddenwin');
        if(common::hasPriv('riskmanage', 'delete'))
        {
          $deleteURL = $this->createLink('riskmanage', 'delete', "riskmanage=$riskManage->id&confirm=yes");
          echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"riskmanageList\",confirmDelete)", '<i class="icon-remove"></i>', '', "class='btn-icon' title='{$lang->riskmanage->delete}'");
        }
        ?>
      </td>
    </tr>
    <?php endforeach;?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan='17'>
          <div class='table-actions clearfix'>
            <?php
            if($canBatchClose) echo html::selectButton();
            if($canBatchClose)
            {
              $actionLink = $this->createLink('riskmanage', 'batchClose');
              echo html::commonButton($lang->close, "onclick=\"setFormAction('$actionLink','hiddenwin')\"");
            }
            ?>
          </div>
          <?php $pager->show();?>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
<script language="JavaScript">
  $(function()
  {
    ajaxGetSearchForm();
    setTimeout(function(){fixedTheadOfList('#riskManageList')}, 100);
  })
</script>
<?php include '../../common/view/footer.html.php';?>
