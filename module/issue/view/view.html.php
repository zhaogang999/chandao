<?php
/**
 * The view file of issue module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     issue
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
    <span class='prefix'><?php echo html::icon($lang->icons['issue']);?> <strong><?php echo $issue->id;?></strong></span>
    <strong><?php echo $issue->issueDesc;?></strong>
    <?php if($issue->deleted):?>
    <span class='label label-danger'><?php echo $lang->issue->deleted;?></span>
    <?php endif; ?>
  </div>
  <div class='actions'>
  <?php
  $browseLink = $this->session->issueList ? $this->session->issueList : $this->createLink('issue', 'browse');
  if(!$issue->deleted)
  {
    echo "<div class='btn-group'>";
    common::printIcon('issue', 'edit',   "issueID=$issue->id", '','list', 'pencil', '', '', false, '', $lang->issue->edit);
    echo '</div>';
    echo "<div class='btn-group'>";
    if(common::hasPriv('issue', 'delete'))
    {
      common::printIcon('issue', 'delete', "issueID=$issue->id", '', 'list', 'remove', 'hiddenwin');
    }
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
          <legend><?php echo $lang->issue->environmentVersion;?></legend>
          <div class='article-content'><?php echo nl2br($issue->environmentVersion);?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->issue->influence;?></legend>
          <div class='article-content'><?php echo nl2br($issue->influence);?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->issue->reason;?></legend>
          <div class='article-content'><?php echo $issue->reason;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->issue->shortTermMeasures;?></legend>
          <div class='article-content'><?php echo nl2br($issue->shortTermMeasures);?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->issue->longTermMeasures;?></legend>
          <div class='article-content'><?php echo nl2br($issue->longTermMeasures);?></div>
        </fieldset>
        <?php include '../../common/view/action.html.php';?>
      </div>
    </div>
  </div>
  <div class='col-side'>
    <div class='main-side main'>
      <fieldset>
        <legend><?php echo $lang->issue->basicInfo;?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->issue->platform;?></th>
            <td><?php echo $lang->issue->platformList[$issue->platform];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->issue->discoveryDate;?></th>
            <td><?php echo $issue->discoveryDate;?></td>
          </tr>
          <?php if (!empty($fromBug)):?>
          <tr>
            <th class='w-80px'><?php echo $lang->issue->fromBug;?></th>
            <td>
              <ul class='list-unstyled'>
                <?php echo "<li title='#$fromBug->id $fromBug->title'>" . html::a($this->createLink('bug', 'view', "bugID=$fromBug->id"), "#$fromBug->id $fromBug->title") . '</li>';?>
              </ul>
            </td>
          </tr>
          <?php endif;?>
          <tr>
            <th><?php echo $lang->issue->mailto;?></th>
            <td><?php $mailto = explode(',', str_replace(' ', '', $issue->mailto)); foreach($mailto as $account) echo ' ' . zget($users, $account, $account);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->issue->openedBy;?></th>
            <td><?php echo $users[$issue->openedBy];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->issue->openedTime;?></th>
            <td><?php echo $issue->openedTime;?></td>
          </tr>
        </table>
      </fieldset>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
