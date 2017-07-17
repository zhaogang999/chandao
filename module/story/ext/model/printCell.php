<?php
/**
 * Print cell data
 *
 * @param  object $col
 * @param  object $story
 * @param  array  $users
 * @param  array  $branches
 * @param  array  $storyStages
 * @param  array  $modulePairs
 * @param  array  $storyTasks
 * @param  array  $storyBugs
 * @param  array  $storyCases
 * @access public
 * @return void
 */
public function printCell($col, $story, $users, $branches, $storyStages, $modulePairs = array(), $storyTasks, $storyBugs, $storyCases)
{
    $storyLink = helper::createLink('story', 'view', "storyID=$story->id");
    $account   = $this->app->user->account;
    $id        = $col->id;
    if($col->show)
    {
        $class = '';
        if($id == 'status') $class .= ' story-' . $story->status;
        if($id == 'title') $class .= ' text-left';
        if($id == 'assignedTo' && $story->assignedTo == $account) $class .= ' red';

        $title = '';
        if($id == 'title') $title = $story->title;
        if($id == 'plan')  $title = $story->planTitle;

        echo "<td class='" . $class . "' title='$title'>";
        switch ($id)
        {
            case 'id':
                echo html::a($storyLink, sprintf('%03d', $story->id));
                break;
            case 'pri':
                echo "<span class='pri" . zget($this->lang->story->priList, $story->pri, $story->pri) . "'>";
                echo zget($this->lang->story->priList, $story->pri, $story->pri);
                echo "</span>";
                break;
            case 'title':
                if($story->branch) echo "<span class='label label-info label-badge'>{$branches[$story->branch]}</span> ";
                if($modulePairs and $story->module) echo "<span class='label label-info label-badge'>{$modulePairs[$story->module]}</span> ";
                echo html::a($storyLink, $story->title, null, "style='color: $story->color'");
                break;
            case 'plan':
                echo $story->planTitle;
                break;
            case 'branch':
                echo $branches[$story->branch];
                break;
            //1522 增加产品需求所关联的需求和已细分需求的显示
            case 'childStories':
                echo $story->childStories;
                break;
            case 'linkStories':
                echo $story->linkStories;
                break;
            
            case 'source':
                echo zget($this->lang->story->sourceList, $story->source, $story->source);
                break;
            case 'status':
                echo $this->lang->story->statusList[$story->status];
                break;
            case 'estimate':
                echo $story->estimate;
                break;
            case 'stage':
                echo "<div" . (isset($storyStages[$story->id]) ? " class='popoverStage' data-toggle='popover' data-placement='bottom' data-target='\$next'" : '') . "'>";
                echo $this->lang->story->stageList[$story->stage];
                if(isset($storyStages[$story->id])) echo "<span><i class='icon icon-caret-down'></i></span>";
                echo '</div>';
                if(isset($storyStages[$story->id]))
                {
                    echo "<div class='popover'>";
                    foreach($storyStages[$story->id] as $storyBranch => $storyStage) echo $branches[$storyBranch] . ": " . $this->lang->story->stageList[$storyStage->stage] . '<br />';
                    echo "</div>";
                }
                break;
            case 'taskCount':
                $tasksLink = helper::createLink('story', 'tasks', "storyID=$story->id");
                $storyTasks[$story->id] > 0 ? print(html::a($tasksLink, $storyTasks[$story->id], '', 'class="iframe"')) : print(0);
                break;
            case 'bugCount':
                $bugsLink = helper::createLink('story', 'bugs', "storyID=$story->id");
                $storyBugs[$story->id] > 0 ? print(html::a($bugsLink, $storyBugs[$story->id], '', 'class="iframe"')) : print(0);
                break;
            case 'caseCount':
                $casesLink = helper::createLink('story', 'cases', "storyID=$story->id");
                $storyCases[$story->id] > 0 ? print(html::a($casesLink, $storyCases[$story->id], '', 'class="iframe"')) : print(0);
                break;
            case 'openedBy':
                echo zget($users, $story->openedBy, $story->openedBy);
                break;
            case 'openedDate':
                echo substr($story->openedDate, 5, 11);
                break;
            case 'assignedTo':
                echo zget($users, $story->assignedTo, $story->assignedTo);
                break;
            case 'assignedDate':
                echo substr($story->assignedDate, 5, 11);
                break;
            case 'reviewedBy':
                echo zget($users, $story->reviewedBy, $story->reviewedBy);
                break;
            case 'reviewedDate':
                echo substr($story->reviewedDate, 5, 11);
                break;
            case 'closedBy':
                echo zget($users, $story->closedBy, $story->closedBy);
                break;
            case 'closedDate':
                echo substr($story->closedDate, 5, 11);
                break;
            case 'closedReason':
                echo zget($this->lang->story->reasonList, $story->closedReason, $story->closedReason);
                break;
            case 'actions':
                $vars = "story={$story->id}";
                common::printIcon('story', 'change',     $vars, $story, 'list', 'random');
                common::printIcon('story', 'review',     $vars, $story, 'list', 'review');
                common::printIcon('story', 'close',      $vars, $story, 'list', 'off', '', 'iframe', true);
                common::printIcon('story', 'edit',       $vars, $story, 'list', 'pencil');
                if($this->config->global->flow != 'onlyStory') common::printIcon('story', 'createCase', "productID=$story->product&branch=$story->branch&module=0&from=&param=0&$vars", $story, 'list', 'sitemap');
                break;
        }
        echo '</td>';
    }
}
