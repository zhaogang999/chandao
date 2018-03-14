<?php
/**
 * The create view of riskManage module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     riskmanage
 * @version     20171214
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div class='container'>
  <div id='titlebar'>
    <div class='heading'>
      <strong><small class='text-muted'><?php echo html::icon($lang->icons['create']);?></small> <?php echo $lang->riskmanage->create;?></strong>
    </div>
  </div>
  <form class='form-condensed' method='post' target='hiddenwin' id='dataform' enctype='multipart/form-data'>
    <table class='table table-form'>
      <tr>
        <th width="80"><?php echo $lang->riskmanage->riskType;?></th>
        <td colspan="2"><?php echo html::select('riskType', $lang->riskmanage->riskTypeList, '', 'class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->title;?></th>
        <td colspan="2"><?php echo html::input('title', '', 'class="form-control"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->desc;?></th>
        <td colspan="2"><?php echo html::textarea('desc', '', "class='form-control' rows='3'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->object;?></th>
        <td><?php echo html::input('object', '', 'class="form-control"');?></td>
        <td width="500">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->riskmanage->posedDepart;?></span>
            <?php echo html::input('posedDepart', '', 'class="form-control"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->riskLife;?></th>
        <td colspan="2"><?php echo html::input('riskLife', '', 'class="form-control"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->influence;?></th>
        <td><?php echo html::select('influence', $lang->riskmanage->influenceList, '', 'class="form-control chosen"');?></td>
        <td width="500">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->riskmanage->probability;?></span>
            <?php echo html::select('probability', $lang->riskmanage->probabilityList, '', 'class="form-control chosen"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->preventiveMeasure;?></th>
        <td colspan="2"><?php echo html::textarea('preventiveMeasure', '', "class='form-control' rows='3'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->emergencyMeasure;?></th>
        <td colspan="2"><?php echo html::textarea('emergencyMeasure', '', "class='form-control' rows='3'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->responsibleDepart;?></th>
        <td><?php echo html::input('responsibleDepart', '', 'class="form-control"');?></td>
        <td width="500">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->riskmanage->responsiblePerson;?></span>
            <?php echo html::select('responsiblePerson', $users, '', 'class="form-control chosen"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->remissionCycle;?></th>
        <td><?php echo html::input('remissionCycle', '', 'class="form-control"');?></td>
        <td width="500">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->riskmanage->monitoringTime;?></span>
            <?php echo html::input('monitoringTime', '', 'class="form-control form-date"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->monitoringResult;?></th>
        <td><?php echo html::select('monitoringResult', $lang->riskmanage->monitoringResultList, '', 'class="form-control chosen"');?></td>
        <td width="500">
          <div class="input-group">
            <span class='input-group-addon'><?php echo $lang->riskmanage->stateTracking;?></span>
            <?php echo html::select('stateTracking', $lang->riskmanage->stateTrackingList, '', 'class="form-control chosen"');?>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->kpi;?></th>
        <td colspan="2"><?php echo html::input('kpi', '', 'class="form-control"');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->riskmanage->mailto;?></th>
        <td colspan="2"><?php echo html::select('mailto[]', $users, '', "multiple class='form-control chosen'");?></td>
      </tr>
      <tr><td></td>
        <td colspan="2">
          <?php echo html::submitButton() . html::backButton(); ?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
