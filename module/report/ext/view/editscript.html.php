<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php include '../../../common/view/kindeditor.html.php';?>
<style>
  #titlebar{
    margin: -10px -40px 20px -20px;
    display:block}
</style>
<div class='container'>
  <form class='form-condensed' method='post' target='hiddenwin' id='dataform' enctype='multipart/form-data'>
    <div id='titlebar'>
      <div class='heading'>
        <span class='prefix'><?php echo html::icon($lang->icons['build']);?> <strong><?php echo $script->id;?></strong></span>
        <strong><?php echo $script->scriptName;?></strong>
        <small><?php echo html::icon($lang->icons['edit']) . ' ' . $lang->task->edit;?></small>
      </div>
      <div class='actions'>
        <?php echo html::submitButton($lang->save)?>
      </div>
    </div>

    <fieldset class='fieldset-pure'>
      <table class='table table-form'>
        <tr>
          <th width="60"><?php echo $lang->task->scriptName;?></th>
          <td>
            <?php echo html::input('scriptName', $script->scriptName, "class='form-control'");?>
            <?php echo html::hidden('taskID', $script->task);?>
          </td>
          <td width="400">
            <div class="input-group">
              <span class='input-group-addon'><?php echo $lang->task->scriptType;?></span>
              <?php echo html::select('scriptType', $lang->task->scriptTypeList, $script->scriptType, 'class=form-control');?>
              <span class='input-group-addon fix-border br-0'><?php echo $lang->task->lob;?></span>
              <?php echo html::select('lob', $lang->task->lobList, $script->lob, 'class=form-control');?>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->task->frequency;?></th>
          <td><?php echo html::input('frequency', $script->frequency, "class='form-control'");?></td>
          <td>
            <div class="input-group">
              <span class='input-group-addon'><?php echo $lang->task->configurationFile;?></span>
              <?php echo html::input('configurationFile', $script->configurationFile, "class='form-control'");?>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->task->output;?></th>
          <td><?php echo html::input('output', $script->output, "class='form-control'");?></td>
          <td>
            <div class="input-group">
              <span class='input-group-addon'><?php echo $lang->task->precondition;?></span>
              <?php echo html::input('precondition', $script->precondition, "class='form-control'");?>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->task->performBody;?></th>
          <td><?php echo html::input('performBody', $script->performBody, "class='form-control'");?></td>
          <td>
            <div class="input-group">
              <span class='input-group-addon'><?php echo $lang->task->performMode;?></span>
              <?php echo html::select('performMode', $lang->task->performModeList, $script->performMode, 'class=form-control');?>
              <span class='input-group-addon fix-border br-0'><?php echo $lang->task->performSystem;?></span>
              <?php echo html::select('performSystem', $lang->task->performSystemList, $script->performSystem, 'class=form-control');?>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->task->scriptPath;?></th>
          <td colspan="2"><?php echo html::input('scriptPath', $script->scriptPath, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->task->tester;?></th>
          <td>
            <div class="input-group">
              <?php echo html::select('tester', $users, $script->tester, "class='form-control chosen'");?>
              <span class='input-group-addon fix-border br-0'><?php echo $lang->task->releasedDate;?></span>
              <?php echo html::input('releasedDate', $script->releasedDate, "class='form-control form-date'; style='width:100px';");?>
            </div>
          </td>
          <td>
            <div class="input-group">
              <span class='input-group-addon'><?php echo $lang->task->AT;?></span>
              <?php echo html::select('AT', $lang->task->ATList, $script->AT, 'class=form-control');?>
              <span class='input-group-addon fix-border br-0'><?php echo $lang->task->released;?></span>
              <?php echo html::select('released', $lang->task->releasedList, $script->released, 'class=form-control');?>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->task->notice;?></th>
          <td colspan="3"><?php echo html::textarea('notice', $script->notice, "rows='10' class='form-control'");?></td>
        </tr>
      </table>
    </fieldset>
  </form>
</div>
<?php include '../../../common/view/footer.html.php';?>
