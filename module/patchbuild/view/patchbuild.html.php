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
<?php include '../../common/view/tablesorter.html.php';?>
<?php js::set('confirmDelete', $lang->patchbuild->confirmDelete)?>
<div id='titlebar'>
  <div class='heading'>
    <?php echo html::icon($lang->icons['patchbuild']);?> <?php echo $lang->patchbuild->patchBuild;?>
  </div>
  <?php if ($from == 'project'):?>
  <div class='actions'>
    <?php common::printIcon('patchbuild', 'createPatchBuild', "project=$object->id", "", "button", "plus");?>
  </div>
  <?php endif;?>
</div>

<table class='table tablesorter table-fixed' id='buildList'>
  <thead>
    <tr class='colhead'>
      <th class='w-id'><?php echo $lang->patchbuild->id;?></th>
      <th class='w-id'><?php echo $lang->patchbuild->patchType;?></th>
      <th class='w-id'><?php echo $lang->patchbuild->platform;?></th>
      <th class='w-120px'><?php echo $lang->patchbuild->version;?></th>
      <th class='w-200px'><?php echo $lang->patchbuild->patchContent;?></th>
      <th class='w-id'><?php echo $lang->patchbuild->reason;?></th>
      <th class='w-user'><?php echo $lang->patchbuild->submitter;?></th>
      <th class='w-id'><?php echo $lang->patchbuild->group;?></th>
      <th><?php echo $lang->patchbuild->svnPath;?></th>
      <th><?php echo $lang->patchbuild->patchProgram;?></th>
      <th class='w-date'><?php echo $lang->patchbuild->releasedDate;?></th>
      <th class='w-date'><?php echo $lang->patchbuild->patchDate;?></th>
      <?php if ($from == 'qa'):?>
      <th class='w-id'><?php echo $lang->patchbuild->testPass;?></th>
      <th class='w-id'><?php echo $lang->patchbuild->testEnv;?></th>
      <?php endif;?>
      <th><?php echo $lang->patchbuild->influence;?></th>
      <th><?php echo $lang->patchbuild->config;?></th>
      <th><?php echo $lang->patchbuild->notice;?></th>
      <th class='w-80px'><?php echo $lang->actions;?></th>

    </tr>
  </thead>
  <tbody>
  <?php foreach($patchBuilds as $build):?>
  <tr class='text-center'>
    <td><?php echo $build->id;?></td>
    <td><?php echo $lang->patchbuild->patchTypeList[$build->patchType]; ?></td>
    <td><?php echo $lang->patchbuild->platformList[$build->platform]; ?></td>
    <td class='text-left' title='<?php echo $build->version?>'><?php echo $build->version; ?></td>
    <td class='text-left' title='<?php echo $build->patchContent?>'><?php echo $build->patchContent; ?></td>
    <td><?php echo $lang->patchbuild->reasonList[$build->reason]; ?></td>
    <td><?php echo $users[$build->submitter]?></td>
    <td><?php echo $lang->patchbuild->groupList[$build->group]; ?></td>
    <td class='text-left' title="<?php echo $build->svnPath?>"><?php strpos($build->svnPath,  'http') === 0 ? printf(html::a($build->svnPath))  : printf($build->svnPath);?></td>
    <td class='text-left' title='<?php echo $build->patchProgram?>'><?php echo $build->patchProgram;?></td>
    <td><?php echo $build->releasedDate?></td>
    <td><?php echo $build->patchDate?></td>
    <?php if ($from == 'qa'):?>
    <td><?php echo $build->testPass; ?></td>
    <td><?php echo $build->testEnv; ?></td>
    <?php endif;?>
    <td class='text-left' title='<?php echo $build->influence?>'><?php echo $build->influence;?></td>
    <td class='text-left' title='<?php echo $build->config?>'><?php echo $build->config;?></td>
    <td class='text-left' title='<?php echo $build->notice?>'><?php echo $build->notice;?></td>
    <td>
      <?php
      common::printIcon('patchbuild', 'editPatchBuild',   "buildID=$build->id&objectID=$object->id&type=$from", '','list', 'pencil');
      if ($from == 'project')
      {
        if(common::hasPriv('patchbuild', 'deletePatchBuild'))
        {
          $deleteURL = $this->createLink('patchbuild', 'deletePatchBuild', "buildID=$build->id&confirm=yes");
          echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"buildList\",confirmDelete)", '<i class="icon-remove"></i>', '', "class='btn-icon' title='{$lang->build->delete}'");
        }
      }
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
</table>
<?php include '../../common/view/footer.html.php';?>
