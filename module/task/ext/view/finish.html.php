<?php
/**
 * The complete file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Jia Fu <fujia@cnezsoft.com>
 * @package     task
 * @version     $Id: complete.html.php 935 2010-07-06 07:49:24Z jajacn@126.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/kindeditor.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['task']);?> <strong><?php echo $task->id;?></strong></span>
    <strong><?php echo html::a($this->createLink('task', 'view', 'task=' . $task->id), $task->name, '_blank');?></strong>
    <small class='text-success'> <?php echo $lang->task->finish;?> <?php echo html::icon($lang->icons['finish']);?></small>
  </div>
</div>
<form class='form-condensed' method='post' enctype='multipart/form-data' target='hiddenwin'>
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo !empty($task->team) ? $lang->task->common . $lang->task->consumed : $lang->task->hasConsumed;?></th>
      <td class='w-p25-f'><?php echo $task->consumed;?> <?php echo $lang->workingHour;?></td><td></td>
    </tr>
    <?php if(!empty($task->team)):?>
    <tr>
      <th class='w-80px'><?php echo $lang->task->hasConsumed;?></th>
      <td class='w-p25-f'> <?php echo $task->myConsumed;?> <?php echo $lang->workingHour;?></td><td></td>
    </tr>
    <?php endif;?>
    <tr>
      <th><?php echo empty($task->team) ? $lang->task->consumed : $lang->task->myConsumed;?></th>
      <td>
        <?php $consumed = empty($task->team) ? $task->consumed : $task->myConsumed;?>
        <div class='input-group'><?php echo html::input('consumed', $consumed, "class='form-control' autocomplete='off'");?> <span class='input-group-addon'><?php echo $lang->task->hour;?></span></div>
      </td>
    </tr>
    <tr>
      <th><?php echo empty($task->team) ? $lang->task->assign : $lang->task->transferTo;?></th>
      <td><?php echo html::select('assignedTo', $members, $task->nextBy, "class='form-control chosen'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->task->realStarted;?></th>
      <td><div class="required required-wrapper">::after</div><div class='datepicker-wrapper'><?php echo html::input('realStarted', $task->realStarted, "class='form-control form-date'");?></div></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->task->finishedDate;?></th>
      <td><div class="required required-wrapper">::after</div><div class='datepicker-wrapper'><?php echo html::input('finishedDate', helper::today(), "class='form-control form-date'");?></div></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->files;?></th>
      <td colspan='2'><?php echo $this->fetch('file', 'buildform');?></td>
    </tr>

    <?php if(isset($scriptTasks)):?>
      <tr>
        <td colspan='3'>
          <fieldset class='fieldset-pure'>
            <legend><?php echo $lang->task->script;?></legend>
            <table class='table table-form'>
              <thead>
                <tr>
                  <th class="w-id"><?php echo $lang->task->id;?></th>
                  <th><?php echo $lang->task->name;?></th>
                  <th class="w-100px"><?php echo $lang->task->tester;?></th>
                  <th class="w-100px"><?php echo $lang->task->AT;?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($scriptTasks as $scriptTask):?>
                  <tr>
                    <td><?php echo $scriptTask->id . html::hidden("tid[$scriptTask->id]", $scriptTask->id);?></td>
                    <td><?php echo $scriptTask->name;?></td>
                    <td><?php echo html::select("tester[$scriptTask->id]", $members, $scriptTask->tester, "class='form-control chosen'");?></td>
                    <td><?php echo html::select("AT[$scriptTask->id]", $lang->task->ATList, $scriptTask->AT, "class='form-control chosen'");?></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </fieldset>
        </td>
      </tr>
    <?php endif;?>

    <?php if($task->type == 'review'):?>
      <tr>
        <td colspan='3'>
          <fieldset class='fieldset-pure'>
            <legend><?php echo $lang->task->review;?></legend>
            <table class='table table-form'>
              <tr>
                <th><?php echo $lang->task->fileNO;?></th>
                <td width="320">
                  <?php echo html::input('fileNO', $review->fileNO, "class='form-control minw-330px'");?>
                </td>
                <td colspan="2" width="300">
                  <div id='mailtoGroup' class='input-group'>
                    <span class="input-group-addon"><?php echo $lang->task->recorder;?></span>
                    <?php echo html::input('recorder', $review->recorder, "class='form-control minw-330px'");?>
                  </div>
                </td>
              </tr>
              <tr>
                <th><?php echo $lang->task->reviewName;?></th>
                <td><?php echo html::input('reviewName', $review->reviewName, "class='form-control minw-60px'");?></td>
                <td colspan="2">
                  <div id='mailtoGroup' class='input-group'>
                    <span class="input-group-addon"><?php echo $lang->task->reviewDate;?></span>
                    <?php echo html::input('reviewDate', $review->reviewDate, "class='form-control form-date'");?>
                  </div>
                </td>
              </tr>
              <tr>
                <th><?php echo $lang->task->doc;?></th>
                <td><?php echo html::input('doc', $review->doc, "class='form-control minw-60px'");?></td>
                <td colspan="2">
                  <div id='mailtoGroup' class='input-group'>
                    <span class="input-group-addon"><?php echo $lang->task->reviewScope;?></span>
                    <?php echo html::input('reviewScope', $review->reviewScope, "class='form-control minw-60px'");?>
                  </div>
                </td>
              </tr>
              <tr>
                <th><?php echo $lang->task->referenceDoc;?></th>
                <td><?php echo html::input('referenceDoc', $review->referenceDoc, "class='form-control minw-60px'");?></td>
                <td colspan="2">
                  <div id='mailtoGroup' class='input-group'>
                    <span class="input-group-addon"><?php echo $lang->task->reviewPlace;?></span>
                    <?php echo html::input('reviewPlace', $review->reviewPlace, "class='form-control minw-60px'");?>
                  </div>
                </td>
              </tr>
              <tr>
                <th><?php echo $lang->task->reference;?></th>
                <td><?php echo html::input('reference', $review->reference, "class='form-control minw-60px'");?></td>
                <td colspan="2">
                  <div id='mailtoGroup' class='input-group'>
                    <span class="input-group-addon"><?php echo $lang->task->effort;?></span>
                    <?php echo html::input('effort', $review->effort, "class='form-control minw-60px' placeholder='{$lang->task->minute}'");?>
                  </div>
                </td>
              </tr>
              <tr>
                <th><?php echo $lang->task->pages;?></th>
                <td><?php echo html::input('pages', $review->pages, "class='form-control minw-60px'");?></td>
                <td colspan="2">
                  <div id='mailtoGroup' class='input-group'>
                    <span class="input-group-addon"><?php echo $lang->task->conclusion;?></span>
                    <?php echo html::select('conclusion', $lang->task->conclusionList, $reviewDetail->changed, 'class=form-control');?>
                  </div>
                </td>
              </tr>
              <tr>
                <th><?php echo $lang->task->reviewers;?></th>
                <td colspan="2"><?php echo html::input('reviewers', $review->reviewers, "class='form-control minw-60px'");?></td>
              </tr>
            </table>
          </fieldset>
          <fieldset class='fieldset-pure'>
            <legend><?php echo $lang->task->problem;?></legend>
            <table class='table table-form table-fixed with-border'>
              <thead>
                <tr class='text-center'>
                  <th class='w-20px'><?php echo $lang->task->number;?></th>
                  <th class='w-30px'><?php echo $lang->task->reviewer;?></th>
                  <th class='w-20px'><?php echo $lang->task->item;?></th>
                  <th class='w-20px'><?php echo $lang->task->line;?></th>
                  <th class='w-20px'><?php echo $lang->task->severity;?></th>
                  <th class='w-40px'><?php echo $lang->task->description;?></th>
                  <th class='w-40px'><?php echo $lang->task->proposal;?></th>
                  <th class='w-20px'><?php echo $lang->task->changed;?></th>
                  <th class='w-40px'><?php echo $lang->task->action;?></th>
                  <th class='w-20px'><?php echo $lang->task->chkd;?></th>
                  <th class='w-20px'><?php echo $lang->task->add;?></th>
                  <th class='w-20px'><?php echo $lang->task->del;?></th>
                </tr>
              </thead>
              <tr class='text-center'>
                <td>
                  <?php echo html::input('number[]', '', "class='form-control'");?>
                </td>
                <td><?php echo html::input('reviewer[]', '', "class='form-control'");?></td>
                <td><?php echo html::input('item[]', '', "class='form-control'");?></td>
                <td><?php echo html::input('line[]', '', "class='form-control'");?></td>
                <td><?php echo html::select('severity[]', $lang->task->severityList, $reviewDetail->severity, 'class=form-control');?></td>
                <td><?php echo html::textarea('description[]', '', "class='form-control' rows= '1'");?></td>
                <td><?php echo html::textarea('proposal[]', '', "class='form-control' rows= '1'");?></td>
                <td><?php echo html::select('changed[]', $lang->task->changedList, $reviewDetail->changed, 'class=form-control');?></td>
                <td><?php echo html::textarea('action[]', '', "class='form-control' rows= '1'");?></td>
                <td><?php echo html::select('chkd[]', $lang->task->chkdList, $reviewDetail->chkd, 'class=form-control');?></td>
                <td><a href='javascript:;' class='add'><i class='icon-plus'></i></a></td>
                <td><a href='javascript:;' class='del'><i class='icon icon-remove'></i></a></td>
              </tr>
            </table>
          </fieldset>
        </td>
      </tr>
    <?php endif;?>

    <?php if($task->type == 'script'):?>
    <tr>
      <td colspan='3'>
        <fieldset class='fieldset-pure'>
          <legend><?php echo $lang->task->script;?></legend>
          <table class='table table-form'>
            <tr>
              <th width="60"><?php echo $lang->task->scriptName;?></th>
              <td colspan="2">
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
              <td colspan="2"><?php echo html::input('frequency', $script->frequency, "class='form-control'");?></td>
              <td>
                <div class="input-group">
                  <span class='input-group-addon'><?php echo $lang->task->configurationFile;?></span>
                  <?php echo html::input('configurationFile', $script->configurationFile, "class='form-control'");?>
                </div>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->task->output;?></th>
              <td colspan="2"><?php echo html::input('output', $script->output, "class='form-control'");?></td>
              <td>
                <div class="input-group">
                  <span class='input-group-addon'><?php echo $lang->task->precondition;?></span>
                  <?php echo html::input('precondition', $script->precondition, "class='form-control'");?>
                </div>
              </td>
            </tr>

            <tr>
              <th><?php echo $lang->task->performMode;?></th>
              <td><?php echo html::select('performMode', $lang->task->performModeList, $script->performMode, 'class=form-control');?></td>
              <td width="200">
                <div class="input-group">
                  <span class='input-group-addon'><?php echo $lang->task->performSystem;?></span>
                  <?php echo html::select('performSystem', $lang->task->performSystemList, $script->performSystem, 'class=form-control');?>
                </div>
              </td>
              <td>
                <div class="input-group">
                  <span class='input-group-addon'><?php echo $lang->task->performBody;?></span>
                  <?php echo html::input('performBody', $script->performBody, "class='form-control'");?>
                </div>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->task->scriptPath;?></th>
              <td colspan="3"><?php echo html::input('scriptPath', $script->scriptPath, "class='form-control'");?></td>
                </div>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->task->notice;?></th>
              <td colspan="3"><?php echo html::textarea('notice', $script->notice, "rows='6' class='form-control'");?></td>
            </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <?php endif;?>
    <tr>
      <th width="50"><?php echo $lang->comment;?></th>
      <!--测试类型的任务增加文字模板-->
      <?php if(isset($testTaskComment)):?>
        <td colspan='2' width="800"><?php echo html::textarea('comment', $testTaskComment, "rows='6' class='w-p98'");?></td>
      <?php elseif(isset($develTaskComment)):?>
        <td colspan='2' width="800"><?php echo html::textarea('comment', $develTaskComment, "rows='6' class='w-p98'");?></td>
        <!--9195 需求类型的任务完成后填写生成需求ID-->
      <?php elseif(isset($storyTaskComment)):?>
        <td colspan='2' width="800"><?php echo html::textarea('comment', $storyTaskComment, "rows='6' class='w-p98'");?></td>
      <?php else:?>
        <td colspan='2' width="800"><?php echo html::textarea('comment', '', "rows='6' class='w-p98'");?></td>
      <?php endif;?>
      
    </tr>
    <tr>
      <th></th><td colspan='2'><?php echo html::submitButton($lang->task->finish);?></td>
    </tr>
  </table>
</form>
<div class='main'><?php include '../../../common/view/action.html.php';?></div>
<?php include '../../../common/view/footer.html.php';?>
