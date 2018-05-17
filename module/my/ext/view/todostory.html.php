<?php
/**
 * The story view file of dashboard module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     dashboard
 * @version     $Id: story.html.php 5116 2013-07-12 06:37:48Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/tablesorter.html.php';?>
<style>
    .red {background: red!important;}
    .blue {background: blue!important;}
    .green {background: green!important;}
</style>
<div id='featurebar'>
  <nav class='nav'>
    <?php
    echo "<li id='toTestStoryTab'>" . html::a(inlink('todoStory', "type=toTestStory"),  $lang->my->todoStoryMenu->toTestStory) . "</li>";
    echo "<li id='toReleaseStoryTab'>"   . html::a(inlink('todoStory', "type=toReleaseStory&orderBy=specialPlan"),    $lang->my->todoStoryMenu->toReleaseStory)   . "</li>";
    ?>
  </nav>
    <?php if ($type == 'toReleaseStory'):?>
    <div class='actions'>
        <?php
        common::printIcon('story', 'export', "productID=0&orderBy=id_desc&project=0&type=toReleased", '', 'button', '', '', 'export');?>
    </div>
    <?php endif;?>
    <div id='querybox' class='show'></div>
</div>
<form method='post' id='myStoryForm'>
<table class='table table-condensed table-hover table-striped tablesorter table-fixed table-selectable'>
  <?php $vars = "type=$type&browseType=$browseType&param=$param&orderBy=%s&recTotal=$recTotal&recPerPage=$recPerPage&pageID=$pageID"; ?>
  <thead>
    <tr class='text-center'>
      <th class='w-id {sorter:false}'>    <?php common::printOrderLink('id',           $orderBy, $vars, $lang->idAB);?></th>
      <!--<th class='w-pri {sorter:false}'>   <?php /*common::printOrderLink('pri',          $orderBy, $vars, $lang->priAB);*/?></th>-->
      <th class='w-140px {sorter:false}'> <?php common::printOrderLink('productTitle', $orderBy, $vars, $lang->story->product);?></th>
      <th class="{sorter:false}">         <?php common::printOrderLink('title',        $orderBy, $vars, $lang->story->title);?></th>
      <th class='w-date {sorter:false}'> <?php common::printOrderLink('testDate',         $orderBy, $vars, $lang->story->testDate);?></th>
      <th class='w-80px {sorter:false}'> <?php common::printOrderLink('specialPlan',         $orderBy, $vars, $lang->story->specialPlan);?></th>
        <th class='w-status {sorter:false}'><?php common::printOrderLink('status',       $orderBy, $vars, $lang->statusAB);?></th>
        <th class='w-60px {sorter:false}'> <?php common::printOrderLink('stage',        $orderBy, $vars, $lang->story->stageAB);?></th>
        <?php if ($type == 'toTestStory'):?>
        <th class='w-70px {sorter:false}'>  <?php common::printOrderLink('testStatus',     $orderBy, $vars, $lang->story->testStatus);?></th>
        <?php endif;?>
        <?php if ($type == 'toReleaseStory'):?>
        <th class='w-70px {sorter:false}'>   <?php common::printOrderLink('verifyStatus',      $orderBy, $vars, $lang->story->verifyStatus);?></th>
        <?php endif;?>
      <th class='w-60px {sorter:false}'>  <?php common::printOrderLink('openedBy',     $orderBy, $vars, $lang->openedByAB);?></th>
      <?php if ($type == 'toTestStory'):?>
      <th class='w-120px {sorter:false}'>  <?php common::printOrderLink('assignedTo',     $orderBy, $vars, $lang->story->assignedTo);?></th>
      <th class='w-30px'>  <?php echo $lang->story->taskCountAB;?></th>
      <th class='w-80px'>  <?php echo $lang->story->storyReviewID;?></th>
      <?php endif;?>
      <th class='w-80px'>  <?php echo $lang->my->build;?></th>
      <th class='w-80px'>  <?php echo $lang->my->patchBuild;?></th>
      <?php if ($type == 'toReleaseStory'):?>
        <th class="w-80px {sorter:false}"><?php common::printOrderLink('linkStories',        $orderBy, $vars, $lang->story->linkStories);?></th>
        <th class="w-110px"><?php echo $lang->story->linkStoryOpenedBys;?></th>
      <?php endif;?>
    </tr>
  </thead>
  <tbody>
    <?php
    $canBatchEdit  = common::hasPriv('story', 'batchEdit');
    $canBatchClose = (common::hasPriv('story', 'batchClose') && strtolower($type) != 'closedbyme');
    ?>
    <?php foreach($stories as $key => $story):?>
    <?php if ($story->status == 'closed' and $story->closedReason != 'done') continue;?>
    <?php
        if ($story->projectID)
        {
            $storyLink = $this->createLink('story', 'view', "id=$story->id&version=$story->version&from=project&param=$story->projectID");
        }else
        {
            $storyLink = $this->createLink('story', 'view', "id=$story->id");
        }
    ?>

    <tr class='text-center'>
      <td class='cell-id'>
        <?php if($canBatchEdit or $canBatchClose):?>
        <input type='checkbox' name='storyIDList[<?php echo $story->id;?>]' value='<?php echo $story->id;?>' /> 
        <?php endif;?>
        <?php echo html::a($storyLink, sprintf('%03d', $story->id));?>
      </td>
     <!-- <td><span class='<?php /*echo 'pri' . zget($lang->story->priList, $story->pri, $story->pri);*/?>'><?php /*echo zget($lang->story->priList, $story->pri, $story->pri);*/?></span></td>-->
      <td><?php echo $story->productTitle;?></td>
      <td class='text-left nobr' title="<?php echo $story->title?>"><?php echo html::a($storyLink, $story->title, null, "style='color: $story->color'");?></td>
      <td class="<?php if (isset($story->testWarning) and $type == 'toTestStory') echo $story->testWarning;?>"><?php echo $story->testDate;?></td>
      <td class="<?php if(isset($story->releaseWarning) and $type == 'toReleaseStory') echo $story->releaseWarning;?>"><?php echo $story->specialPlan;?></td>
       <td class='story-<?php echo $story->status;?>'><?php echo $lang->story->statusList[$story->status];?></td>
      <td class="<?php if ($story->stage == 'projected' or ($type == 'toReleaseStory' and ($story->stage == 'developing' or $story->stage == 'developed' or $story->stage == 'testing'))) echo 'red';?>"><?php echo $lang->story->stageList[$story->stage];?></td>
      <?php if ($type == 'toTestStory'):?>
      <td class="<?php if ($story->testStatus === 'notTest' or $story->testStatus === 'partTest') echo 'red';?>"><?php echo $lang->story->testStatusList[$story->testStatus];?></td>
      <?php endif;?>
      <?php if ($type == 'toReleaseStory'):?>
      <td class="<?php if ($story->verifyStatus === 'failed' or $story->verifyStatus === 'noVerified' or $story->verifyStatus === 'portVerified') echo 'red';?>"><?php echo $lang->story->verifyStatusList[$story->verifyStatus];?></td>
      <?php endif;?>
      <td><?php echo $users[$story->openedBy];?></td>
      <?php if ($type == 'toTestStory'):?>
      <td><?php $assignedTo = explode(',', $story->assignedTo); foreach($assignedTo as $account) {if(empty($account)) continue; echo "<span>" . $users[trim($account)] . '</span> &nbsp;'; }?></td>
      <td><?php  $tasksLink = helper::createLink('story', 'tasks', "storyID=$story->id");
          $storyTasks[$story->id] > 0 ? print(html::a($tasksLink, $storyTasks[$story->id], '', 'class="iframe"')) : print(0);
          ?></td>
      <td>
      <?php
      if(!empty($story->storyReviewID))
      {
          $story->storyReviewID = explode(',', $story->storyReviewID);
          foreach ($story->storyReviewID as $value)
          {
              common::printLink('storyreview', 'view', "storyReviewID=$value&from=project", $value);
          }
      }
      ?>
      </td>
      <?php endif;?>
      <td>
      <?php
      foreach ($story->build as $value)
      {
          $buildLink = $this->createLink('build', 'view', "id=$value");
          echo html::a($buildLink, $value);
      };
      ?>
      </td>
      <td>
          <?php
          foreach ($story->patchBuild as $value)
          {
              $buildLink = $this->createLink('patchbuild', 'view', "id=$value");
              echo html::a($buildLink, $value);
          };
          ?>
      </td>
      <?php if ($type == 'toReleaseStory'):?>
      <td>
          <?php
          if (!empty($story->linkStories))
          {
              foreach (explode(',', $story->linkStories) as $value)
              {
                  $storyLink = $this->createLink('story', 'view', "id=$value");
                  echo html::a($storyLink, $value);
              };
          }
          ?>
      </td>
      <td><?php echo isset($story->linkStoryOpenedBys)?$story->linkStoryOpenedBys:'';?></td>
      <?php endif;?>
    </tr>
    <?php endforeach;?>
  </tbody>
  <tfoot>
  <tr>
    <td colspan= <?php echo $type == 'toTestStory'?'14':'13';?>>
      <?php if(count($stories)):?>
      <div class='table-actions clearfix'>
        <?php echo html::selectButton();?>
        <div class='btn-group dropup'>
          <?php
          $actionLink = $this->createLink('story', 'batchEdit');
          $misc       = $canBatchEdit ? "onclick=\"setFormAction('$actionLink')\"" : "disabled='disabled'";
          echo html::commonButton($lang->edit, $misc);
          ?>
          <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'><span class='caret'></span></button>
          <ul class='dropdown-menu'>
            <?php
            $class = "class='disabled'";
            $actionLink = $this->createLink('story', 'batchClose');
            $misc = ($canBatchClose and $type != 'closedBy') ? "onclick=\"setFormAction('$actionLink')\"" : $class;
            if($misc) echo "<li>" . html::a('javascript:;', $lang->close, '', $misc) . "</li>";

            if(common::hasPriv('story', 'batchReview'))
            {
                echo "<li class='dropdown-submenu'>";
                echo html::a('javascript:;', $lang->story->review, '', "id='reviewItem'");
                echo "<ul class='dropdown-menu'>";
                unset($lang->story->reviewResultList['']);
                unset($lang->story->reviewResultList['revert']);
                foreach($lang->story->reviewResultList as $key => $result)
                {
                    $actionLink = $this->createLink('story', 'batchReview', "result=$key");
                    if($key == 'reject')
                    {
                        echo "<li class='dropdown-submenu'>";
                        echo html::a('#', $result, '', "id='rejectItem'");
                        echo "<ul class='dropdown-menu'>";
                        unset($lang->story->reasonList['']);
                        unset($lang->story->reasonList['subdivided']);
                        unset($lang->story->reasonList['duplicate']);

                        foreach($lang->story->reasonList as $key => $reason)
                        {
                            $actionLink = $this->createLink('story', 'batchReview', "result=reject&reason=$key");
                            echo "<li>";
                            echo html::a('#', $reason, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"");
                            echo "</li>";
                        }
                        echo '</ul></li>';
                    }
                    else
                    {
                      echo '<li>' . html::a('#', $result, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"") . '</li>';
                    }
                }
                echo '</ul></li>';
            }
            else
            {
                echo '<li>' . html::a('javascript:;', $lang->story->review,  '', $class) . '</li>';
            }

            if(common::hasPriv('story', 'batchAssignTo'))
            {
                  $withSearch = count($users) > 10;
                  $actionLink = $this->createLink('story', 'batchAssignTo');
                  echo html::select('assignedTo', $users, '', 'class="hidden"');
                  echo "<li class='dropdown-submenu'>";
                  echo html::a('javascript::', $lang->story->assignedTo, '', 'id="assignItem"');
                  echo "<div class='dropdown-menu" . ($withSearch ? ' with-search':'') . "'>";
                  echo '<ul class="dropdown-list">';
                  foreach ($users as $key => $value)
                  {
                      if(empty($key) or $key == 'closed') continue;
                      echo "<li class='option' data-key='$key'>" . html::a("javascript:$(\".table-actions #assignedTo\").val(\"$key\");setFormAction(\"$actionLink\")", $value, '', '') . '</li>';
                  }
                  echo "</ul>";
                  if($withSearch) echo "<div class='menu-search'><div class='input-group input-group-sm'><input type='text' class='form-control' placeholder=''><span class='input-group-addon'><i class='icon-search'></i></span></div></div>";
                  echo "</div></li>";
            }
            else
            {
                echo '<li>' . html::a('javascript:;', $lang->story->assignedTo, '', $class) . '</li>';
            }
            if(common::hasPriv('story', 'batchChangeTestStatus'))
            {
                echo "<li class='dropdown-submenu'>";
                echo html::a('javascript:;', $lang->story->testStatus, '', "id='testStatusItem'");
                echo "<ul class='dropdown-menu'>";
                unset($lang->story->testStatusList['']);
                foreach($lang->story->testStatusList as $key => $result)
                {
                    $actionLink = $this->createLink('story', 'batchChangeTestStatus', "result=$key");
                    echo '<li>' . html::a('#', $result, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"") . '</li>';
                }
                echo '</ul></li>';
            }
            if(common::hasPriv('story', 'batchChangeVerifyStatus'))
            {
                echo "<li class='dropdown-submenu'>";
                echo html::a('javascript:;', $lang->story->verifyStatus, '', "id='verifyStatusItem'");
                echo "<ul class='dropdown-menu'>";
                unset($lang->story->verifyStatusList['']);
                foreach($lang->story->verifyStatusList as $key => $result)
                {
                    $actionLink = $this->createLink('story', 'batchChangeVerifyStatus', "result=$key");
                    echo '<li>' . html::a('#', $result, '', "onclick=\"setFormAction('$actionLink','hiddenwin')\"") . '</li>';
                }
                echo '</ul></li>';
            }
            ?>
          </ul>
        </div>
      </div>
      <?php endif;?>
      <?php $pager->show();?>
    </td>
  </tr>
  </tfoot>
</table>
</form>
<script language='javascript'>
    $("#<?php echo $type;?>Tab").addClass('active');
    ajaxGetSearchForm();
</script>
<?php include '../../../common/view/footer.html.php';?>
