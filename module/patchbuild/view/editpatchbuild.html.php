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
      <span class='prefix'><?php echo html::icon($lang->icons['build']);?> <strong><?php echo $build->id;?></strong></span>
      <strong><?php echo $build->version;?></strong>
      <small class='text-muted'> <?php echo $this->lang->patchbuild->editpatchbuild;?> <?php echo html::icon($lang->icons['edit']);?></small>
    </div>
  </div>
  <form class='form-condensed' method='post' target='hiddenwin' id='dataform' enctype='multipart/form-data'>
    <table class='table table-form'> 
      <tr>
        <th class='w-110px'><?php echo $lang->patchbuild->product;?></th>
        <?php if($products):?>
        <td>
          <div class='input-group'>
            <?php echo html::select('product', $products, $product->id, "onchange='loadBranches(this.value);' class='form-control chosen'");?>
            <?php
            /*if($product->type != 'normal')
            {
                if($product->branch) $branches = array($product->branch => $branches[$product->branch]);
                echo "<span class='input-group-addon fix-padding fix-border'></span>" . html::select('branch', $branches, $product->branch, "class='form-control' style='width:100px; display:inline-block;'");
            }*/
            ?>
          </div>
        </td>
        <td></td>
        <?php else:?>
        <td colspan='2'><?php if(empty($products)) printf($lang->build->noProduct, $this->createLink('project', 'manageproducts', "projectID=$projectID"));?></td>
        <?php endif;?>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->patchType;?></th>
        <td><?php echo html::select('patchType', $lang->patchbuild->patchTypeList, $build->patchType, 'class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->platform;?></th>
        <td><?php echo html::select('platform', $lang->patchbuild->platformList, $build->platform, 'class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->version;?></th>
        <td class='w-p25-f'>
          <?php echo html::input('version', $build->version, "class='form-control' autocomplete='off'");?>
        </td>
      </tr>

      <tr>
        <th><?php echo $lang->patchbuild->reason;?></th>
        <td><?php echo html::select('reason', $lang->patchbuild->reasonList, $build->reason, 'class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->submitter;?></th>
        <td><?php echo html::select('submitter', $users, $build->submitter, 'class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->group;?></th>
        <td><?php echo html::select('group', $lang->patchbuild->groupList, $build->group, 'class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->releasedDate;?></th>
        <td><?php echo html::input('releasedDate', $build->releasedDate, "class='form-control form-date'");?></td>
      </tr>
      <?php if ($from == 'qa'):?>
      <tr>
        <th><?php echo $lang->patchbuild->assignedTo;?></th>
        <td><?php echo html::select('assignedTo', $users, $build->assignedTo, 'class="form-control chosen"');?></td>
      </tr>
      <?php endif; ?>
      <tr>
        <th><?php echo $lang->patchbuild->mailto;?></th>
        <td colspan='2'>
          <div id='mailtoGroup' class='input-group'>
            <?php
            echo html::select('mailto[]', $users, str_replace(' ' , '', $build->mailto), "multiple class='form-control'");
            echo $this->fetch('my', 'buildContactLists');
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->svnPath;?></th>
        <td colspan='2'><?php echo html::input('svnPath', $build->svnPath, "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->patchProgram;?></th>
        <td colspan='2'><?php echo html::input('patchProgram', $build->patchProgram, "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->patchContent;?></th>
        <td colspan='2'><?php echo html::textarea('patchContent', $build->patchContent, "rows='10' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->influence;?></th>
        <td colspan='2'><?php echo html::textarea('influence', $build->influence, "rows='6' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->config;?></th>
        <td colspan='2'><?php echo html::textarea('config', $build->config, "rows='6' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->notice;?></th>
        <td colspan='2'><?php echo html::textarea('notice', $build->notice, "rows='6' class='form-control'");?></td>
      </tr>
      <?php if ($from == 'qa'):?>
      <tr>
        <th><?php echo $lang->patchbuild->testPass?></th>
        <td colspan='2'><?php echo html::select('testPass', $lang->patchbuild->testPassList, $build->testPass, 'class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->patchbuild->testComment?></th>
        <td colspan='2'><?php echo html::textarea('testComment', $build->testComment, "rows='6' class='form-control'");?></td>
      </tr>
        <tr>
          <th><?php echo $lang->patchbuild->testEnv?></th>
          <td colspan='2'><?php echo html::select('testEnv', $lang->patchbuild->testEnvList, $build->testEnv, 'class="form-control chosen"');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->patchbuild->testEnvComment?></th>
          <td colspan='2'><?php echo html::textarea('testEnvComment', $build->testEnvComment, "rows='6' class='form-control'");?></td>
        </tr>
      <?php endif;?>
      <tr><td></td><td colspan='2'><?php echo html::submitButton() . html::backButton();?></td></tr>
    </table>
  </form>
</div>
<?php js::set('productGroups', $productGroups)?>
<?php include '../../common/view/footer.html.php';?>