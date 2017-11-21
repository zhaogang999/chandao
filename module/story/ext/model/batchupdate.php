<?php
/**
 * Batch update stories.
 *
 * @access public
 * @return array.
 */
public function batchUpdate()
{
    /* Init vars. */
    $stories     = array();
    $allChanges  = array();
    $now         = helper::now();
    $data        = fixer::input('post')->get();
    $storyIDList = $this->post->storyIDList ? $this->post->storyIDList : array();

    /* Init $stories. */
    if(!empty($storyIDList))
    {
        $oldStories = $this->getByList($storyIDList);

        /* Process the data if the value is 'ditto'. */
        foreach($storyIDList as $storyID)
        {
            if($data->pris[$storyID]     == 'ditto') $data->pris[$storyID]     = isset($prev['pri'])    ? $prev['pri']    : 0;
            if($data->branches[$storyID] == 'ditto') $data->branches[$storyID] = isset($prev['branch']) ? $prev['branch'] : 0;
            if($data->modules[$storyID]  == 'ditto') $data->modules[$storyID]  = isset($prev['module']) ? $prev['module'] : 0;
            if($data->plans[$storyID]    == 'ditto') $data->plans[$storyID]    = isset($prev['plan'])   ? $prev['plan']   : 0;
            if($data->sources[$storyID]  == 'ditto') $data->sources[$storyID]  = isset($prev['source']) ? $prev['source'] : '';
            if(isset($data->stages[$storyID])        and ($data->stages[$storyID]        == 'ditto')) $data->stages[$storyID]        = isset($prev['stage'])        ? $prev['stage']        : '';
            if(isset($data->closedBys[$storyID])     and ($data->closedBys[$storyID]     == 'ditto')) $data->closedBys[$storyID]     = isset($prev['closedBy'])     ? $prev['closedBy']     : '';
            if(isset($data->closedReasons[$storyID]) and ($data->closedReasons[$storyID] == 'ditto')) $data->closedReasons[$storyID] = isset($prev['closedReason']) ? $prev['closedReason'] : '';

            $prev['pri']    = $data->pris[$storyID];
            $prev['branch'] = isset($data->branches[$storyID]) ? $data->branches[$storyID] : 0;
            $prev['module'] = $data->modules[$storyID];
            $prev['plan']   = $data->plans[$storyID];
            $prev['source'] = $data->sources[$storyID];
            if(isset($data->stages[$storyID]))        $prev['stage']        = $data->stages[$storyID];
            if(isset($data->closedBys[$storyID]))     $prev['closedBy']     = $data->closedBys[$storyID];
            if(isset($data->closedReasons[$storyID])) $prev['closedReason'] = $data->closedReasons[$storyID];
        }

        foreach($storyIDList as $storyID)
        {
            $oldStory = $oldStories[$storyID];

            $story                 = new stdclass();
            $story->lastEditedBy   = $this->app->user->account;
            $story->lastEditedDate = $now;
            $story->status         = $oldStory->status;
            $story->color          = $data->colors[$storyID];
            $story->title          = $data->titles[$storyID];
            $story->estimate       = $data->estimates[$storyID];
            $story->pri            = $data->pris[$storyID];
            //需求可以指派给多人
            $story->assignedTo     = trim(implode(',', $data->assignedTo[$storyID]), ',');
            
            $story->assignedDate   = $oldStory == $data->assignedTo[$storyID] ? $oldStory->assignedDate : $now;
            $story->branch         = isset($data->branches[$storyID]) ? $data->branches[$storyID] : 0;
            $story->module         = $data->modules[$storyID];
            $story->plan           = $data->plans[$storyID];
            $story->source         = $data->sources[$storyID];
            $story->keywords       = $data->keywords[$storyID];
            $story->stage          = isset($data->stages[$storyID])             ? $data->stages[$storyID]             : $oldStory->stage;
            $story->closedBy       = isset($data->closedBys[$storyID])          ? $data->closedBys[$storyID]          : $oldStory->closedBy;
            $story->closedReason   = isset($data->closedReasons[$storyID])      ? $data->closedReasons[$storyID]      : $oldStory->closedReason;
            $story->duplicateStory = isset($data->duplicateStories[$storyID])   ? $data->duplicateStories[$storyID]   : $oldStory->duplicateStory;
            $story->childStories   = isset($data->childStoriesIDList[$storyID]) ? $data->childStoriesIDList[$storyID] : $oldStory->childStories;
            $story->version        = $story->title == $oldStory->title ? $oldStory->version : $oldStory->version + 1;

            if($story->title        != $oldStory->title)                         $story->status     = 'changed';
            if($story->plan         !== false and $story->plan == '')            $story->plan       = 0;
            if($story->closedBy     != false  and $oldStory->closedDate == '')   $story->closedDate = $now;
            if($story->closedReason != false  and $oldStory->closedDate == '')   $story->closedDate = $now;
            if($story->closedBy     != false  or  $story->closedReason != false) $story->status     = 'closed';
            if($story->closedReason != false  and $story->closedBy     == false) $story->closedBy   = $this->app->user->account;

            $stories[$storyID] = $story;
        }

        foreach($stories as $storyID => $story)
        {
            $oldStory = $oldStories[$storyID];

            $this->dao->update(TABLE_STORY)->data($story)
                ->autoCheck()
                ->checkIF($story->closedBy, 'closedReason', 'notempty')
                ->checkIF($story->closedReason == 'done', 'stage', 'notempty')
                ->checkIF($story->closedReason == 'duplicate',  'duplicateStory', 'notempty')
                ->where('id')->eq((int)$storyID)
                ->exec();
            if($story->title != $oldStory->title)
            {
                $data          = new stdclass();
                $data->story   = $storyID;
                $data->version = $story->version;
                $data->title   = $story->title;
                $data->spec    = $oldStory->spec;
                $data->verify  = $oldStory->verify;
                $this->dao->insert(TABLE_STORYSPEC)->data($data)->exec();
            }

            if(!dao::isError())
            {
                $allChanges[$storyID] = common::createChanges($oldStory, $story);
            }
            else
            {
                die(js::error('story#' . $storyID . dao::getError(true)));
            }
        }
    }

    if(!dao::isError()) $this->loadModel('score')->create('ajax', 'batchEdit');
    return $allChanges;
}
