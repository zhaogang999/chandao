<?php
/**
 * The create view of issue module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     issue
 * @version     20171214
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div class='container'>
  <div id='titlebar'>
    <div class='heading'>
      <strong><small class='text-muted'><?php echo html::icon($lang->icons['edit']);?></small> <?php echo $lang->issue->edit;?></strong>
    </div>
  </div>
  <form class='form-condensed' method='post' target='hiddenwin' id='dataform' enctype='multipart/form-data'>
    <table class='table table-form'> 
      <tr>
        <th width="80"><?php echo $lang->issue->issueDesc;?></th>
        <td colspan="2"><?php echo html::textarea('issueDesc', $issue->issueDesc, "class='form-control' rows='3'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->fromBug;?></th>
        <td colspan="2"><?php echo html::select('fromBug', $bugs, $issue->fromBug, 'class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->platform;?></th>
        <td><?php echo html::select('platform', $lang->issue->platformList, $issue->platform, 'class="form-control chosen"');?></td>
        <td width="500">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->issue->discoveryDate;?></span>
            <?php echo html::input('discoveryDate', $issue->discoveryDate, 'class="form-control form-date"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->environmentVersion;?></th>
        <td colspan="2"><?php echo html::textarea('environmentVersion', $issue->environmentVersion, "class='form-control' rows='3'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->influence;?></th>
        <td colspan="2"><?php echo html::textarea('influence', $issue->influence, "class='form-control' rows='3'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->reason;?></th>
        <td colspan="2"><?php echo html::textarea('reason', $issue->reason, "class='form-control' rows='4'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->shortTermMeasures;?></th>
        <td colspan="2"><?php echo html::textarea('shortTermMeasures', $issue->shortTermMeasures, "class='form-control' rows='3'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->longTermMeasures;?></th>
        <td colspan="2"><?php echo html::textarea('longTermMeasures', $issue->longTermMeasures, "class='form-control' rows='3'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->mailto;?></th>
        <td colspan="2"><?php echo html::select('mailto[]', $users, $issue->mailto, "multiple class='form-control chosen'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->issue->comment;?></th>
        <td colspan="2"><?php echo html::textarea('comment', $issue->comment, "class='form-control' rows='3'");?></td>
      </tr>
      <tr><td></td>
        <td colspan="2">
          <?php echo html::submitButton() . html::backButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
