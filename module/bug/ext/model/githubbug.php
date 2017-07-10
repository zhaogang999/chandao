<?php

/**
 * Update a bug.
 *
 * @param  int    $bugID
 * @access public
 * @return void
 */
public function update($bugID)
{
    $oldBug = $this->getById($bugID);
    if(isset($_POST['lastEditedDate']) and $oldBug->lastEditedDate != $this->post->lastEditedDate)
    {
        dao::$errors[] = $this->lang->error->editedByOther;
        return false;
    }

    $now = helper::now();
    $bug = fixer::input('post')
        ->cleanInt('product,module,severity,project,story,task')
        ->stripTags($this->config->bug->editor->edit['id'], $this->config->allowedTags)
        ->setDefault('project,module,project,story,task,duplicateBug,branch', 0)
        ->setDefault('openedBuild', '')
        ->setDefault('plan', 0)
        ->setDefault('deadline', '0000-00-00')
        ->add('lastEditedBy',   $this->app->user->account)
        ->add('lastEditedDate', $now)
        ->join('openedBuild', ',')
        ->join('mailto', ',')
        ->setIF($this->post->assignedTo  != $oldBug->assignedTo, 'assignedDate', $now)
        ->setIF($this->post->resolvedBy  != '' and $this->post->resolvedDate == '', 'resolvedDate', $now)
        ->setIF($this->post->resolution  != '' and $this->post->resolvedDate == '', 'resolvedDate', $now)
        ->setIF($this->post->resolution  != '' and $this->post->resolvedBy   == '', 'resolvedBy',   $this->app->user->account)
        ->setIF($this->post->closedBy    != '' and $this->post->closedDate   == '', 'closedDate',   $now)
        ->setIF($this->post->closedDate  != '' and $this->post->closedBy     == '', 'closedBy',     $this->app->user->account)
        ->setIF($this->post->closedBy    != '' or  $this->post->closedDate   != '', 'assignedTo',   'closed')
        ->setIF($this->post->closedBy    != '' or  $this->post->closedDate   != '', 'assignedDate', $now)
        ->setIF($this->post->resolution  != '' or  $this->post->resolvedDate != '', 'status',       'resolved')
        ->setIF($this->post->closedBy    != '' or  $this->post->closedDate   != '', 'status',       'closed')
        ->setIF(($this->post->resolution != '' or  $this->post->resolvedDate != '') and $this->post->assignedTo == '', 'assignedTo', $oldBug->openedBy)
        ->setIF(($this->post->resolution != '' or  $this->post->resolvedDate != '') and $this->post->assignedTo == '', 'assignedDate', $now)
        ->setIF($this->post->resolution  == '' and $this->post->resolvedDate =='', 'status', 'active')
        ->setIF($this->post->resolution  != '', 'confirmed', 1)
        ->setIF($this->post->story != false and $this->post->story != $oldBug->story, 'storyVersion', $this->loadModel('story')->getVersion($this->post->story))
        ->remove('comment,files,labels,uid')
        ->get();

    $bug = $this->loadModel('file')->processEditor($bug, $this->config->bug->editor->edit['id'], $this->post->uid);

    $this->dao->update(TABLE_BUG)->data($bug)
        ->autoCheck()
        ->batchCheck($this->config->bug->edit->requiredFields, 'notempty')
        ->checkIF($bug->resolvedBy, 'resolution', 'notempty')
        ->checkIF($bug->closedBy,   'resolution', 'notempty')
        ->checkIF($bug->resolution == 'duplicate', 'duplicateBug', 'notempty')
        ->where('id')->eq((int)$bugID)
        ->exec();

    if(!dao::isError())
    {
        $this->file->updateObjectID($this->post->uid, $bugID, 'bug');
        if ($oldBug->github != 0 and $bug->title != $oldBug->title or $bug->steps != $oldBug->steps or $bug->assignTo != $oldBug->assignTo or $oldBug->status != $bug->status)
        {
            $this->loadModel('github');
            //$this->github->edit($oldBug, $bug, 'bug');
        }
        return common::createChanges($oldBug, $bug);
    }
}

/**
 * Batch update bugs.
 *
 * @access public
 * @return array
 */
public function batchUpdate()
{
    $bugs       = array();
    $allChanges = array();
    $now        = helper::now();
    $data       = fixer::input('post')->get();
    $bugIDList  = $this->post->bugIDList ? $this->post->bugIDList : array();

    if(!empty($bugIDList))
    {
        /* Process the data if the value is 'ditto'. */
        foreach($bugIDList as $bugID)
        {
            if($data->types[$bugID]       == 'ditto') $data->types[$bugID]       = isset($prev['type'])       ? $prev['type']       : '';
            if($data->severities[$bugID]  == 'ditto') $data->severities[$bugID]  = isset($prev['severity'])   ? $prev['severity']   : 3;
            if($data->pris[$bugID]        == 'ditto') $data->pris[$bugID]        = isset($prev['pri'])        ? $prev['pri']        : 0;
            if($data->plans[$bugID]       == 'ditto') $data->plans[$bugID]       = isset($prev['plan'])       ? $prev['plan'] : '';
            if($data->assignedTos[$bugID] == 'ditto') $data->assignedTos[$bugID] = isset($prev['assignedTo']) ? $prev['assignedTo'] : '';
            if($data->resolvedBys[$bugID] == 'ditto') $data->resolvedBys[$bugID] = isset($prev['resolvedBy']) ? $prev['resolvedBy'] : '';
            if($data->resolutions[$bugID] == 'ditto') $data->resolutions[$bugID] = isset($prev['resolution']) ? $prev['resolution'] : '';
            if($data->os[$bugID]          == 'ditto') $data->os[$bugID]          = isset($prev['os'])         ? $prev['os'] : '';
            if($data->browsers[$bugID]    == 'ditto') $data->browsers[$bugID]    = isset($prev['browser'])    ? $prev['browser'] : '';

            $prev['type']       = $data->types[$bugID];
            $prev['severity']   = $data->severities[$bugID];
            $prev['pri']        = $data->pris[$bugID];
            $prev['plan']       = $data->plans[$bugID];
            $prev['assignedTo'] = $data->assignedTos[$bugID];
            $prev['resolvedBy'] = $data->resolvedBys[$bugID];
            $prev['resolution'] = $data->resolutions[$bugID];
            $prev['os']         = $data->os[$bugID];
            $prev['browser']    = $data->browsers[$bugID];
        }

        /* Initialize bugs from the post data.*/
        foreach($bugIDList as $bugID)
        {
            $oldBug = $this->getByID($bugID);

            $bug = new stdclass();
            $bug->lastEditedBy   = $this->app->user->account;
            $bug->lastEditedDate = $now;
            $bug->type           = $data->types[$bugID];
            $bug->severity       = $data->severities[$bugID];
            $bug->pri            = $data->pris[$bugID];
            $bug->status         = $data->statuses[$bugID];
            $bug->color          = $data->colors[$bugID];
            $bug->title          = $data->titles[$bugID];
            $bug->plan           = empty($data->plans[$bugID]) ? 0 : $data->plans[$bugID];
            $bug->assignedTo     = $data->assignedTos[$bugID];
            $bug->deadline       = $data->deadlines[$bugID];
            $bug->resolvedBy     = $data->resolvedBys[$bugID];
            $bug->keywords       = $data->keywords[$bugID];
            $bug->os             = $data->os[$bugID];
            $bug->browser        = $data->browsers[$bugID];
            $bug->resolution     = $data->resolutions[$bugID];
            $bug->duplicateBug   = $data->duplicateBugs[$bugID] ? $data->duplicateBugs[$bugID] : $oldBug->duplicateBug;

            if($bug->assignedTo  != $oldBug->assignedTo)           $bug->assignedDate = $now;
            if(($bug->resolvedBy != '' or $bug->resolution != '') and $oldBug->status != 'resolved') $bug->resolvedDate = $now;
            if($bug->resolution  != '' and $bug->resolvedBy == '') $bug->resolvedBy   = $this->app->user->account;
            if($bug->resolution  != '' and $bug->status != 'closed')
            {
                $bug->status    = 'resolved';
                $bug->confirmed = 1;
            }
            if($bug->resolution  != '' and $bug->assignedTo == '')
            {
                $bug->assignedTo   = $oldBug->openedBy;
                $bug->assignedDate = $now;
            }

            $bugs[$bugID] = $bug;
            unset($bug);
        }

        /* Update bugs. */
        foreach($bugs as $bugID => $bug)
        {
            $oldBug = $this->getByID($bugID);

            $this->dao->update(TABLE_BUG)->data($bug)
                ->autoCheck()
                ->batchCheck($this->config->bug->edit->requiredFields, 'notempty')
                ->checkIF($bug->resolvedBy, 'resolution', 'notempty')
                ->checkIF($bug->resolution == 'duplicate', 'duplicateBug', 'notempty')
                ->where('id')->eq((int)$bugID)
                ->exec();

            if(!dao::isError())
            {
                $allChanges[$bugID] = common::createChanges($oldBug, $bug);
            }
            else
            {
                die(js::error('bug#' . $bugID . dao::getError(true)));
            }
        }
    }

    return $allChanges;
}
