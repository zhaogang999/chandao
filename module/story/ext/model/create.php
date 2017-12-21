<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/9/28
 * Time: 10:31
 */
/**
 * Create a story.
 *
 * @param $projectID int
 * @param $bugID int
 * @access public
 * @return int|bool the id of the created story or false when error.
 */
public function create($projectID = 0, $bugID = 0)
{
    $now   = helper::now();
    $story = fixer::input('post')
        ->cleanInt('product,module,pri,plan')
        ->cleanFloat('estimate')
        ->callFunc('title', 'trim')
        ->setDefault('plan,verify', '')
        ->setDefault('reviewed', '0')        //创建需求时评审状态设置为未评审
        ->setDefault('releasedDate', '0000-00-00')   //2911 优化需求提测计划、发版计划等内容 2行
        ->setDefault('testDate', '0000-00-00')
        ->add('openedBy', $this->app->user->account)
        ->add('openedDate', $now)
        ->add('assignedDate', 0)
        ->add('version', 1)
        ->add('status', 'draft')
        ->setIF($this->post->assignedTo != '', 'assignedDate', $now)
        ->setIF($this->post->needNotReview or $projectID > 0, 'status', 'active')
        ->setIF($this->post->plan > 0, 'stage', 'planned')
        ->setIF($projectID > 0, 'stage', 'projected')
        ->setIF($bugID > 0, 'fromBug', $bugID)
        ->join('mailto', ',')
        ->stripTags($this->config->story->editor->create['id'], $this->config->allowedTags)
        ->remove('files,labels,needNotReview,newStory,uid')
        ->get();

    /* Check repeat story. */
    $result = $this->loadModel('common')->removeDuplicate('story', $story, "product={$story->product}");
    if($result['stop']) return array('status' => 'exists', 'id' => $result['duplicate']);

    if($this->checkForceReview()) $story->status = 'draft';
    if($story->status == 'draft') $story->stage   = $this->post->plan > 0 ? 'planned' : 'wait';
    $story = $this->loadModel('file')->processImgURL($story, $this->config->story->editor->create['id'], $this->post->uid);
    $this->dao->insert(TABLE_STORY)->data($story, 'spec,verify')->autoCheck()->batchCheck($this->config->story->create->requiredFields, 'notempty')->exec();
    if(!dao::isError())
    {
        $storyID = $this->dao->lastInsertID();
        $this->file->updateObjectID($this->post->uid, $storyID, 'story');
        $this->file->saveUpload('story', $storyID, $extra = 1);

        $data          = new stdclass();
        $data->story   = $storyID;
        $data->version = 1;
        $data->title   = $story->title;
        $data->spec    = $story->spec;
        $data->verify  = $story->verify;
        $this->dao->insert(TABLE_STORYSPEC)->data($data)->exec();

        if($projectID != 0 and $story->status != 'draft')
        {
            $lastOrder = (int)$this->dao->select('*')->from(TABLE_PROJECTSTORY)->where('project')->eq($projectID)->orderBy('order_desc')->limit(1)->fetch('order');
            $this->dao->insert(TABLE_PROJECTSTORY)
                ->set('project')->eq($projectID)
                ->set('product')->eq($this->post->product)
                ->set('story')->eq($storyID)
                ->set('version')->eq(1)
                ->set('order')->eq($lastOrder + 1)
                ->exec();
        }
        //2262 bug转需求之后，bug自动关闭，无法再跟进验证，希望转需求后，bug状态呈现已解决，而非关闭
        if($bugID > 0)
        {
            $bugAB = $this->loadModel('bug')->getByID($bugID);
            $bug = new stdclass();
            $bug->toStory      = $storyID;
            $bug->status       = 'resolved';
            $bug->resolution   = 'tostory';
            $bug->resolvedBy   = $this->app->user->account;
            $bug->resolvedDate = $now;
            $bug->assignedTo   = $bugAB->openedBy;
            $bug->assignedDate = $now;
            $this->dao->update(TABLE_BUG)->data($bug)->where('id')->eq($bugID)->exec();

            $this->loadModel('action')->create('bug', $bugID, 'tostory', '', $storyID);
            $this->action->create('bug', $bugID, 'resolved', '', 'tostory');

            /* add files to story from bug. */
            $files = $this->dao->select('*')->from(TABLE_FILE)
                ->where('objectType')->eq('bug')
                ->andWhere('objectID')->eq($bugID)
                ->fetchAll();
            if(!empty($files))
            {
                foreach($files as $file)
                {
                    $file->objectType = 'story';
                    $file->objectID = $storyID;
                    unset($file->id);
                    $this->dao->insert(TABLE_FILE)->data($file)->exec();
                }
            }
        }
        $this->setStage($storyID);
        return array('status' => 'created', 'id' => $storyID);
    }
    return false;
}
