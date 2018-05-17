<?php
/**
 * Create a batch stories.
 *
 * @access public
 * @return int|bool the id of the created story or false when error.
 */
public function batchCreate($productID = 0, $branch = 0)
{
    $this->loadModel('action');
    $branch   = (int)$branch;
    $now      = helper::now();
    $mails    = array();
    $stories  = fixer::input('post')->get();
    $batchNum = count(reset($stories));

    $result  = $this->loadModel('common')->removeDuplicate('story', $stories, "product={$productID}");
    $stories = $result['data'];

    $module = 0;
    //bug修改把plan的值有0改为'';待官方修复后该文件删除
    $plan   = '';
    $pri    = 0;
    $source = '';

    for($i = 0; $i < $batchNum; $i++)
    {
        $module = $stories->module[$i] == 'ditto' ? $module : $stories->module[$i];
        $plan   = $stories->plan[$i]   == 'ditto' ? $plan   : $stories->plan[$i];
        $pri    = $stories->pri[$i]    == 'ditto' ? $pri    : $stories->pri[$i];
        $source = $stories->source[$i] == 'ditto' ? $source : $stories->source[$i];
        $stories->module[$i] = (int)$module;
        $stories->plan[$i]   = $plan;
        $stories->pri[$i]    = (int)$pri;
        $stories->source[$i] = $source;

        if(!empty($stories->title[$i]) && empty($stories->module[$i])) die(js::alert(sprintf($this->lang->error->notempty, $this->lang->story->module)));
    }

    if(isset($stories->uploadImage)) $this->loadModel('file');

    $forceReview = $this->checkForceReview();
    $data        = array();
    for($i = 0; $i < $batchNum; $i++)
    {
        if(empty($stories->title[$i])) continue;
        $story = new stdclass();
        $story->branch     = $stories->branch[$i];
        $story->module     = $stories->module[$i];
        $story->plan       = $stories->plan[$i];
        $story->color      = $stories->color[$i];
        $story->title      = $stories->title[$i];
        $story->source     = $stories->source[$i];
        $story->pri        = $stories->pri[$i];
        $story->estimate   = $stories->estimate[$i];
        $story->status     = ($stories->needReview[$i] == 0 and !$forceReview) ? 'active' : 'draft';
        $story->keywords   = $stories->keywords[$i];
        $story->product    = $productID;
        $story->openedBy   = $this->app->user->account;
        $story->openedDate = $now;
        $story->version    = 1;

        foreach(explode(',', $this->config->story->create->requiredFields) as $field)
        {
            $field = trim($field);
            if($field and empty($story->$field)) die(js::alert(sprintf($this->lang->error->notempty, $this->lang->story->$field)));
        }

        $data[$i] = $story;
    }

    foreach($data as $i => $story)
    {
        $this->dao->insert(TABLE_STORY)->data($story)->autoCheck()
            ->batchCheck($this->config->story->create->requiredFields, 'notempty')
            ->exec();
        if(dao::isError())
        {
            echo js::error(dao::getError());
            die(js::reload('parent'));
        }

        $storyID = $this->dao->lastInsertID();
        $this->setStage($storyID);

        $specData = new stdclass();
        $specData->story   = $storyID;
        $specData->version = 1;
        $specData->title   = $stories->title[$i];
        $specData->spec    = '';
        $specData->verify  = '';
        if(!empty($stories->spec[$i]))  $specData->spec   = nl2br($stories->spec[$i]);
        if(!empty($stories->verify[$i]))$specData->verify = nl2br($stories->verify[$i]);

        if(!empty($stories->uploadImage[$i]))
        {
            $fileName = $stories->uploadImage[$i];
            $file     = $this->session->storyImagesFile[$fileName];

            $realPath = $file['realpath'];
            unset($file['realpath']);

            if(rename($realPath, $this->file->savePath . $this->file->getSaveName($file['pathname'])))
            {
                $file['addedBy']    = $this->app->user->account;
                $file['addedDate']  = $now;
                $file['objectType'] = 'story';
                $file['objectID']   = $storyID;
                if(in_array($file['extension'], $this->config->file->imageExtensions))
                {
                    $file['extra'] = 'editor';
                    $this->dao->insert(TABLE_FILE)->data($file)->exec();

                    $fileID = $this->dao->lastInsertID();
                    $specData->spec .= '<img src="{' . $fileID . '.' . $file['extension'] . '}" alt="" />';
                }
                else
                {
                    $this->dao->insert(TABLE_FILE)->data($file)->exec();
                }
            }
        }

        $this->dao->insert(TABLE_STORYSPEC)->data($specData)->exec();

        $actionID = $this->action->create('story', $storyID, 'Opened', '');
        if(!dao::isError()) $this->loadModel('score')->create('story', 'create',$storyID);
        $mails[$i] = new stdclass();
        $mails[$i]->storyID  = $storyID;
        $mails[$i]->actionID = $actionID;
    }

    /* Remove upload image file and session. */
    if(!empty($stories->uploadImage) and $this->session->storyImagesFile)
    {
        $classFile = $this->app->loadClass('zfile');
        $file = current($_SESSION['storyImagesFile']);
        $realPath = dirname($file['realpath']);
        if(is_dir($realPath)) $classFile->removeDir($realPath);
        unset($_SESSION['storyImagesFile']);
    }
    if(!dao::isError())  $this->loadModel('score')->create('ajax', 'batchCreate');
    return $mails;
}