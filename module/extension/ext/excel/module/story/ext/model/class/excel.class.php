<?php
class excelStory extends StoryModel
{
    public function setListValue($productID, $branch = 0)
    {
        $product    = $this->loadModel('product')->getByID($productID);
        $modules    = $this->loadModel('tree')->getOptionMenu($productID, 'story', 0, $branch);
        $plans      = $this->loadModel('productplan')->getPairs($productID, $branch, 'unexpired');
        $priList    = $this->lang->story->priList;
        $sourceList = $this->lang->story->sourceList;

        unset($plans['']);
        foreach($modules  as $id => $module) $modules[$id] .= "(#$id)";
        foreach($plans    as $id => $plan) $plans[$id] .= "(#$id)";

        $this->post->set('moduleList',   array_values($modules));
        $this->post->set('planList',     array_values($plans));
        $this->post->set('priList',      join(',', $priList));
        $this->post->set('sourceList',   join(',', $sourceList));
        $this->post->set('listStyle',  $this->config->story->export->listFields);
        $this->post->set('extraNum',   0);
        $this->post->set('product',    $product->name);
    }

    public function createFromImport($productID, $branch = 0)
    {
        $this->loadModel('action');
        $this->loadModel('story');
        $this->loadModel('file');
        $now    = helper::now();
        $branch = (int)$branch;
        $data   = fixer::input('post')->get();

        if(!empty($_POST['id']))
        {
            $oldStories = $this->dao->select('*')->from(TABLE_STORY)->where('id')->in(($_POST['id']))->andWhere('product')->eq($productID)->fetchAll('id');
            $oldSpecs   = $this->dao->select('*')->from(TABLE_STORYSPEC)->where('story')->in(array_keys($oldStories))->orderBy('version')->fetchAll('story');
        }

        foreach($data->product as $key => $product)
        {
            dao::getError();
            $storyData = new stdclass();
            $specData  = new stdclass();

            $storyData->product      = $product;
            $storyData->module       = (int)$data->module[$key];
            $storyData->plan         = (int)$data->plan[$key];
            $storyData->source       = $data->source[$key];
            $storyData->title        = trim($data->title[$key]);
            $storyData->pri          = (int)$data->pri[$key];
            $storyData->estimate     = (float)$data->estimate[$key];
            $storyData->keywords     = $data->keywords[$key];

            $specData->title         = $storyData->title;
            $specData->spec          = str_replace("\n", '<br />', stripslashes($data->spec[$key]));
            $specData->verify        = str_replace("\n", '<br />', stripslashes($data->verify[$key]));

            if(empty($specData->title)) continue;

            $storyID = 0;
            if(!empty($_POST['id'][$key]) and empty($_POST['insert']))
            {
                $storyID = $data->id[$key];
                if(!isset($oldStories[$storyID])) $storyID = 0;
            }

            if($storyID)
            {
                $specData->spec   = str_replace('src="' . common::getSysURL() . '/', 'src="', $specData->spec);
                $specData->verify = str_replace('src="' . common::getSysURL() . '/', 'src="', $specData->verify);

                $oldSpec      = (array)$oldSpecs[$storyID];
                $newSpec      = (array)$specData;

                $oldSpec['spec']   = trim($this->file->excludeHtml($oldSpec['spec'], 'noImg'));
                $oldSpec['verify'] = trim($this->file->excludeHtml($oldSpec['verify'], 'noImg'));
                $newSpec['spec']   = trim($this->file->excludeHtml($newSpec['spec'], 'noImg'));
                $newSpec['verify'] = trim($this->file->excludeHtml($newSpec['verify'], 'noImg'));
                $storyChanges = common::createChanges($oldStories[$storyID], $storyData);
                $specChanges  = common::createChanges((object)$oldSpec, (object)$newSpec);

                if($specChanges)
                {
                    $storyData->version      = $oldStories[$storyID]->version + 1;
                    $storyData->reviewedBy   = '';
                    $storyData->closedBy     = '';
                    $storyData->closedReason = '';
                    if($oldStories[$storyID]->status == 'active') $storyData->status = 'changed';
                    if($oldStories[$storyID]->reviewedBy) $storyData->reviewedDate   = '0000-00-00';
                    if($oldStories[$storyID]->closedBy) $storyData->closedDate       = '0000-00-00';

                    $specData = $oldSpecs[$storyID];
                    $specData->version += 1;

                    foreach($specChanges as $specChange)$specData->{$specChange['field']} = $specChange['new'];
                }

               if($storyChanges or $specChanges)
               {
                   $storyData->lastEditedBy   = $this->app->user->account;
                   $storyData->lastEditedDate = $now;
                   $this->dao->update(TABLE_STORY)
                       ->data($storyData)
                       ->autoCheck()
                       ->batchCheck($this->config->story->change->requiredFields, 'notempty')
                       ->where('id')->eq((int)$storyID)->exec();
               }
               if(!dao::isError())
               {
                   if($specChanges)
                   {
                       $this->dao->insert(TABLE_STORYSPEC)->data($specData)->exec();
                       $actionID = $this->action->create('story', $storyID, 'Changed', '');
                       $this->action->logHistory($actionID, $specChanges);
                   }
                   if($storyChanges)
                   {
                       $actionID = $this->action->create('story', $storyID, 'Edited', '');
                       $this->action->logHistory($actionID, $storyChanges);
                   }

               }
            }
            else
            {
                $storyData->status     = 'draft';
                $storyData->version    = 1;
                if($storyData->plan > 0) $storyData->stage = 'planned';
                $storyData->openedBy   = $this->app->user->account;
                $storyData->openedDate = $now;
                $storyData->branch     = $branch;

                $this->dao->insert(TABLE_STORY)->data($storyData)->autoCheck()->exec();

               if(!dao::isError())
               {
                   $storyID = $this->dao->lastInsertID();
                   $specData->story   = $storyID;
                   $specData->version = 1;
                   $this->dao->insert(TABLE_STORYSPEC)->data($specData)->exec();
                   $this->action->create('story', $storyID, 'Opened', '');
               }
            }
        }

        unlink($this->session->importFile);
        unset($_SESSION['importFile']);
    }
}
