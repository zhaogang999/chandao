<?php
/**
 * The view file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     task
 * @version     $Id: view.html.php 4808 2013-06-17 05:48:13Z zhujinyonging@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/kindeditor.html.php';?>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['task']);?> <strong><?php echo $task->id;?></strong></span>
    <strong style='color: <?php echo $task->color;?>'>
      <?php if(!empty($task->parent)) echo '<span class="label">' . $this->lang->task->childrenAB . '</span> ';?>
      <?php if(!empty($task->team)) echo '<span class="label">' . $this->lang->task->multipleAB . '</span> ';?>
      <?php echo isset($task->parentName) ? $task->parentName . '/' : '';?><?php echo $task->name;?>
    </strong>
    <?php if($task->deleted):?>
      <span class='label label-danger'><?php echo $lang->task->deleted;?></span>
    <?php endif;?>
    <?php if($task->fromBug != 0):?>
      <small><?php echo html::icon($lang->icons['bug']) . " {$lang->task->fromBug}$lang->colon$task->fromBug";?></small>
    <?php endif;?>
  </div>
  <div class='actions'>
    <?php
    $browseLink  = $app->session->taskList != false ? $app->session->taskList : $this->createLink('project', 'browse', "projectID=$task->project");
    $actionLinks = '';
    if(!$task->deleted)
    {
      ob_start();
      echo "<div class='btn-group'>";
      common::printIcon('task', 'assignTo', "projectID=$task->project&taskID=$task->id", $task, 'button', '', '', 'iframe', true, '', empty($task->team) ? $lang->task->assignTo : $lang->task->transfer);
      common::printIcon('task', 'start',          "taskID=$task->id", $task, 'button', '', '', 'iframe', true);
      common::printIcon('task', 'restart',        "taskID=$task->id", $task, 'button', '', '', 'iframe', true);
      common::printIcon('task', 'recordEstimate', "taskID=$task->id", $task, 'button', '', '', 'iframe', true);
      common::printIcon('task', 'pause',          "taskID=$task->id", $task, 'button', '', '', 'iframe', true);
      common::printIcon('task', 'finish',         "taskID=$task->id", $task, 'button', '', '', 'iframe showinonlybody text-success', true);
      common::printIcon('task', 'close',          "taskID=$task->id", $task, 'button', '', '', 'iframe', true);
      common::printIcon('task', 'activate',       "taskID=$task->id", $task, 'button', '', '', 'iframe text-success', true);
      common::printIcon('task', 'cancel',         "taskID=$task->id", $task, 'button', '', '', 'iframe', true);
      echo '</div>';

      echo "<div class='btn-group'>";
      if(empty($task->team) or empty($task->children)) common::printIcon('task', 'batchCreate',    "project=$task->project&storyID=$task->story&moduleID=$task->module&taskID=$task->id", $task, 'button','plus','','','','',' ');
      common::printIcon('task', 'edit',  "taskID=$task->id", $task);
      common::printCommentIcon('task', $task);
      common::printIcon('task', 'create', "productID=0&storyID=0&moduleID=0&taskID=$task->id", $task, 'button', 'copy');
      common::printIcon('task', 'delete', "projectID=$task->project&taskID=$task->id", $task, 'button', '', 'hiddenwin');
      echo '</div>';

      echo "<div class='btn-group'>";
      if(!empty($task->parent)) echo html::a(helper::createLink('task', 'view', "taskID=$task->parent"), "<i class='icon-pre icon-double-angle-left'></i>", '', "class='btn' title='{$lang->task->parent}'");
      //common::printRPN($browseLink, $preAndNext);
      echo '</div>';

      $actionLinks = ob_get_contents();
      ob_end_clean();
      echo $actionLinks;
    }
    else
    {
      common::printRPN($browseLink);
    }
    ?>
  </div>
</div>
<div class='row-table'>
  <div class='col-main'>
    <div class='main'>
      <fieldset>
        <legend><?php echo $lang->task->legendDesc;?></legend>
        <!--1923 针对测试类型的任务，设计任务描述模板-->
        <?php
        echo "<div>";
        $task->descAB = str_replace('<p>[测试范围]','<p class="commentTitle">[测试范围]</p><p>', $task->desc);
        $task->descAB = str_replace('<p>[测试策略]','<p class="commentTitle">[测试策略]</p><p>', $task->descAB);
        $task->descAB = str_replace('<p>[测试验证]','<p class="commentTitle">[测试验证]</p><p>', $task->descAB);
        $task->descAB = str_replace('<p>[测试风险]','<p class="commentTitle">[测试风险]</p><p>', $task->descAB);
        $task->descAB = str_replace('<p>[参考资料]','<p class="commentTitle">[参考资料]</p><p>', $task->descAB);

        $task->descAB = str_replace('<p></p>', '', $task->descAB);
        echo strip_tags($task->descAB) == $task->descAB ? nl2br($task->descAB) : $task->descAB;
        echo "</div>";
        ?>
      </fieldset>
      <?php if($project->type != 'ops'):?>
      <?php if($task->fromBug != 0):?>
        <fieldset>
          <legend><?php echo $lang->bug->steps;?></legend>
          <div class='article-content'><?php echo $task->bugSteps;?></div>
        </fieldset>
      <?php else:?>
        <fieldset>
          <legend><?php echo $lang->task->storySpec;?></legend>
          <div class='article-content'><?php echo $task->storySpec;?></div>
          <?php echo $this->fetch('file', 'printFiles', array('files' => $task->storyFiles, 'fieldset' => 'false'));?>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->task->storyVerify;?></legend>
          <div class='article-content'><?php echo $task->storyVerify;?></div>
        </fieldset>
      <?php endif;?>
      <?php if(isset($task->cases) and $task->cases):?>
        <fieldset>
          <legend><?php echo $lang->task->case;?></legend>
          <div class='article-content'>
            <ul class='list-unstyled'>
              <?php foreach($task->cases as $caseID => $case) echo '<li>' . html::a($this->createLink('testcase', 'view', "caseID=$caseID", '', true), "#$caseID " . $case, '', "data-toggle='modal' data-type='iframe' data-width='90%'") . '</li>';?>
            </ul>
          </div>
        </fieldset>
      <?php endif;?>
      <?php endif;?>
      <?php if(!empty($task->children)):?>
        <fieldset>
          <legend><?php echo $this->lang->task->children;?></legend>
          <table class='table table-hover table-data table-fixed'>
            <tr class='text-center'>
              <th class='w-60px'> <?php echo $lang->task->id;?></th>
              <th class='w-40px'> <?php echo $lang->task->lblPri;?></th>
              <th>                <?php echo $lang->task->name;?></th>
              <th class='w-100px'><?php echo $lang->task->deadline;?></th>
              <th class='w-80px'> <?php echo $lang->task->assignedTo;?></th>
              <th class='w-90px'> <?php echo $lang->task->status;?></th>
              <th class='w-50px visible-lg'><?php echo $lang->task->consumedAB . $lang->task->lblHour;?></th>
              <th class='w-50px visible-lg'><?php echo $lang->task->leftAB . $lang->task->lblHour;?></th>
              <th class='w-160px'><?php echo $lang->actions;?></th>
            </tr>
            <?php foreach($task->children as $child):?>
              <tr class='text-center'>
                <td><?php echo $child->id;?></td>
                <td>
                  <?php
                  echo "<span class='pri" . zget($this->lang->task->priList, $child->pri, $child->pri) . "'>";
                  echo $child->pri == '0' ? '' : zget($this->lang->task->priList, $child->pri, $child->pri);
                  echo "</span>";
                  ?>
                </td>
                <td class='text-left'><a href="<?php echo $this->createLink('task', 'view', "taskID=$child->id"); ?>"><?php echo $child->name;?></a></td>
                <td><?php echo $child->deadline;?></td>
                <td><?php if(isset($users[$child->assignedTo])) echo $users[$child->assignedTo];?></td>
                <td><?php echo zget($lang->task->statusList, $child->status);?></td>
                <td class='visible-lg'><?php echo $child->consumed;?></td>
                <td class='visible-lg'><?php echo $child->left;?></td>
                <td>
                  <?php
                  common::printIcon('task', 'assignTo', "projectID=$child->project&taskID=$child->id", $child, 'list', '', '', 'iframe', true);
                  common::printIcon('task', 'start',    "taskID=$child->id", $child, 'list', '', '', 'iframe', true);
                  common::printIcon('task', 'activate', "taskID=$child->id", $child, 'list', '', '', 'iframe', true);
                  common::printIcon('task', 'recordEstimate', "taskID=$child->id", $child, 'list', 'time', '', 'iframe', true);
                  common::printIcon('task', 'finish', "taskID=$child->id", $child, 'list', '', '', 'iframe', true);
                  common::printIcon('task', 'close',    "taskID=$child->id", $child, 'list', '', '', 'iframe', true);
                  common::printIcon('task', 'edit',"taskID=$child->id", $child, 'list');
                  ?>
                </td>
              </tr>
            <?php endforeach;?>
          </table>
        </fieldset>
      <?php endif;?>
      <?php echo $this->fetch('file', 'printFiles', array('files' => $task->files, 'fieldset' => 'true'));?>
      <!--新增-->
      <?php if($task->source == 'QA'):?>
        <fieldset>
          <legend><?php echo $lang->task->noItem;?></legend>
          <?php if($auditDetails != array()):?>
            <?php foreach ($auditDetails as $auditDetail):?>
              <table class='table table-form'>
                <tr>
                  <th class='w-80px'><?php echo $lang->task->auditID;?></th>
                  <td class='w-300px'>
                    <?php echo $auditDetail->auditID;?>
                  </td>
                  <th class='w-90px'><?php echo $lang->task->noDec;?></th>
                  <td class='w-300px'>
                    <?php echo $auditDetail->noDec;?>
                  </td>
                </tr>
                <tr>
                  <th><?php echo $lang->task->noType;?></th>
                  <td>
                    <?php echo $lang->task->noTypeList["$auditDetail->noType"];?>
                  </td>
                  <th><?php echo $lang->task->serious;?></th>
                  <td>
                    <?php echo $lang->task->seriousList["$auditDetail->serious"];;?>
                  </td>
                </tr>
                <tr>
                  <th><?php echo $lang->task->cause;?></th>
                  <td class="break-word">
                    <?php echo $auditDetail->cause;?>
                  </td>
                  <th><?php echo $lang->task->measures;?></th>
                  <td class="break-word">
                    <?php echo $auditDetail->measures;?>
                  </td>
                </tr>
              </table>
            <?php endforeach;?>
          <?php else:?>
            无不符合项
          <?php endif;?>
        </fieldset>
      <?php endif;?>
      <?php if(isset($review)):?>
        <fieldset>
          <legend><?php echo $lang->task->review;?></legend>
          <table class='table table-form with-border'>
            <tr>
              <th class='w-80px'><?php echo $lang->task->fileNO;?></th>
              <td class='w-400px'>
                <?php echo $review->fileNO;?>
              </td>
              <th class='w-80px'><?php echo $lang->task->recorder;?></th>
              <td class='w-400px'>
                <?php echo $review->recorder;?>
              </td>
            </tr>
            <tr>
              <th class='w-80px'><?php echo $lang->task->reviewName;?></th>
              <td class='w-350px'>
                <?php echo $review->reviewName;?>
              </td>
              <th class='w-80px'><?php echo $lang->task->reviewDate;?></th>
              <td class='w-350px'>
                <?php echo $review->reviewDate;?>
              </td>
            </tr>
            <tr>
              <th class='w-80px'><?php echo $lang->task->doc;?></th>
              <td class='w-350px'>
                <?php echo $review->doc;?>
              </td>
              <th class='w-80px'><?php echo $lang->task->reviewScope;?></th>
              <td class='w-350px'>
                <?php echo $review->reviewScope;?>
              </td>
            </tr>
            <tr>
              <th class='w-80px'><?php echo $lang->task->referenceDoc;?></th>
              <td class='w-350px'>
                <?php echo $review->referenceDoc;?>
              </td>
              <th class='w-80px'><?php echo $lang->task->reviewPlace;?></th>
              <td class='w-350px'>
                <?php echo $review->reviewPlace;?>
              </td>
            </tr>
            <tr>
              <th class='w-80px'><?php echo $lang->task->reference;?></th>
              <td class='w-350px'>
                <?php echo $review->reference;?>
              </td>
              <th class='w-80px'><?php echo $lang->task->effort;?></th>
              <td class='w-350px'>
                <?php echo $review->effort;?>
              </td>
            </tr>
            <tr>
              <th class='w-80px'><?php echo $lang->task->pages;?></th>
              <td class='w-350px'>
                <?php echo $review->pages;?>
              </td>
              <th class='w-80px'><?php echo $lang->task->conclusion;?></th>
              <td class='w-350px'>
                <?php echo $review->conclusion;?>
              </td>
            </tr>
            <tr>
              <th class='w-80px'><?php echo $lang->task->reviewers;?></th>
              <td colspan="3">
                <?php echo $review->reviewers;?>
              </td>
            </tr>
          </table>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang->task->problem;?></legend>
          <?php if($reviewDetails != array()):?>
            <?php foreach($reviewDetails as $reviewDetail):?>
              <?php /*if ($reviewDetail != ''):*/?>
              <table class='table table-form with-border'>
                <tr>
                  <th class='w-80px'><?php echo $lang->task->number;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->number;?>
                  </td>
                  <th class='w-80px'><?php echo $lang->task->reviewer;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->reviewer;?>
                  </td>
                </tr>
                <tr>
                  <th class='w-80px'><?php echo $lang->task->item;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->item;?>
                  </td>
                  <th class='w-80px'><?php echo $lang->task->line;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->line;?>
                  </td>
                </tr>
                <tr>
                  <th class='w-80px'><?php echo $lang->task->severity;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->severity;?>
                  </td>
                  <th class='w-80px'><?php echo $lang->task->description;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->description;?>
                  </td>
                </tr>
                <tr>
                  <th class='w-80px'><?php echo $lang->task->proposal;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->proposal;?>
                  </td>
                  <th class='w-80px'><?php echo $lang->task->changed;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->changed;?>
                  </td>
                </tr>
                <tr>
                  <th class='w-80px'><?php echo $lang->task->action;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->action;?>
                  </td>
                  <th class='w-80px'><?php echo $lang->task->chkd;?></th>
                  <td class='w-350px'>
                    <?php echo $reviewDetail->chkd;?>
                  </td>
                </tr>
              </table>
              <?php /*endif;*/?>
            <?php endforeach;?>
          <?php else:?>
            无评审问题
          <?php endif;?>
        </fieldset>
      <?php endif; ?>

      <?php if(isset($script)):?>
        <fieldset>
          <legend><?php echo $lang->task->script;?></legend>
          <table class='table table-data table-borderless'>
            <tr>
              <td class='w-70px'><b><?php echo $lang->task->scriptID;?></b></td>
              <td width="40%">
                <?php echo $script->id;?>
              </td>
              <td class='w-70px'><b><?php echo $lang->task->scriptName;?></b></td>
              <td>
                <?php echo $script->scriptName;?>
              </td>
            </tr>
            <tr>
              <td><b><?php echo $lang->task->scriptType;?></b></td>
              <td>
                <?php echo $lang->task->scriptTypeList[$script->scriptType];?>
              </td>
              <td><b><?php echo $lang->task->lob;?></b></td>
              <td>
                <?php echo $lang->task->lobList[$script->lob];?>
              </td>
            </tr>
            <tr>
              <td><b><?php echo $lang->task->frequency;?></b></td>
              <td>
                <?php echo $script->frequency;?>
              </td>
              <td><b><?php echo $lang->task->configurationFile;?></b></td>
              <td>
                <?php echo $script->configurationFile;?>
              </td>
            </tr>
            <tr>
              <td><b><?php echo $lang->task->output;?></b></td>
              <td>
                <?php echo $script->output;?>
              </td>
              <td><b><?php echo $lang->task->precondition;?></b></td>
              <td>
                <?php echo $script->precondition;?>
              </td>
            </tr>
            <tr>
              <td><b><?php echo $lang->task->performBody;?></b></td>
              <td>
                <?php echo $script->performBody;?>
              </td>
              <td><b><?php echo $lang->task->performMode;?></b></td>
              <td>
                <?php echo $lang->task->performModeList[$script->performMode];?>
              </td>
            </tr>
            <tr>
              <td><b><?php echo $lang->task->performSystem;?></b></td>
              <td>
                <?php echo $lang->task->performSystemList[$script->performSystem];?>
              </td>
              <td><b><?php echo $lang->task->scriptPath;?></b></td>
              <td>
                <?php echo $script->scriptPath;?>
              </td>
            </tr>
            <tr>
              <td><b><?php echo $lang->task->releasedDate;?></b></td>
              <td>
                <?php echo $script->releasedDate;?>
              </td>
              <td><b><?php echo $lang->task->tester;?></b></td>
              <td>
                <?php echo $users[$script->tester];?>
              </td>
            </tr>
            <tr>
              <td><b><?php echo $lang->task->AT;?></b></td>
              <td>
                <?php echo $lang->task->ATList[$script->AT];?>
              </td>
              <td><b><?php echo $lang->task->released;?></b></td>
              <td>
                <?php echo $lang->task->releasedList[$script->released];?>
              </td>
            </tr>
            <tr>
              <td><b><?php echo $lang->task->notice;?></b></td>
              <td colspan="3" class='article-content'>
                <?php /*echo strip_tags($script->notice) == $script->notice ? nl2br($script->notice) : $script->notice;*/?>
                <?php echo $script->notice;?>
              </td>
            </tr>
          </table>
        </fieldset>
      <?php endif;?>

      <?php include '../../../common/view/action.html.php';?>
      <div class='actions'> <?php if(!$task->deleted) echo $actionLinks;?></div>
      <fieldset id='commentBox' class='hide'>
        <legend><?php echo $lang->comment;?></legend>
        <form method='post' action='<?php echo $this->createLink('action', 'comment', "objectType=task&objectID=$task->id")?>' target='hiddenwin'>
          <div class="form-group"><?php echo html::textarea('comment', '',"rows='5' class='w-p100'");?></div>
          <?php echo html::submitButton() . html::backButton();?>
        </form>
      </fieldset>
    </div>
  </div>
  <div class='col-side'>
    <div class='main main-side'>
      <fieldset>
        <legend><?php echo $lang->task->legendBasic;?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->task->project;?></th>
            <td><?php if(!common::printLink('project', 'view', "projectID=$task->project", $project->name)) echo $project->name;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->module;?></th>
            <?php
            $moduleTitle = '';
            ob_start();
            if(empty($modulePath))
            {
              $moduleTitle .= '/';
              echo "/";
            }
            else
            {
              if($product)
              {
                $moduleTitle .= $product->name . '/';
                echo $product->name . $lang->arrow;
              }
              foreach($modulePath as $key => $module)
              {
                $moduleTitle .= $module->name;
                if(!common::printLink('project', 'task', "projectID=$task->project&browseType=byModule&param=$module->id", $module->name)) echo $module->name;
                if(isset($modulePath[$key + 1]))
                {
                  $moduleTitle .= '/';
                  echo $lang->arrow;
                }
              }
            }
            $printModule = ob_get_contents();
            ob_end_clean();
            ?>
            <td title='<?php echo $moduleTitle?>'><?php echo $printModule?></td>
          </tr>
          <tr class='nofixed'>
            <th><?php echo $lang->task->story;?></th>
            <td>
              <?php
              if($task->storyTitle and !common::printLink('story', 'view', "storyID=$task->story", $task->storyTitle, '', "class='iframe' data-width='80%'", true, true)) echo $task->storyTitle;
              if($task->needConfirm)
              {
                echo "(<span class='warning'>{$lang->story->changed}</span> ";
                echo html::a($this->createLink('task', 'confirmStoryChange', "taskID=$task->id"), $lang->confirm, 'hiddenwin');
                echo ")";
              }
              ?>
            </td>
          </tr>
          <?php if($task->fromBug):?>
            <tr>
              <th><?php echo $lang->task->fromBug;?></th>
              <td><?php echo html::a($this->createLink('bug', 'view', "bugID=$task->fromBug"), "#$task->fromBug " . $fromBug->title, '_blank');?></td>
            </tr>
          <?php endif;?>
          <tr>
            <th><?php echo empty($task->team) ? $lang->task->assignTo : $lang->task->transferTo;?></th>
            <td><?php echo $task->assignedTo ? $task->assignedToRealName . $lang->at . $task->assignedDate : '';?></td>
          </tr>
          <!--禅道任务增加关键字字段；需求：858；行号：361-365-->
          <tr>
            <th><?php echo $lang->task->keywords;?></th>
            <td><?php echo $task->keywords;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->type;?></th>
            <td><?php echo $lang->task->typeList[$task->type];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->status;?></th>
            <td><?php $lang->show($lang->task->statusList, $task->status);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->pri;?></th>
            <td><span class='<?php echo 'pri' . zget($lang->task->priList, $task->pri);?>'><?php echo $task->pri == '0' ? '' : zget($lang->task->priList, $task->pri)?></span></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->mailto;?></th>
            <td><?php $mailto = explode(',', str_replace(' ', '', $task->mailto)); foreach($mailto as $account) echo ' ' . zget($users, $account, $account); ?></td>
          </tr>
        </table>
      </fieldset>
      <?php if(!empty($task->team)) :?>
        <fieldset>
          <legend><?php echo $lang->task->team;?></legend>
          <table class='table table-data table-condensed table-borderless'>
            <thead>
            <tr>
              <th><?php echo $lang->task->team?></th>
              <th class='text-center'><?php echo $lang->task->estimate?></th>
              <th class='text-center'><?php echo $lang->task->consumed?></th>
              <th class='text-center'><?php echo $lang->task->left?></th>
            </tr>
            </thead>
            <?php foreach($task->team as $member):?>
              <tr class='text-center'>
                <td class='text-left'><?php echo zget($users, $member->account)?></td>
                <td><?php echo $member->estimate?></td>
                <td><?php echo $member->consumed?></td>
                <td><?php echo $member->left?></td>
              </tr>
            <?php endforeach;?>
          </table>
        </fieldset>
      <?php endif;?>
      <fieldset>
        <legend><?php echo $lang->task->legendEffort;?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->task->estStarted;?></th>
            <td><?php echo $task->estStarted;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->realStarted;?></th>
            <td><?php echo $task->realStarted; ?> </td>
          </tr>
          <tr>
            <th><?php echo $lang->task->deadline;?></th>
            <td>
              <?php
              echo $task->deadline;
              if(isset($task->delay)) printf($lang->task->delayWarning, $task->delay);
              ?>
            </td>
          </tr>
          <tr>
            <th><?php echo $lang->task->estimate;?></th>
            <td><?php echo $task->estimate . $lang->workingHour;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->consumed;?></th>
            <td><?php echo round($task->consumed, 2) . $lang->workingHour;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->left;?></th>
            <td><?php echo $task->left . $lang->workingHour;?></td>
          </tr>
        </table>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->task->legendLife;?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->task->openedBy;?></th>
            <td><?php if($task->openedBy) echo zget($users, $task->openedBy, $task->openedBy) . $lang->at . $task->openedDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->finishedBy;?></th>
            <td><?php if($task->finishedBy) echo zget($users, $task->finishedBy, $task->finishedBy) . $lang->at . $task->finishedDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->canceledBy;?></th>
            <td><?php if($task->canceledBy) echo zget($users, $task->canceledBy, $task->canceledBy) . $lang->at . $task->canceledDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->closedBy;?></th>
            <td><?php if($task->closedBy) echo zget($users, $task->closedBy, $task->closedBy) . $lang->at . $task->closedDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->closedReason;?></th>
            <td><?php echo $lang->task->reasonList[$task->closedReason];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->task->lastEdited;?></th>
            <td><?php if($task->lastEditedBy) echo zget($users, $task->lastEditedBy, $task->lastEditedBy) . $lang->at . $task->lastEditedDate;?></td>
          </tr>
        </table>
      </fieldset>
    </div>
  </div>
</div>
<?php include '../../../common/view/syntaxhighlighter.html.php';?>
<?php include '../../../common/view/footer.html.php';?>
