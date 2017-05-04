<?php
/**
 * Resolve a bug.
 *
 * @param  int    $bugID
 * @access public
 * @return void
 */
public function resolve($bugID)
{
    $now    = helper::now();
    $oldBug = $this->getById($bugID);
    $bug    = fixer::input('post')
        ->add('resolvedBy',     $this->app->user->account)
        ->add('status',         'resolved')
        ->add('confirmed',      1)
        ->add('assignedDate',   $now)
        ->add('lastEditedBy',   $this->app->user->account)
        ->add('lastEditedDate', $now)
        ->setDefault('resolvedDate', $now)
        ->setDefault('duplicateBug', 0)
        ->setDefault('assignedTo', $oldBug->openedBy)
        ->remove('comment,files,labels')
        ->get();

    /* Can create build when resolve bug. */
    if(isset($bug->createBuild))
    {
        if(empty($bug->buildName)) dao::$errors['buildName'][] = sprintf($this->lang->error->notempty, $this->lang->bug->placeholder->newBuildName);
        if(empty($bug->buildProject)) dao::$errors['buildProject'][] = sprintf($this->lang->error->notempty, $this->lang->bug->project);
        if(dao::isError()) return false;

        $buildData = new stdclass();
        $buildData->product = $oldBug->product;
        $buildData->branch  = $oldBug->branch;
        $buildData->project = $bug->buildProject;
        $buildData->name    = $bug->buildName;
        $buildData->date    = date('Y-m-d');
        $buildData->builder = $this->app->user->account;
        $this->dao->insert(TABLE_BUILD)->data($buildData)->autoCheck()
            ->check('name', 'unique', "product = {$buildData->product} AND branch = {$buildData->branch} AND deleted = '0'")
            ->exec();
        if(dao::isError()) return false;
        $buildID = $this->dao->lastInsertID();
        $this->loadModel('action')->create('build', $buildID, 'opened');
        $bug->resolvedBuild = $buildID;
    }
    unset($bug->buildName);
    unset($bug->createBuild);
    unset($bug->buildProject);

    if($bug->resolvedBuild != 'trunk') $bug->testtask = $this->dao->select('id')->from(TABLE_TESTTASK)->where('build')->eq($bug->resolvedBuild)->orderBy('id_desc')->limit(1)->fetch('id');

    $this->dao->update(TABLE_BUG)->data($bug)
        ->autoCheck()
        ->batchCheck($this->config->bug->resolve->requiredFields, 'notempty')
        ->checkIF($bug->resolution == 'duplicate', 'duplicateBug', 'notempty')
        ->checkIF($bug->resolution == 'fixed',     'resolvedBuild','notempty')
        ->where('id')->eq((int)$bugID)
        ->exec();
    if (!dao::isError())
    {
        $this->loadModel('github');
        $this->github->edit($oldBug, $bug, 'bug');
    }
    /* Link bug to build and release. */
    $this->linkBugToBuild($bugID, $bug->resolvedBuild);
}
