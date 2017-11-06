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
<?php include '../../../common/view/header.html.php';?>
<?php js::set('confirmDelete', $lang->task->confirmDelete)?>
<div id='titlebar'>
  <div class='heading'>
    <?php echo html::icon($lang->icons['build']);?> <?php echo $lang->task->task;?>
  </div>
  <!--<div id='querybox' class='show'></div>-->
</div>

<table class='table tablesorter table-fixed' id='taskForm'>
  <thead>
  <?php

  $vars = "type=$type&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  ?>
    <tr class='colhead'>
      <th class='w-id'><?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>
      <th class='w-150px'><?php common::printOrderLink('scriptName', $orderBy, $vars, $lang->task->scriptName);?></th>
      <th class='w-150px'><?php common::printOrderLink('storyTitle', $orderBy, $vars, $lang->task->story);?></th>
      <th class='w-id'><?php common::printOrderLink('scriptType', $orderBy, $vars, $lang->task->scriptType);?></th>
      <th class='w-id'><?php common::printOrderLink('lob', $orderBy, $vars, $lang->task->lob);?></th>
      <th class='w-id'><?php common::printOrderLink('performMode', $orderBy, $vars, $lang->task->performMode);?></th>
      <th class='w-id'><?php common::printOrderLink('performSystem', $orderBy, $vars, $lang->task->performSystem);?></th>
      <th class='w-id'><?php common::printOrderLink('planTitle', $orderBy, $vars, $lang->report->planTitle);?></th>
      <th class='w-id'><?php common::printOrderLink('releasedDate', $orderBy, $vars, $lang->task->releasedDate);?></th>
      <th class='w-id'><?php common::printOrderLink('openedBy', $orderBy, $vars, $lang->task->openedBy);?></th>
      <th class='w-id'><?php common::printOrderLink('finishedBy', $orderBy, $vars, $lang->task->finishedBy);?></th>
      <th class='w-date'><?php common::printOrderLink('finishedDate', $orderBy, $vars, $lang->task->finishedDate);?></th>
      <th class='w-id'><?php common::printOrderLink('tester', $orderBy, $vars, $lang->task->tester);?></th>
      <th class='w-id'><?php common::printOrderLink('AT', $orderBy, $vars, $lang->task->AT);?></th>
      <th class='w-id'><?php common::printOrderLink('released', $orderBy, $vars, $lang->task->released);?></th>
      <th class='w-60px'><?php echo $lang->actions;?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($scriptTasks as $script):?>
  <tr class='text-center'>
    <td><?php echo $script->id;?></td>
    <td class='text-left' title='<?php echo $script->scriptName;?>'>
      <?php if ($script->scriptName != '') echo html::a($this->createLink('report', 'viewscript', "script=$script->id"), $script->scriptName);?>
    </td>
    <td class='text-left' title='<?php echo $script->storyTitle;?>'>
      <?php if ($script->storyTitle != '') echo html::a($this->createLink('story', 'view', "storyID=$script->story"), $script->storyTitle);?>
    </td>
    <td><?php echo $lang->task->scriptTypeList[$script->scriptType]; ?></td>
    <td><?php echo $lang->task->lobList[$script->lob]; ?></td>
    <td><?php echo $lang->task->performModeList[$script->performMode]; ?></td>
    <td><?php echo $lang->task->performSystemList[$script->performSystem]; ?></td>
    <td><?php echo $script->planTitle;?></td>
    <td><?php echo $script->releasedDate;?></td>
    <td><?php echo $users[$script->openedBy];?></td>
    <td><?php echo $users[$script->finishedBy];?></td>
    <td><?php echo substr($script->finishedDate, 0, 10);?></td>
    <td><?php echo $users[$script->tester];?></td>
    <td><?php echo $lang->task->ATList[$script->AT]; ?></td>
    <td><?php echo $lang->task->releasedList[$script->released]; ?></td>
    <td>
      <?php
      if(common::hasPriv('report', 'editscript'))
      {
        common::printIcon('report', 'editscript', "scriptID=$script->id", '', 'list', 'pencil', '', '', false, '', $lang->task->edit);
      }
      ?>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
  <tfoot><tr><td colspan='16'><?php $pager->show();?></td></tr></tfoot>
</table>
<script language="JavaScript">
  $(function()
  {
    setTimeout(function(){fixedTheadOfList('#buildList')}, 100);
  })
</script>
<?php include '../../../common/view/footer.html.php';?>
