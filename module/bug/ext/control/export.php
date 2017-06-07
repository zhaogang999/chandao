<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mybug extends bug
{
    public function export($productID, $orderBy)
    {
        if($_POST)
        {
            $this->bug->setListValue($productID);
        }
        //parent::export($productID, $orderBy);
        if($_POST)
        {
            $this->loadModel('file');
            $this->loadModel('branch');
            $bugLang   = $this->lang->bug;
            //定义历史记录语言变量
            $actionLang   = $this->lang->action;
            $bugConfig = $this->config->bug;

            /* Create field lists. */
            $fields = $this->post->exportFields ? $this->post->exportFields : explode(',', $bugConfig->list->exportFields);
            foreach($fields as $key => $fieldName)
            {
                $fieldName = trim($fieldName);
                $fields[$fieldName] = isset($bugLang->$fieldName) ? $bugLang->$fieldName : $fieldName;
                unset($fields[$key]);
            }

            /* Get bugs. */
            $bugs = $this->dao->select('*')->from(TABLE_BUG)->where($this->session->bugQueryCondition)
                ->beginIF($this->post->exportType == 'selected')->andWhere('id')->in($this->cookie->checkedItem)->fi()
                ->orderBy($orderBy)->fetchAll('id');

            /* Get users, products and projects. */
            $users    = $this->loadModel('user')->getPairs('noletter');
            $products = $this->loadModel('product')->getPairs('nocode');
            $projects = $this->loadModel('project')->getPairs('all|nocode');

            /* Get related objects id lists. */
            $relatedProductIdList = array();
            $relatedModuleIdList  = array();
            $relatedStoryIdList   = array();
            $relatedTaskIdList    = array();
            $relatedBugIdList     = array();
            $relatedCaseIdList    = array();
            $relatedBuildIdList   = array();
            $relatedBranchIdList  = array();

            foreach($bugs as $bug)
            {
                $relatedProductIdList[$bug->product]  = $bug->product;
                $relatedModuleIdList[$bug->module]    = $bug->module;
                $relatedStoryIdList[$bug->story]      = $bug->story;
                $relatedTaskIdList[$bug->task]        = $bug->task;
                $relatedCaseIdList[$bug->case]        = $bug->case;
                $relatedBugIdList[$bug->duplicateBug] = $bug->duplicateBug;
                $relatedBranchIdList[$bug->branch]    = $bug->branch;

                /* Process link bugs. */
                $linkBugs = explode(',', $bug->linkBug);
                foreach($linkBugs as $linkBugID)
                {
                    if($linkBugID) $relatedBugIdList[$linkBugID] = trim($linkBugID);
                }

                /* Process builds. */
                $builds = $bug->openedBuild . ',' . $bug->resolvedBuild;
                $builds = explode(',', $builds);
                foreach($builds as $buildID)
                {
                    if($buildID) $relatedBuildIdList[$buildID] = trim($buildID);
                }
            }

            /* Get related objects title or names. */
            $productsType   = $this->dao->select('id, type')->from(TABLE_PRODUCT)->where('id')->in($relatedProductIdList)->fetchPairs();
            $relatedModules = $this->dao->select('id, name')->from(TABLE_MODULE)->where('id')->in($relatedModuleIdList)->fetchPairs();
            $relatedStories = $this->dao->select('id,title')->from(TABLE_STORY) ->where('id')->in($relatedStoryIdList)->fetchPairs();
            $relatedTasks   = $this->dao->select('id, name')->from(TABLE_TASK)->where('id')->in($relatedTaskIdList)->fetchPairs();
            $relatedBugs    = $this->dao->select('id, title')->from(TABLE_BUG)->where('id')->in($relatedBugIdList)->fetchPairs();
            $relatedCases   = $this->dao->select('id, title')->from(TABLE_CASE)->where('id')->in($relatedCaseIdList)->fetchPairs();
            $relatedBranch  = array('0' => $this->lang->branch->all) + $this->dao->select('id, name')->from(TABLE_BRANCH)->where('id')->in($relatedBranchIdList)->fetchPairs();
            $relatedBuilds  = array('trunk' => $this->lang->trunk) + $this->dao->select('id, name')->from(TABLE_BUILD)->where('id')->in($relatedBuildIdList)->fetchPairs();
            $relatedFiles   = $this->dao->select('id, objectID, pathname, title')->from(TABLE_FILE)->where('objectType')->eq('bug')->andWhere('objectID')->in(@array_keys($bugs))->fetchGroup('objectID');
            //获得bug下的备注信息
            $relatedComments   = $this->dao->select('id,objectID,actor,action,date,comment')->from(TABLE_ACTION)->where('objectType')->eq('bug')->andWhere('objectID')->in(@array_keys($bugs))->andWhere('comment')->ne('')->fetchGroup('objectID');

            foreach($bugs as $bug)
            {
                if($this->post->fileType == 'csv')
                {
                    $bug->steps = htmlspecialchars_decode($bug->steps);
                    $bug->steps = str_replace("<br />", "\n", $bug->steps);
                    $bug->steps = str_replace('"', '""', $bug->steps);
                    $bug->steps = str_replace('&nbsp;', ' ', $bug->steps);
                    $bug->steps = strip_tags($bug->steps);
                }

                /* fill some field with useful value. */
                if(isset($products[$bug->product]))            $bug->product       = $products[$bug->product] . "(#$bug->product)";
                if(isset($projects[$bug->project]))            $bug->project       = $projects[$bug->project] . "(#$bug->project)";
                if(isset($relatedModules[$bug->module]))       $bug->module        = $relatedModules[$bug->module] . "(#$bug->module)";
                if(isset($relatedStories[$bug->story]))        $bug->story         = $relatedStories[$bug->story] . "(#$bug->story)";
                if(isset($relatedTasks[$bug->task]))           $bug->task          = $relatedTasks[$bug->task] . "($bug->task)";
                if(isset($relatedBugs[$bug->duplicateBug]))    $bug->duplicateBug  = $relatedBugs[$bug->duplicateBug] . "($bug->duplicateBug)";
                if(isset($relatedCases[$bug->case]))           $bug->case          = $relatedCases[$bug->case] . "($bug->case)";
                if(isset($relatedBuilds[$bug->resolvedBuild])) $bug->resolvedBuild = $relatedBuilds[$bug->resolvedBuild] . "(#$bug->resolvedBuild)";
                if(isset($relatedBranch[$bug->branch]))        $bug->branch        = $relatedBranch[$bug->branch] . "(#$bug->branch)";

                if(isset($bugLang->priList[$bug->pri]))               $bug->pri        = $bugLang->priList[$bug->pri];
                if(isset($bugLang->typeList[$bug->type]))             $bug->type       = $bugLang->typeList[$bug->type];
                if(isset($bugLang->severityList[$bug->severity]))     $bug->severity   = $bugLang->severityList[$bug->severity];
                if(isset($bugLang->osList[$bug->os]))                 $bug->os         = $bugLang->osList[$bug->os];
                if(isset($bugLang->browserList[$bug->browser]))       $bug->browser    = $bugLang->browserList[$bug->browser];
                if(isset($bugLang->statusList[$bug->status]))         $bug->status     = $bugLang->statusList[$bug->status];
                if(isset($bugLang->confirmedList[$bug->confirmed]))   $bug->confirmed  = $bugLang->confirmedList[$bug->confirmed];
                if(isset($bugLang->resolutionList[$bug->resolution])) $bug->resolution = $bugLang->resolutionList[$bug->resolution];

                if(isset($users[$bug->openedBy]))     $bug->openedBy     = $users[$bug->openedBy];
                if(isset($users[$bug->assignedTo]))   $bug->assignedTo   = $users[$bug->assignedTo];
                if(isset($users[$bug->resolvedBy]))   $bug->resolvedBy   = $users[$bug->resolvedBy];
                if(isset($users[$bug->lastEditedBy])) $bug->lastEditedBy = $users[$bug->lastEditedBy];
                if(isset($users[$bug->closedBy]))     $bug->closedBy     = $users[$bug->closedBy];

                $bug->openedDate     = substr($bug->openedDate,     0, 10);
                $bug->assignedDate   = substr($bug->assignedDate,   0, 10);
                $bug->closedDate     = substr($bug->closedDate,     0, 10);
                $bug->resolvedDate   = substr($bug->resolvedDate,   0, 10);
                $bug->lastEditedDate = substr($bug->lastEditedDate, 0, 10);

                if($bug->linkBug)
                {
                    $tmpLinkBugs = array();
                    $linkBugIdList = explode(',', $bug->linkBug);
                    foreach($linkBugIdList as $linkBugID)
                    {
                        $linkBugID = trim($linkBugID);
                        $tmpLinkBugs[] = isset($relatedBugs[$linkBugID]) ? $relatedBugs[$linkBugID] : $linkBugID;
                    }
                    $bug->linkBug = join("; \n", $tmpLinkBugs);
                }

                if($bug->openedBuild)
                {
                    $tmpOpenedBuilds   = array();
                    $tmpResolvedBuilds = array();
                    $buildIdList = explode(',', $bug->openedBuild);
                    foreach($buildIdList as $buildID)
                    {
                        $buildID = trim($buildID);
                        $tmpOpenedBuilds[] = isset($relatedBuilds[$buildID]) ? $relatedBuilds[$buildID] . "(#$buildID)" : $buildID;
                    }
                    $bug->openedBuild = join("\n", $tmpOpenedBuilds);
                    if($this->post->fileType == 'html') $bug->openedBuild = nl2br($bug->openedBuild);
                }

                /* Set related files. */
                if(isset($relatedFiles[$bug->id]))
                {
                    foreach($relatedFiles[$bug->id] as $file)
                    {
                        $fileURL = common::getSysURL() . $this->file->webPath . $file->pathname;
                        $bug->files .= html::a($fileURL, $file->title, '_blank') . '<br />';
                    }
                }
                //把备注信息加到excel要导出的字段中
                if (isset($relatedComments[$bug->id]))
                {
                    foreach ($relatedComments[$bug->id] as $comment)
                    {
                        $bug->legendComment .= $comment->date . ',由' .$users[$comment->actor] . $actionLang->label->{$comment->action} . '。' . $comment->comment . "\n";
                    }
                }

                $bug->mailto = trim(trim($bug->mailto), ',');
                $mailtos     = explode(',', $bug->mailto);
                $bug->mailto = '';
                foreach($mailtos as $mailto)
                {
                    $mailto = trim($mailto);
                    if(isset($users[$mailto])) $bug->mailto .= $users[$mailto] . ',';
                }

                unset($bug->caseVersion);
                unset($bug->result);
                unset($bug->deleted);
            }

            if(!(in_array('platform', $productsType) or in_array('branch', $productsType))) unset($fields['branch']);// If products's type are normal, unset branch field.

            $this->post->set('fields', $fields);
            $this->post->set('rows', $bugs);
            $this->post->set('kind', 'bug');
            $this->fetch('file', 'export2' . $this->post->fileType, $_POST);
        }

        $this->view->allExportFields = $this->config->bug->list->exportFields;
        $this->view->customExport    = true;
        $this->display();
    }
}
