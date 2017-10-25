<?php
/**
 * The build view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     qa
 * @version     $Id: build.html.php 4262 2013-01-24 08:48:56Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('confirmDelete', $lang->patchbuild->confirmDelete)?>
<div id='titlebar'>
  <div class='heading'>
    <?php echo html::icon($lang->icons['build']);?> <?php echo $lang->patchbuild->patchBuild;?>
  </div>
  <?php if ($from == 'project'):?>
  <div class='actions'>
    <?php common::printIcon('patchbuild', 'createPatchBuild', "project=$object->id", "", "button", "plus");?>
  </div>
  <?php endif;?>
  <!--<div id='querybox' class='show'></div>-->
</div>

<table class='table tablesorter table-fixed' id='patchBuildForm'>
  <thead>
  <?php

  $vars = "objectID=$objectID&from=$from&type=$type&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  ?>
    <tr class='colhead'>
      <th class='w-id'><?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>
      <th class='w-id'><?php common::printOrderLink('workSeason', $orderBy, $vars, $lang->patchbuild->workSeason);?></th>
      <th class='w-id'><?php common::printOrderLink('patchType', $orderBy, $vars, $lang->patchbuild->patchType);?></th>
      <th class='w-id'><?php common::printOrderLink('platform', $orderBy, $vars, $lang->patchbuild->platform);?></th>
      <th class='w-200px'><?php common::printOrderLink('version', $orderBy, $vars, $lang->patchbuild->version);?></th>
      <th class='w-id'><?php common::printOrderLink('reason', $orderBy, $vars, $lang->patchbuild->reason);?></th>
      <th class='w-user'><?php common::printOrderLink('submitter', $orderBy, $vars, $lang->patchbuild->submitter);?></th>
      <th class='w-id'><?php common::printOrderLink('group', $orderBy, $vars, $lang->patchbuild->group);?></th>
      <th class='w-date'><?php common::printOrderLink('releasedDate', $orderBy, $vars, $lang->patchbuild->releasedDate);?></th>
      <th class='w-date'><?php common::printOrderLink('patchDate', $orderBy, $vars, $lang->patchbuild->patchDate);?></th>
      <?php if ($from == 'qa'):?>
      <th class='w-user'><?php common::printOrderLink('assignedTo', $orderBy, $vars, $lang->patchbuild->assignedTo);?></th>
      <th class='w-id'><?php common::printOrderLink('testPass', $orderBy, $vars, $lang->patchbuild->testPass);?></th>
      <th class='w-id'><?php common::printOrderLink('testEnv', $orderBy, $vars, $lang->patchbuild->testEnv);?></th>
      <?php endif;?>
      <th class='w-80px'><?php echo $lang->actions;?></th>

    </tr>
  </thead>
  <tbody>
  <?php foreach($patchBuilds as $build):?>
  <tr class='text-center'>
    <td><?php echo $build->id;?></td>
    <td><?php echo $lang->patchbuild->workSeasonList[$build->workSeason]; ?></td>
    <td><?php echo $lang->patchbuild->patchTypeList[$build->patchType]; ?></td>
    <td><?php echo $lang->patchbuild->platformList[$build->platform]; ?></td>
    <td class='text-left' title='<?php echo $build->version?>'><?php echo html::a($this->createLink('patchbuild', 'view', "build=$build->id&from=$from"), $build->version);?></td>
    <td><?php echo $lang->patchbuild->reasonList[$build->reason]; ?></td>
    <td><?php echo $users[$build->submitter]?></td>
    <td><?php echo $lang->patchbuild->groupList[$build->group]; ?></td>
    <td><?php echo $build->releasedDate?></td>
    <td><?php echo $build->patchDate?></td>
    <?php if ($from == 'qa'):?>
    <td><?php echo $users[$build->assignedTo]?></td>
    <td title='<?php echo strip_tags($build->testComment);?>'><?php echo $lang->patchbuild->testPassList[$build->testPass]; ?></td>
    <td title='<?php echo strip_tags($build->testEnvComment)?>'><?php echo $lang->patchbuild->testEnvList[$build->testEnv]; ?></td>
    <?php endif;?>
    <td>
      <?php
      common::printIcon('patchbuild', 'editPatchBuild',   "buildID=$build->id&objectID=$object->id&type=$from", '','list', 'pencil', '', '', false, '', $lang->patchbuild->editpatchbuild);
      if ($from == 'project')
      {
        if(common::hasPriv('patchbuild', 'deletePatchBuild'))
        {
          $deleteURL = $this->createLink('patchbuild', 'deletePatchBuild', "buildID=$build->id&confirm=yes");
          echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"buildList\",confirmDelete)", '<i class="icon-remove"></i>', '', "class='btn-icon' title='{$lang->patchbuild->deletePatchBuild}'");
        }
      }
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
  <tfoot><tr><td colspan='<?php echo $from == 'qa' ? 14 : 11;?>'><?php $pager->show();?></td></tr></tfoot>
</table>
<script language="JavaScript">
  $(function()
  {
    setTimeout(function(){fixedTheadOfList('#buildList')}, '100');
  })
</script>
<?php include '../../common/view/footer.html.php';?>
