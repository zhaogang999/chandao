<?php
/**
 * Print cell data.
 *
 * @param object $col
 * @param object $task
 * @param array  $users
 * @param string $browseType
 * @param array  $branchGroups
 * @param array  $modulePairs
 * @param string $mode
 * @param bool   $child
 *
 * @access public
 * @return void
 */
public function printCell($col, $task, $users, $browseType, $branchGroups, $modulePairs = array(), $mode = 'datatable', $child = false)
{
    $canView  = common::hasPriv('task', 'view');
    $taskLink = helper::createLink('task', 'view', "taskID=$task->id");
    $account  = $this->app->user->account;
    $id       = $col->id;
    if($col->show)
    {
        $class = '';
        if($id == 'status') $class .= ' task-' . $task->status;
        if($id == 'id')     $class .= ' cell-id';
        if($id == 'name' or $id == 'story') $class .= ' text-left';
        if($id == 'deadline' and isset($task->delay)) $class .= ' delayed';
        if($id == 'assignedTo' && $task->assignedTo == $account) $class .= ' red';

        $title = '';
        if($id == 'name')  $title = " title='{$task->name}'";
        if($id == 'story') $title = " title='{$task->storyTitle}'";

        echo "<td class='" . $class . "'" . $title . ">";
        switch($id)
        {
            case 'id':
                if($mode == 'table') echo "<input type='checkbox' name='taskIDList[{$task->id}]' value='{$task->id}'/> ";
                echo $canView ? html::a($taskLink, sprintf('%03d', $task->id)) : sprintf('%03d', $task->id);
                break;
            case 'pri':
                echo "<span class='pri" . zget($this->lang->task->priList, $task->pri, $task->pri) . "'>";
                echo $task->pri == '0' ? '' : zget($this->lang->task->priList, $task->pri, $task->pri);
                echo "</span>";
                break;
            case 'name':
                if(!empty($task->product) && isset($branchGroups[$task->product][$task->branch])) echo "<span class='label label-info label-badge'>" . $branchGroups[$task->product][$task->branch] . '</span> ';
                if($task->module and isset($modulePairs[$task->module])) echo "<span class='label label-info label-badge'>" . $modulePairs[$task->module] . '</span> ';
                if($child) echo '<span class="label">' . $this->lang->task->childrenAB . '</span> ';
                if(!empty($task->team)) echo '<span class="label">' . $this->lang->task->multipleAB . '</span> ';
                echo $canView ? html::a($taskLink, $task->name, null, "style='color: $task->color'") : "<span style='color: $task->color'>$task->name</span>";
                if($task->fromBug) echo html::a(helper::createLink('bug', 'view', "id=$task->fromBug"), "[BUG#$task->fromBug]", '_blank', "class='bug'");
                if(!empty($task->children)) echo '<span class="task-toggle" data-id="' . $task->id . '">&nbsp;&nbsp;<i class="icon icon-double-angle-up"></i>&nbsp;&nbsp;</span>';
                break;
            case 'type':
                echo $this->lang->task->typeList[$task->type];
                break;
            //在任务列表页面增加关键字字段
            case 'keywords':
                echo $task->keywords;
                break;
            //在任务列表页面增加任务关联需求的所属字段
            case 'plan':
                echo $task->plan;
                break;

            case 'status':
                $storyChanged = (!empty($task->storyStatus) and $task->storyStatus == 'active' and $task->latestStoryVersion > $task->storyVersion);
                $storyChanged ? print("<span class='warning'>{$this->lang->story->changed}</span> ") : print($this->lang->task->statusList[$task->status]);
                break;
            case 'estimate':
                echo round($task->estimate, 1);
                break;
            case 'consumed':
                echo round($task->consumed, 1);
                break;
            case 'left':
                echo round($task->left, 1);
                break;
            case 'progress':
                echo "{$task->progress}%";
                break;
            case 'deadline':
                if(substr($task->deadline, 0, 4) > 0) echo substr($task->deadline, 5, 6);
                break;
            case 'openedBy':
                echo zget($users, $task->openedBy);
                break;
            case 'openedDate':
                echo substr($task->openedDate, 5, 11);
                break;
            case 'estStarted':
                echo $task->estStarted;
                break;
            case 'realStarted':
                echo $task->realStarted;
                break;
            case 'assignedTo':
                echo zget($users, $task->assignedTo);
                break;
            case 'assignedDate':
                echo substr($task->assignedDate, 5, 11);
                break;
            case 'finishedBy':
                echo zget($users, $task->finishedBy);
                break;
            case 'finishedDate':
                echo substr($task->finishedDate, 5, 11);
                break;
            case 'canceledBy':
                echo zget($users, $task->canceledBy);
                break;
            case 'canceledDate':
                echo substr($task->canceledDate, 5, 11);
                break;
            case 'closedBy':
                echo zget($users, $task->closedBy);
                break;
            case 'closedDate':
                echo substr($task->closedDate, 5, 11);
                break;
            case 'closedReason':
                echo $this->lang->task->reasonList[$task->closedReason];
                break;
            case 'story':
                if(!empty($task->storyID))
                {
                    if(!common::printLink('story', 'view', "storyid=$task->storyID", $task->storyTitle)) echo $task->storyTitle;
                }
                break;
            case 'mailto':
                $mailto = explode(',', $task->mailto);
                foreach($mailto as $account)
                {
                    $account = trim($account);
                    if(empty($account)) continue;
                    echo zget($users, $account) . ' &nbsp;';
                }
                break;
            case 'lastEditedBy':
                echo zget($users, $task->lastEditedBy);
                break;
            case 'lastEditedDate':
                echo substr($task->lastEditedDate, 5, 11);
                break;
            case 'actions':
                common::printIcon('task', 'assignTo', "projectID=$task->project&taskID=$task->id", $task, 'list', '', '', 'iframe', true);
                common::printIcon('task', 'start',    "taskID=$task->id", $task, 'list', '', '', 'iframe', true);

                common::printIcon('task', 'recordEstimate', "taskID=$task->id", $task, 'list', 'time', '', 'iframe', true);
                if($browseType == 'needconfirm')
                {
                    $this->lang->task->confirmStoryChange = $this->lang->confirm;
                    common::printIcon('task', 'confirmStoryChange', "taskid=$task->id", '', 'list', '', 'hiddenwin');
                }
                common::printIcon('task', 'finish', "taskID=$task->id", $task, 'list', '', '', 'iframe', true);
                common::printIcon('task', 'close',  "taskID=$task->id", $task, 'list', '', '', 'iframe', true);
                common::printIcon('task', 'edit',   "taskID=$task->id", $task, 'list');
                if(empty($task->team) or empty($task->children))
                {
                    common::printIcon('task', 'batchCreate', "project=$task->project&storyID=$task->story&moduleID=$task->module&taskID=$task->id", $task, 'list', 'plus', '', '', '', '', $this->lang->task->children);
                }
                break;
        }
        echo '</td>';
    }
}
