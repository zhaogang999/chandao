<?php
/**
 * The view file of scriptTask module's view method of ZenTaoPMS.
 *
 */
?>
<?php include '../../../common/view/header.html.php';?>

<style>
  #titlebar{display:block}
</style>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['build']);?> <strong><?php echo $script->id;?></strong></span>
    <strong><?php echo $script->scriptName;?></strong>
    <?php if($script->deleted):?>
    <span class='label label-danger'><?php echo $lang->task->deleted;?></span>
    <?php endif; ?>
  </div>
  <div class='actions'>
  <?php
  $browseLink = $this->session->scriptTaskList ? $this->session->scriptTaskList : $this->createLink('report', 'scriptTask', "");

  if(!$script->deleted)
  {
      echo "<div class='btn-group'>";
      if(common::hasPriv('report', 'editscript'))
      {
        common::printIcon('report', 'editscript', "scriptID=$script->id", '', 'list', 'pencil', '', '', false, '', $lang->task->edit);
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
          <legend><?php echo $lang->task->configurationFile;?></legend>
          <div class='article-content'><?php echo $script->configurationFile;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->task->output;?></legend>
          <div class='article-content'><?php echo $script->output;?></div>
        </fieldset>
         </fieldset>
        <fieldset>
          <legend><?php echo $lang->task->precondition;?></legend>
          <div class='article-content'><?php echo $script->precondition;?></div>
        </fieldset>
         </fieldset>
        <fieldset>
          <legend><?php echo $lang->task->performBody;?></legend>
          <div class='article-content'><?php echo $script->performBody;?></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->task->notice;?></legend>
          <div class='article-content'><?php echo htmlspecialchars_decode($script->notice);?></div>
        </fieldset>
      </div>
    </div>
  </div>
  <div class='col-side'>
    <div class='main-side main'>
      <fieldset>
        <legend><?php echo $lang->task->legendBasic;?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->task->story;?></th>
            <td>
              <?php
              if($script->storyTitle and !common::printLink('story', 'view', "storyID=$script->story", $script->story . ' ' . $script->storyTitle, '', "class='iframe' data-width='80%'", true, true)) echo $script->story . ' ' . $script->storyTitle;
              ?>
            </td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->task->openedBy;?></th>
            <td><?php echo $users[$script->openedBy];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->report->linkTask;?></th>
            <td>
              <?php
              if($script->taskTitle and !common::printLink('task', 'view', "taskID=$script->task", $script->task . ' ' . $script->taskTitle, '', "class='iframe' data-width='80%'", true, true)) echo $script->task . ' ' . $script->taskTitle;
              ?>
            </td>
          </tr>
          <tr>
            <th><?php echo $lang->task->finishedBy;?></th>
            <td><?php echo $users[$script->finishedBy];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->finishedDate;?></th>
            <td><?php echo $script->finishedDate;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->task->scriptType;?></th>
            <td><?php echo $lang->task->scriptTypeList[$script->scriptType];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->task->lob;?></th>
            <td><?php echo $lang->task->lobList[$script->lob];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->task->frequency;?></th>
            <td><?php echo $script->frequency;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->performMode;?></th>
            <td><?php echo $lang->task->performModeList[$script->performMode];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->performSystem;?></th>
            <td><?php echo $lang->task->performSystemList[$script->performSystem];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->scriptPath;?></th>
            <td><?php echo $script->scriptPath;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->releasedDate;?></th>
            <td><?php echo $script->releasedDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->tester;?></th>
            <td><?php echo $users[$script->tester];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->AT;?></th>
            <td><?php echo $lang->task->ATList[$script->AT];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->released;?></th>
            <td><?php echo $lang->task->releasedList[$script->released];?></td>
          </tr>
        </table>
      </fieldset>
      <?php include '../../../common/view/action.html.php';?>
    </div>
  </div>
</div>
<?php include '../../../common/view/footer.html.php';?>
