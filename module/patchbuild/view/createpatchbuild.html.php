<?php
/**
 * The create view of build module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     build
 * @version     $Id: create.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div class='container'>
  <div id='titlebar'>
    <div class='heading'>
      <span class='prefix'><?php echo html::icon($lang->icons['build']);?></span>
      <strong><small class='text-muted'><?php echo html::icon($lang->icons['create']);?></small> <?php echo $lang->patchbuild->createPatchBuild;?></strong>
    </div>
  </div>
  <form class='form-condensed' method='post' target='hiddenwin' id='dataform' enctype='multipart/form-data'>
    <table class='table table-form'>
      <tr>
        <th width="70"><?php echo $lang->patchbuild->patchType;?></th>
        <td><?php echo html::select('patchType', $lang->patchbuild->patchTypeList, '', 'class="form-control chosen"');?></td>
        <td width="350">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->patchbuild->workSeason;?></span>
            <?php echo html::select('workSeason', $lang->patchbuild->workSeasonList, '', 'class="form-control chosen"');?>
          </div>
        </td>
        <td width="350">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->patchbuild->platform;?></span>
            <?php echo html::select('platform', $lang->patchbuild->platformList, '', 'class="form-control chosen"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->version;?></th>
        <td><?php echo html::input('version', '', "class='form-control' autocomplete='off'");?></td>
        <td>
          <?php if($lastPatchBuild):?>
            <div class='help-block'> &nbsp; <?php echo $lang->patchbuild->last . ': <strong>' . $lastPatchBuild->version . '</strong>';?></div>
          <?php endif;?>
        </td>
        <td>
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->patchbuild->reason;?></span>
            <?php echo html::select('reason', $lang->patchbuild->reasonList, '', 'class="form-control chosen"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->submitter;?></th>
        <td><?php echo html::select('submitter', $users, $app->user->account, 'class="form-control chosen"');?></td>
        <td>
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->patchbuild->group;?></span>
            <?php echo html::select('group', $lang->patchbuild->groupList, '', 'class="form-control chosen"');?>
          </div>
        </td>
        <td>
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->patchbuild->releasedDate;?></span>
            <?php echo html::input('releasedDate', helper::today(), "class='form-control form-date'");?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->mailto;?></th>
        <td colspan='3'>
          <div id='mailtoGroup' class='input-group'>
            <?php
            echo html::select('mailto[]', $users, '', "multiple class='form-control'");
            echo $this->fetch('my', 'buildContactLists');
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->svnPath;?></th>
        <td colspan='3'><?php echo html::input('svnPath', '', "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->patchProgram;?></th>
        <td colspan='3'><?php echo html::input('patchProgram', '', "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->patchContent;?></th>
        <td colspan='3'><?php echo html::textarea('patchContent', '', "rows='10' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->influence;?></th>
        <td colspan='3'><?php echo html::textarea('influence', '', "rows='6' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->config;?></th>
        <td colspan='3'><?php echo html::textarea('config', '', "rows='6' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->notice;?></th>
        <td colspan='3'><?php echo html::textarea('notice', '', "rows='6' class='form-control'");?></td>
      </tr>
      <tr><td></td><td colspan='3'><?php echo html::submitButton() . html::backButton();?></td></tr>
    </table>
  </form>
</div>
<?php js::set('productGroups', $productGroups)?>
<?php include '../../common/view/footer.html.php';?>
