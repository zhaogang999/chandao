<?php
class excelBug extends bugModel
{
    public function setListValue($productID, $branch = 0)
    {
        $product   = $this->loadModel('product')->getByID($productID);
        $projects  = $this->product->getProjectPairs($productID, $branch ? "0,$branch" : 0, $params = 'nodeleted');
        $modules   = $this->loadModel('tree')->getOptionMenu($productID, 'bug', 0, $branch);
        $stories   = $this->loadModel('story')->getProductStories($productID, $branch);
        $builds    = $this->loadModel('build')->getProductBuildPairs($productID, $branch, 'noempty');
        $severityList = $this->lang->bug->severityList;
        $priList      = $this->lang->bug->priList;
        $typeList     = $this->lang->bug->typeList;
        $osList       = $this->lang->bug->osList;
        $browserList  = $this->lang->bug->browserList;

        unset($typeList['']);
        unset($projects['']);
        unset($typeList['designchange']);
        unset($typeList['newfeature']);
        unset($typeList['trackthings']);
        $projects[0] = '';

        foreach($projects as $id => $project) $projects[$id] = "$project(#$id)";
        foreach($modules  as $id => $module)  $modules[$id] .= "(#$id)";
        foreach($stories  as $id => $story)   $stories[$id]  = "$story->title(#$story->id)";
        foreach($builds as $id => $build)     $builds[$id]   = "$build(#$id)";

        $this->post->set('moduleList',   array_values($modules));
        $this->post->set('storyList',    $stories);
        $this->post->set('projectList',  $projects);
        $this->post->set('severityList', join(',', $severityList));
        $this->post->set('priList',      join(',', $priList));
        $this->post->set('typeList',     join(',', $typeList));
        $this->post->set('osList',       join(',', $osList));
        $this->post->set('browserList',  join(',', $browserList));
        $this->post->set('listStyle',  $this->config->bug->export->listFields);
        $this->post->set('extraNum',   0);
        $this->post->set('product',    $product->name);
        $this->post->set('buildList',  $builds);
    }

    public function createFromImport($productID, $branch = 0)
    {
        $this->loadModel('action');
        $this->loadModel('story');
        $this->loadModel('file');
        $now    = helper::now();
        $branch = (int)$branch;
        $data   = fixer::input('post')->get();

        if(!empty($_POST['id'])) $oldBugs = $this->dao->select('*')->from(TABLE_BUG)->where('id')->in($_POST['id'])->andWhere('product')->eq($productID)->fetchAll('id');

        foreach($data->product as $key => $product)
        {
            dao::getError();
            $bugData = new stdclass();

            $bugData->product      = $product;
            $bugData->module       = (int)$data->module[$key];
            $bugData->project      = (int)$data->project[$key];
            $bugData->openedBuild  = join(',', $data->openedBuild[$key]);
            $bugData->title        = $data->title[$key];
            $bugData->steps        = nl2br($data->steps[$key]);
            $bugData->story        = (int)$data->story[$key];
            $bugData->pri          = (int)$data->pri[$key];
            $bugData->type         = $data->type[$key];
            $bugData->severity     = (int)$data->severity[$key];
            $bugData->os           = $data->os[$key];
            $bugData->browser      = $data->browser[$key];
            $bugData->keywords     = $data->keywords[$key];

            if(isset($this->config->bug->create->requiredFields))
            {
                $requiredFields = explode(',', $this->config->bug->create->requiredFields);
                $invalid = false;
                foreach($requiredFields as $requiredField)
                {
                    $requiredField = trim($requiredField);
                    if(empty($bugData->$requiredField)) $invalid = true;
                }
                if($invalid) continue;
            }

            $bugID = 0;
            if(!empty($_POST['id'][$key]) and empty($_POST['insert']))
            {
                $bugID = $data->id[$key];
                if(!isset($oldBugs[$bugID])) $bugID = 0;
            }

            if($bugID)
            {
                if($bugData->story != $oldBugs[$bugID]->story) $bugData->storyVersion = $this->story->getVersion($bugData->story);
                $bugData->steps = str_replace('src="' . common::getSysURL() . '/', 'src="', $bugData->steps);

                $oldBug = (array)$oldBugs[$bugID];
                $newBug = (array)$bugData;
                $oldBug['steps'] = trim($this->file->excludeHtml($oldBug['steps'], 'noImg'));
                $newBug['steps'] = trim($this->file->excludeHtml($newBug['steps'], 'noImg'));
                $changes = common::createChanges((object)$oldBug, (object)$newBug);
                if(empty($changes)) continue;

                $bugData->lastEditedBy   = $this->app->user->account;
                $bugData->lastEditedDate = $now;
                $this->dao->update(TABLE_BUG)->data($bugData)->where('id')->eq($bugID)->autoCheck()->exec();

                if(!dao::isError())
                {
                    $actionID = $this->action->create('bug', $bugID, 'Edited');
                    $this->action->logHistory($actionID, $changes);

                }
            }
            else
            {
                if($bugData->story) $bugData->storyVersion = $this->story->getVersion($bugData->story);
                $bugData->openedBy   = $this->app->user->account;
                $bugData->openedDate = $now;
                $bugData->branch     = $branch;
                $this->dao->insert(TABLE_BUG)->data($bugData)->autoCheck()->exec();
                if(!dao::isError())
                {
                    $bugID = $this->dao->lastInsertID();
                    $this->action->create('bug', $bugID, 'Opened');
                }
            }
        }

        unlink($this->session->importFile);
        unset($_SESSION['importFile']);
    }
}
