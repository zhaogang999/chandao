<?php
/**
 * The view file of riskmanage module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     riskmanage
 * @version     20171214
 */
?>
<?php include '../../common/view/header.html.php';?>

<?php if(isonlybody()):?>
<style>
tbody tr td:last-child a{display:none;}
tbody tr td:first-child input{display:none;}
tfoot tr td .table-actions .btn{display:none;}
#titlebar .actions{display:none}
.row-table .col-side{display:none;}
</style>
<?php endif;?>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><strong><?php echo $riskManage->id;?></strong></span>
    <strong><?php echo $riskManage->title;?></strong>
    <?php if($riskManage->deleted):?>
    <span class='label label-danger'><?php echo $lang->delete;?></span>
    <?php endif; ?>
  </div>
  <div class='actions'>
  <?php
  $browseLink = $this->session->riskManageList ? $this->session->riskManageList : $this->createLink('riskmanage', 'browse');
  if(!$riskManage->deleted)
  {
    echo "<div class='btn-group'>";
    common::printIcon('riskmanage', 'edit',   "riskmanageID=$riskManage->id", '','list', 'pencil', '', '', false, '', $lang->riskmanage->edit);
    echo '</div>';
    echo "<div class='btn-group'>";
    if(common::hasPriv('riskmanage', 'delete'))
    {
      common::printIcon('riskmanage', 'delete', "riskmanageID=$riskManage->id", '', 'list', 'remove', 'hiddenwin');
    }
    echo '</div>';
    echo "<div class='btn-group'>";
    common::printIcon('riskmanage', 'close', "taskID=$riskManage->id", $riskManage, 'list', '', 'hiddenwin');
    echo '</div>';
  }

  echo common::printRPN($browseLink);
  ?>
  </div>
</div>
<div class='row-table'>
  <div class='col-main'>
    <div class='main'>
      <div class='tabs'>
        <fieldset>
          <legend><?php echo $lang->riskmanage->desc;?></legend>
          <div class='article-content'><?php echo $riskManage->desc;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->riskmanage->preventiveMeasure;?></legend>
          <div class='article-content'><?php echo $riskManage->preventiveMeasure;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->riskmanage->emergencyMeasure;?></legend>
          <div class='article-content'><?php echo $riskManage->emergencyMeasure;?></div>
        </fieldset>
        <?php include '../../common/view/action.html.php';?>
      </div>
    </div>
  </div>
  <div class='col-side'>
    <div class='main-side main'>
      <fieldset>
        <legend><?php echo $lang->riskmanage->basicInfo;?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->riskType;?></th>
            <td><?php echo $lang->riskmanage->riskTypeList[$riskManage->riskType];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->object;?></th>
            <td><?php echo $riskManage->object;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->posedDepart;?></th>
            <td><?php echo $riskManage->posedDepart;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->riskLife;?></th>
            <td><?php echo $riskManage->riskLife;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->posedDepart;?></th>
            <td><?php echo $riskManage->posedDepart;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->influence;?></th>
            <td><?php echo $lang->riskmanage->influenceList[$riskManage->influence];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->probability;?></th>
            <td><?php echo $lang->riskmanage->probabilityList[$riskManage->probability];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->riskScore;?></th>
            <td><?php echo $riskManage->riskScore;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->pri;?></th>
            <td><?php echo $lang->riskmanage->priList[$riskManage->pri];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->responsibleDepart;?></th>
            <td><?php echo $riskManage->responsibleDepart;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->responsiblePerson;?></th>
            <td><?php echo $users[$riskManage->responsiblePerson];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->remissionCycle;?></th>
            <td><?php echo $riskManage->remissionCycle;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->monitoringTime;?></th>
            <td><?php echo $riskManage->monitoringTime;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->monitoringResult;?></th>
            <td><?php echo $lang->riskmanage->monitoringResultList[$riskManage->monitoringResult];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->stateTracking;?></th>
            <td><?php echo $lang->riskmanage->stateTrackingList[$riskManage->stateTracking];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->riskmanage->kpiAB;?></th>
            <td><?php echo $riskManage->kpiAB;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->riskmanage->mailto;?></th>
            <td><?php $mailto = explode(',', str_replace(' ', '', $riskManage->mailto)); foreach($mailto as $account) echo ' ' . zget($users, $account, $account);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->riskmanage->openedBy;?></th>
            <td><?php echo $users[$riskManage->openedBy];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->riskmanage->openedDate;?></th>
            <td><?php echo $riskManage->openedDate;?></td>
          </tr>
        </table>
      </fieldset>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
