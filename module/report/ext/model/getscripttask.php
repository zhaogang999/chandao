<?php
/**
 * Get patchBuilds of a project.
 *
 * @param  string    $orderBy
 * @param  string    $type
 * @param  object    $pager
 * @access public
 * @return array
 */
public function getScriptTask($orderBy = 'id_desc', $type  = 'byModule', $pager = null)
{
    if ($type == 'bySearch')
    {
        $patchBuildQuery = $this->session->patchbuildQuery;
        $patchBuildQuery = preg_replace('/`(\w+)`/', 't1.`$1`', $patchBuildQuery);

        return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
            ->from(TABLE_PATCHBUILD)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.project')->eq((int)$projectID)
            ->andWhere('t1.deleted')->eq(0)
            ->andWhere($patchBuildQuery)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
    }
    else
    {
        return $this->dao->select('t1.*, t2.`id` as task, t2.`name` as taskTitle, t2.finishedBy, t2.finishedDate, t2.story, t3.title as storyTitle, t3.plan, t3.openedBy, t4.title as planTitle')
            ->from(TABLE_SCRIPT)->alias('t1')
            ->leftJoin(TABLE_TASK)->alias('t2')->on('t1.task = t2.id')
            ->leftJoin(TABLE_STORY)->alias('t3')->on('t2.story = t3.id')
            ->leftJoin(TABLE_PRODUCTPLAN)->alias('t4')->on('t3.plan = t4.id')
            ->where('t1.deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
    }
}

/**
 * Get script info.
 *
 * @param  int    $scriptID
 * @access public
 * @return object
 */
public function getScriptById($scriptID)
{
    $script = $this->dao->select('t1.*, t2.`name` as taskTitle, t2.finishedBy, t2.finishedDate, t2.story, t3.title as storyTitle, t3.plan, t3.openedBy, t4.title as planTitle, t5.spec')
        ->from(TABLE_SCRIPT)->alias('t1')
        ->leftJoin(TABLE_TASK)->alias('t2')->on('t1.task = t2.id')
        ->leftJoin(TABLE_STORY)->alias('t3')->on('t2.story = t3.id')
        ->leftJoin(TABLE_PRODUCTPLAN)->alias('t4')->on('t3.plan = t4.id')
        ->leftJoin(TABLE_STORYSPEC)->alias('t5')->on('t3.id = t5.story')
        ->where('t1.id')->eq((int)$scriptID)
        ->fetch();

    if(!$script) return false;

    //$build->files = $this->loadModel('file')->getByObject('patchBuild', $buildID);
    //if($setImgSize) $build->patchContent = $this->file->setImgSize($build->patchContent);
    return $script;
}
/**
 * Update a script.
 *
 * @param  int    $scriptID
 * @access public
 * @return void
 */
public function updateScript($scriptID)
{
    $oldScript = $this->getScriptById($scriptID);
    $script = fixer::input('post')
        ->stripTags($this->config->report->editor->editscript['id'], $this->config->allowedTags)
        //->join('mailto', ',')
        ->remove('taskID')
        ->get();
    
    $this->dao->update(TABLE_SCRIPT)->data($script)
        ->autoCheck()
        //->batchCheck($this->config->patchbuild->editBatchBuild->requiredFields, 'notempty')
        ->where('id')->eq((int)$scriptID)
        ->check("id != $scriptID AND deleted = '0'")
        ->exec();
    
    if(!dao::isError())
    {
        //$this->file->updateObjectID($this->post->uid, $buildID, 'build');
        return common::createChanges($oldScript, $script);
    }
}

public function undelete($scriptID)
{
    $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(0)->where('id')->eq($scriptID)->exec();
}