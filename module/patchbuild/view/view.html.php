<?php
/**
 * The view file of patchbuild module's view method of ZenTaoPMS.
 *
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
    <span class='prefix'><?php echo html::icon($lang->icons['build']);?> <strong><?php echo $build->id;?></strong></span>
    <strong><?php echo $build->version;?></strong>
    <?php if($build->deleted):?>
    <span class='label label-danger'><?php echo $lang->build->deleted;?></span>
    <?php endif; ?>
  </div>
  <div class='actions'>
  <?php
  $browseLink = $this->session->patchbuildList ? $this->session->patchbuildList : $this->createLink('patchBuild', 'patchBuild', "objectID=$objectID&from=$from");
  if(!$build->deleted)
  {
      echo "<div class='btn-group'>";
      common::printIcon('patchbuild', 'editPatchBuild',   "buildID=$build->id&objectID=$objectID&from=$from", '','list', 'pencil', '', '', false, '', $lang->patchbuild->editpatchbuild);
      echo '</div>';

      if ($from == 'project')
      {
        echo "<div class='btn-group'>";

        if(common::hasPriv('patchbuild', 'deletePatchBuild'))
        {
          common::printIcon('patchbuild', 'deletePatchBuild', "buildID=$build->id", '', 'list', 'remove', 'hiddenwin');
        }

        echo '</div>';
      }
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
    </div>
    <?php include '../../common/view/action.html.php';?>
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
        </table>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->patchbuild->linkStoriesAndBugs?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr class='text-top'>
            <th class='w-80px'><?php echo $lang->patchbuild->linkStories;?></th>
            <td>
              <ul class='list-unstyled'>
                <?php
                if (!empty($build->linkStories))
                {
                  foreach($build->linkStories as $storyID => $storyTitle)
                  {
                    echo '<li>' . html::a($this->createLink('story', 'view', "storyID=$storyID"), '#' . $storyID. ' ' . $storyTitle) . '</li>';
                  }
                }
                ?>
              </ul>
            </td>
          </tr>
          <tr class='text-top'>
            <th class='w-80px'><?php echo $lang->patchbuild->linkBugs;?></th>
            <td>
              <ul class='list-unstyled'>
                <?php
                if (!empty($build->linkBugs))
                {
                  foreach($build->linkBugs as $bugID => $bugTitle)
                  {
                    echo '<li>' . html::a($this->createLink('bug', 'view', "bugID=$bugID"), '#' . $bugID. ' ' . $bugTitle) . '</li>';
                  }
                }
                ?>
              </ul>
            </td>
          </tr>
        </table>
      </fieldset>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
