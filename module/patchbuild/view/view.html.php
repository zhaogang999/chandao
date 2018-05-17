<?php
/**
 * The view file of patchbuild module's view method of ZenTaoPMS.
 *
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('confirmUnlinkStory', $lang->patchbuild->confirmUnlinkStory)?>
<?php js::set('confirmUnlinkBug', $lang->patchbuild->confirmUnlinkBug)?>
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
    <span class='prefix'><?php echo html::icon($lang->icons['build']);?> <strong><?php echo $build->id;?></strong></span>
    <strong><?php echo $build->version;?></strong>
    <?php if($build->deleted):?>
    <span class='label label-danger'><?php echo $lang->build->deleted;?></span>
    <?php endif; ?>
  </div>
  <div class='actions'>
  <?php
  $browseLink = $this->session->patchbuildList ? $this->session->patchbuildList : $this->createLink('patchbuild', 'patchbuild', "objectID=$objectID&from=$from");
  if(!$build->deleted)
  {
    echo "<div class='btn-group'>";
    if(common::hasPriv('patchbuild', 'linkStory')) echo html::a(inlink('view', "buildID=$build->id&from=$from&type=story&link=true"), '<i class="icon-link"></i> ' . $lang->patchbuild->linkStory, '', "class='btn'");
    if(common::hasPriv('patchbuild', 'linkBug'))   echo html::a(inlink('view', "buildID=$build->id&from=$from&type=bug&link=true"), '<i class="icon-bug"></i> ' . $lang->patchbuild->linkBug, '', "class='btn'");
    echo '</div>';
    echo "<div class='btn-group'>";
    common::printIcon('patchbuild', 'editpatchbuild',   "buildID=$build->id&objectID=$objectID&from=$from", '','list', 'pencil', '', '', false, '', $lang->patchbuild->editpatchbuild);
    if ($from == 'project')
    {
      if(common::hasPriv('patchbuild', 'deletepatchbuild'))
      {
        common::printIcon('patchbuild', 'deletepatchbuild', "buildID=$build->id", '', 'list', 'remove', 'hiddenwin');
      }
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
        <?php $countStories = !empty($build->linkStories) ? count($build->linkStories) : 0; $countBugs = empty($build->linkBugs) ? 0 : count($build->linkBugs);?>
        <ul class='nav nav-tabs'>
          <li <?php if($type == 'story')  echo "class='active'"?>><a href='#stories' data-toggle='tab'><?php echo html::icon($lang->icons['story'], 'green') . ' ' . $lang->patchBuild->stories;?></a></li>
          <li <?php if($type == 'bug')    echo "class='active'"?>><a href='#bugs' data-toggle='tab'><?php echo html::icon($lang->icons['bug'], 'green') . ' ' . $lang->patchBuild->bugs;?></a></li>
          <li <?php if($type == 'detail') echo "class='active'"?>><a href='#detail' data-toggle='tab'><?php echo $lang->patchbuild->view ;?></a></li>
        </ul>
        <div class='tab-content'>
          <div class='tab-pane <?php if($type == 'story') echo 'active'?>' id='stories'>
            <?php if(common::hasPriv('patchbuild', 'linkStory')):?>
              <div class='action'><?php echo html::a("javascript:showLink($build->id, \"story\", from)", '<i class="icon-link"></i> ' . $lang->patchbuild->linkStory, '', "class='btn btn-sm btn-primary'");?></div>
              <div class='linkBox'></div>
            <?php endif;?>
            <form method='post' target='hiddenwin' action='<?php echo inlink('batchUnlinkStory', "buildID={$build->id}&from={$from}")?>' id='linkedStoriesForm'>
              <table class='table table-hover table-condensed table-striped tablesorter table-fixed table-selectable' id='storyList'>
                <thead>
                <tr>
                  <th class='w-id'><?php echo $lang->idAB;?></th>
                  <th class='w-pri'><?php echo $lang->priAB;?></th>
                  <th><?php echo $lang->story->title;?></th>
                  <th class='w-80px'>  <?php echo $lang->story->testDate;?></th>
                  <th class='w-user'><?php echo $lang->openedByAB;?></th>
                  <th class='w-hour'><?php echo $lang->story->estimateAB;?></th>
                  <th class='w-hour'><?php echo $lang->statusAB;?></th>
                  <th class='w-100px'><?php echo $lang->story->stageAB;?></th>
                  <th class='w-50px'><?php echo $lang->actions;?></th>
                </tr>
                </thead>
                <?php $canBatchUnlink = common::hasPriv('patchbuild', 'batchUnlinkStory');?>
                <?php foreach($build->linkStories as $storyID => $story):?>
                  <?php $storyLink = $this->createLink('story', 'view', "storyID=$story->id", '', true);?>
                  <tr class='text-center'>
                    <td class='cell-id'>
                      <?php if($canBatchUnlink):?>
                        <input type='checkbox' name='unlinkStories[]'  value='<?php echo $story->id;?>'/>
                      <?php endif;?>
                      <?php echo sprintf('%03d', $story->id);?>
                    </td>
                    <td><span class='<?php echo 'pri' . zget($lang->story->priList, $story->pri, $story->pri);?>'><?php echo zget($lang->story->priList, $story->pri, $story->pri);?></span></td>
                    <td class='text-left nobr' title='<?php echo $story->title?>'><?php echo html::a($storyLink,$story->title, '', "class='preview'");?></td>
                    <td><?php echo $story->testDate;?></td>
                    <td><?php echo $users[$story->openedBy];?></td>
                    <td><?php echo $story->estimate;?></td>
                    <td class='story-<?php echo $story->status;?>'><?php echo $lang->story->statusList[$story->status];?></td>
                    <td><?php echo $lang->story->stageList[$story->stage];?></td>
                    <td>
                      <?php
                      if(common::hasPriv('patchbuild', 'unlinkStory'))
                      {
                        $unlinkURL = inlink('unlinkStory', "buildID=$build->id&story=$story->id");
                        
                        echo html::a("javascript:ajaxDelete(\"$unlinkURL\",\"storyList\",confirmUnlinkStory)", '<i class="icon-unlink"></i>', '', "class='btn-icon' title='{$lang->patchbuild->unlinkStory}'");
                      }
                      ?>
                    </td>
                  </tr>
                <?php endforeach;?>
                <tfoot>
                <tr>
                  <td colspan='9'>
                    <div class='table-actions clearfix'>
                      <?php if($countStories and $canBatchUnlink) echo html::selectButton() . html::submitButton($lang->patchbuild->batchUnlinkStory);?>
                      <div class='text'><?php echo sprintf($lang->patchbuild->finishStories, $countStories);?></div>
                    </div>
                  </td>
                </tr>
                </tfoot>
              </table>
            </form>
          </div>
          <div class='tab-pane <?php if($type == 'bug') echo 'active'?>' id='bugs'>
            <?php if(common::hasPriv('patchbuild', 'linkBug')):?>
              <div class='action'><?php echo html::a("javascript:showLink($build->id, \"bug\", from)", '<i class="icon-bug"></i> ' . $lang->patchbuild->linkBug, '', "class='btn btn-sm btn-primary'");?></div>
              <div class='linkBox'></div>
            <?php endif;?>
            <form method='post' target='hiddenwin' action="<?php echo inLink('batchUnlinkBug', "build=$build->id&from=$from");?>" id='linkedBugsForm'>
              <table class='table table-hover table-condensed table-striped tablesorter table-fixed table-selectable' id='bugList'>
                <thead>
                <tr>
                  <th class='w-id'><?php echo $lang->idAB;?></th>
                  <th><?php echo $lang->bug->title;?></th>
                  <th class='w-100px'><?php echo $lang->bug->status;?></th>
                  <th class='w-user'><?php echo $lang->openedByAB;?></th>
                  <th class='w-date'><?php echo $lang->bug->openedDateAB;?></th>
                  <th class='w-user'><?php echo $lang->bug->resolvedByAB;?></th>
                  <th class='w-100px'><?php echo $lang->bug->resolvedDateAB;?></th>
                  <th class='w-50px'><?php echo $lang->actions;?></th>
                </tr>
                </thead>
                <?php $canBatchUnlink = common::hasPriv('patchbuild', 'batchUnlinkBug');?>
                <?php foreach($build->linkBugs as $bug):?>
                  <?php $bugLink = $this->createLink('bug', 'view', "bugID=$bug->id", '', true);?>
                  <tr class='text-center'>
                    <td class='cell-id'>
                      <?php if($canBatchUnlink):?>
                        <input type='checkbox' name='unlinkBugs[]'  value='<?php echo $bug->id;?>'/>
                      <?php endif;?>
                      <?php echo sprintf('%03d', $bug->id);?>
                    <td class='text-left nobr' title='<?php echo $bug->title?>'><?php echo html::a($bugLink, $bug->title, '', "class='preview'");?></td>
                    <td class='bug-<?php echo $bug->status?>'><?php echo $lang->bug->statusList[$bug->status];?></td>
                    <td><?php echo $users[$bug->openedBy];?></td>
                    <td><?php echo substr($bug->openedDate, 5, 11)?></td>
                    <td><?php echo $users[$bug->resolvedBy];?></td>
                    <td><?php echo substr($bug->resolvedDate, 5, 11)?></td>
                    <td>
                      <?php
                      if(common::hasPriv('patchbuild', 'unlinkBug'))
                      {
                        $unlinkURL = inlink('unlinkBug', "buildID=$build->id&bug=$bug->id");
                        echo html::a("javascript:ajaxDelete(\"$unlinkURL\",\"bugList\",confirmUnlinkBug)", '<i class="icon-unlink"></i>', '', "class='btn-icon' title='{$lang->patchbuild->unlinkBug}'");
                      }
                      ?>
                    </td>
                  </tr>
                <?php endforeach;?>
                <tfoot>
                <tr>
                  <td colspan='8'>
                    <div class='table-actions clearfix'>
                      <?php if($countBugs and $canBatchUnlink) echo html::selectButton() . html::submitButton($lang->patchbuild->batchUnlinkStory);?>
                      <div class='text'><?php echo sprintf($lang->patchbuild->resolvedBugs, $countBugs);?></div>
                    </div>
                  </td>
                </tr>
                </tfoot>
              </table>
            </form>
          </div>
          <div class='tab-pane <?php if($type == 'detail') echo 'active'?>' id='detail'>
            <br>
            <div class='tabs'>
              <fieldset>
                <legend><?php echo $lang->patchbuild->patchContent;?></legend>
                <div class='article-content'><?php echo $build->patchContent;?></div>
              </fieldset>
              <fieldset>
                <legend><?php echo $lang->patchbuild->influence;?></legend>
                <div class='article-content'><?php echo $build->influence;?></div>
              </fieldset>
              </fieldset>
              <fieldset>
                <legend><?php echo $lang->patchbuild->config;?></legend>
                <div class='article-content'><?php echo $build->config;?></div>
              </fieldset>
              </fieldset>
              <fieldset>
                <legend><?php echo $lang->patchbuild->notice;?></legend>
                <div class='article-content'><?php echo $build->notice;?></div>
              </fieldset>
            </div>
            <fieldset>
              <legend><?php echo $lang->patchbuild->testPass;?></legend>
              <div class='article-content'><?php echo $lang->patchbuild->testPassList[$build->testPass];?></div>
              <br/>
              <div class='article-content'><?php echo $build->testComment;?></div>
            </fieldset>
            <fieldset>
              <legend><?php echo $lang->patchbuild->testEnv;?></legend>
              <div class='article-content'><?php echo $lang->patchbuild->testEnvList[$build->testEnv];?></div>
              <br/>
              <div class='article-content'><?php echo $build->testEnvComment;?></div>
            </fieldset>
           <?php include '../../common/view/action.html.php';?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='col-side'>
    <div class='main-side main'>
      <fieldset>
        <legend><?php echo $lang->patchbuild->basicInfo?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->patchbuild->product;?></th>
            <td><?php echo $build->productName;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->patchbuild->project;?></th>
            <td><?php echo $build->projectName;?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->patchbuild->workSeason;?></th>
            <td><?php echo $lang->patchbuild->workSeasonList[$build->workSeason];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->patchbuild->patchType;?></th>
            <td><?php echo $lang->patchbuild->patchTypeList[$build->patchType];?></td>
          </tr>
          <tr>
            <th class='w-80px'><?php echo $lang->patchbuild->platform;?></th>
            <td><?php echo $lang->patchbuild->platformList[$build->platform];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->reason;?></th>
            <td><?php echo $lang->patchbuild->reasonList[$build->reason];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->submitter;?></th>
            <td><?php echo $users[$build->submitter];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->group;?></th>
            <td><?php echo $lang->patchbuild->groupList[$build->group];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->releasedDate;?></th>
            <td><?php echo $build->releasedDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->patchDate;?></th>
            <td><?php echo $build->patchDate;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->assignedTo;?></th>
            <td><?php echo $users[$build->assignedTo];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->mailto;?></th>
            <td><?php $mailto = explode(',', str_replace(' ', '', $build->mailto)); foreach($mailto as $account) echo ' ' . zget($users, $account, $account);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->svnPath;?></th>
            <td style='word-break:break-all;'><?php echo html::a($build->svnPath, $build->svnPath, '_blank')?></td>
          </tr>  
          <tr>
            <th><?php echo $lang->patchbuild->patchProgram;?></th>
            <td style='word-break:break-all;'><?php echo $build->patchProgram;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->patchbuild->versionDeploy;?></th>
            <td><?php echo !empty($build->versionDeploy) ? $lang->patchbuild->versionDeployList[$build->versionDeploy] : '';?></td>
          </tr>
        </table>
      </fieldset>
    </div>
  </div>
</div>
<?php js::set('param', helper::safe64Decode($param))?>
<?php js::set('link', $link)?>
<?php js::set('from', $from)?>
<?php js::set('buildID', $build->id)?>
<?php js::set('type', $type)?>
<?php include '../../common/view/footer.html.php';?>
