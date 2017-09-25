<?php
/**
 * Print cell data.
 *
 * @param  object $col
 * @param  object $bug
 * @param  array  $users
 * @param  array  $builds
 * @param  array  $branches
 * @access public
 * @return void
 */
public function printCell($col, $bug, $users, $builds, $branches, $modulePairs)
{
    $bugLink = inlink('view', "bugID=$bug->id");
    $account = $this->app->user->account;
    $id = $col->id;
    if($col->show)
    {
        $class = '';
        if($id == 'status') $class .= ' bug-' . $bug->status;
        if($id == 'title') $class .= ' text-left';
        if($id == 'assignedTo' && $bug->assignedTo == $account) $class .= ' red';
        if($id == 'deadline' && isset($bug->delay)) $class .= ' delayed';

        echo "<td class='" . $class . "'" . ($id=='title' ? " title='{$bug->title}'" : '') . ">";
        switch ($id)
        {
            case 'id':
                echo html::a($bugLink, sprintf('%03d', $bug->id));
                break;
            case 'severity':
                echo "<span class='severity" . zget($this->lang->bug->severityList, $bug->severity, $bug->severity) . "'>";
                echo zget($this->lang->bug->severityList, $bug->severity, $bug->severity);
                echo "</span>";
                break;
            case 'pri':
                echo "<span class='pri" . zget($this->lang->bug->priList, $bug->pri, $bug->pri) . "'>";
                echo zget($this->lang->bug->priList, $bug->pri, $bug->pri);
                echo "</span>";
                break;
            case 'title':
                $class = 'confirm' . $bug->confirmed;
                echo "<span class='$class'>[{$this->lang->bug->confirmedList[$bug->confirmed]}]</span> ";
                if($bug->branch)echo "<span class='label label-info label-badge'>{$branches[$bug->branch]}</span> ";
                if($modulePairs and $bug->module)echo "<span class='label label-info label-badge'>{$modulePairs[$bug->module]}</span> ";
                echo html::a($bugLink, $bug->title, null, "style='color: $bug->color'");
                break;

            //2061 提bug页面增加一个字段“发现阶段”，该字段需要支持后续搜索
            case 'discoveryPhase':
                echo $this->lang->bug->discoveryPhaseList[$bug->discoveryPhase];
                break;
            
            case 'branch':
                echo $branches[$bug->branch];
                break;
            case 'type':
                echo zget($this->lang->bug->typeList, $bug->type);
                break;
            case 'status':
                echo zget($this->lang->bug->statusList, $bug->status);
                break;
            case 'activatedCount':
                echo $bug->activatedCount;
                break;
            case 'openedBy':
                echo zget($users, $bug->openedBy);
                break;
            case 'openedDate':
                echo substr($bug->openedDate, 5, 11);
                break;
            case 'openedBuild':
                foreach(explode(',', $bug->openedBuild) as $build) echo zget($builds, $build) . '<br />';
                break;
            case 'assignedTo':
                echo zget($users, $bug->assignedTo, $bug->assignedTo);
                break;
            case 'assignedDate':
                echo substr($bug->assignedDate, 5, 11);
                break;
            case 'deadline':
                echo $bug->deadline;
                break;
            case 'resolvedBy':
                echo zget($users, $bug->resolvedBy, $bug->resolvedBy);
                break;
            case 'resolution':
                echo zget($this->lang->bug->resolutionList, $bug->resolution);
                break;
            case 'resolvedDate':
                echo substr($bug->resolvedDate, 5, 11);
                break;
            case 'resolvedBuild':
                echo $bug->resolvedBuild;
                break;
            case 'closedBy':
                echo zget($users, $bug->closedBy);
                break;
            case 'lastEditedDate':
                echo substr($bug->lastEditedDate, 5, 11);
                break;
            case 'closedDate':
                echo substr($bug->closedDate, 5, 11);
                break;
            case 'actions':
                $params = "bugID=$bug->id";
                common::printIcon('bug', 'confirmBug', $params, $bug, 'list', 'search', '', 'iframe', true);
                common::printIcon('bug', 'assignTo',   $params, '',   'list', '', '', 'iframe', true);
                common::printIcon('bug', 'resolve',    $params, $bug, 'list', '', '', 'iframe', true);
                common::printIcon('bug', 'close',      $params, $bug, 'list', '', '', 'iframe', true);
                common::printIcon('bug', 'edit',       $params, $bug, 'list');
                common::printIcon('bug', 'create',     "product=$bug->product&branch=$bug->branch&extra=bugID=$bug->id", $bug, 'list', 'copy');
                break;
        }
        echo '</td>';
    }
}
