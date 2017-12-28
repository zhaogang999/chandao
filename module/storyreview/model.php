<?php

/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/12/5
 * Time: 16:08
 */
class storyreviewModel extends model
{
    /**
     * Build a search form
     *
     * @param $actionURL  string
     * @param int $queryID
     * @access public
     * @return void
     */
    public function buildStoryReviewSearchForm($actionURL, $queryID)
    {
        $this->config->storyreview->search['queryID']   = $queryID;
        $this->config->storyreview->search['actionURL'] = $actionURL;
        $this->loadModel('search')->setSearchParams($this->config->storyreview->search);
    }
    /**
     * Create a storyreview
     *
     * @param  int    $projectID
     * @access public
     * @return void
     */
    public function create($projectID)
    {
        $productID = $this->dao->select('product')->from(TABLE_PROJECTPRODUCT)
            ->where('project')->eq($projectID)
            ->fetch('product');

        $_POST['solvedProblem'] = str_replace("\r\n","<br />",trim($_POST['solvedProblem']));
        $_POST['risk'] = str_replace("\r\n","<br />",$_POST['risk']);
        $_POST['result'] = str_replace("\r\n","<br />",$_POST['result']);
        $_POST['influence'] = str_replace("\r\n","<br />",$_POST['influence']);
        $_POST['problemTracking'] = str_replace("\r\n","<br />",$_POST['problemTracking']);

        $storyReview = fixer::input('post')
            ->setDefault('reviewDate', helper::today())
            ->setDefault('testDate', '0000-00-00')
            ->setDefault('acceptanceDate', '0000-00-00')
            ->setDefault('releasedDate', '0000-00-00')
            ->join('mailto', ',')
            ->join('reviewStories', ',')
            ->join('storyReviewers', ',')
            ->join('devReviewers', ',')
            ->join('testReviewers', ',')
            ->join('otherReviewers', ',')
            ->join('teamDev', ',')
            ->add('product', (int)$productID)
            ->add('project', (int)$projectID)
            ->stripTags($this->config->storyreview->editor->create['id'] . ',solvedProblem,risk,result,influence,problemTracking', $this->config->allowedTags)
            ->remove('uid')
            ->get();

        $storyReview = $this->loadModel('file')->processImgURL($storyReview, $this->config->storyreview->editor->create['id'], $this->post->uid);
        
        $this->dao->insert(TABLE_STORYREVIEW)->data($storyReview)
            ->autoCheck()
            //->batchCheck($this->config->storyReview->createstoryReview->requiredFields, 'notempty')
            //->check("product = {$storyReview->product} AND deleted = '0'")
            ->exec();
        if(!dao::isError())
        {
            $storyReviewID = $this->dao->lastInsertID();
            $this->file->updateObjectID($this->post->uid, $storyReviewID, 'storyreview');
            $this->file->saveUpload('storyreview', $storyReviewID);
            
            if (!empty($storyReview->reviewStories))
            {
                $this->linkStory($storyReview->reviewStories, $storyReviewID);
            }
            return $storyReviewID;
        }
    }

    public function getStoryReviews($objectID, $from, $orderBy = 'id_desc', $type  = 'byModule', $queryID, $pager = null)
    {
        if ($type == 'bySearch')
        {
            if($queryID)
            {
                $query = $this->loadModel('search')->getQuery($queryID);
                if($query)
                {
                    $this->session->set('storyreviewQuery', $query->sql);
                    $this->session->set('storyreviewForm', $query->form);
                }
                else
                {
                    $this->session->set('storyreviewQuery', ' 1 = 1');
                }
            }
            /* else
             {
                 if($this->session->taskQuery == false) $this->session->set('storyReviewQuery', ' 1 = 1');
             }*/
            $storyReviewQuery = $this->session->storyreviewQuery;
            $storyReviewQuery = preg_replace('/`(\w+)`/', 't1.`$1`', $storyReviewQuery);

            return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
                ->from(TABLE_STORYREVIEW)->alias('t1')
                ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
                ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
                ->where('t1.deleted')->eq(0)
                ->beginIF($from == 'project')->andWhere('t1.project')->eq((int)$objectID)->fi()
                ->beginIF($from == 'qa')->andWhere('t1.product')->eq((int)$objectID)->fi()
                ->andWhere($storyReviewQuery)
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
        else
        {
            return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
                ->from(TABLE_STORYREVIEW)->alias('t1')
                ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
                ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
                ->where('t1.deleted')->eq(0)
                ->beginIF($from == 'project')->andWhere('t1.project')->eq((int)$objectID)->fi()
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
    }

    /**
     * Update a storyReview.
     *
     * @param  int    $storyReviewID
     * @access public
     * @return void
     */
    public function update($storyReviewID)
    {
        $oldStoryReview = $this->getStoryReviewById($storyReviewID);

        $_POST['solvedProblem'] = str_replace("\r\n","<br />",trim($_POST['solvedProblem']));
        $_POST['risk'] = str_replace("\r\n","<br />",$_POST['risk']);
        $_POST['result'] = str_replace("\r\n","<br />",$_POST['result']);
        $_POST['influence'] = str_replace("\r\n","<br />",$_POST['influence']);
        $_POST['problemTracking'] = str_replace("\r\n","<br />",$_POST['problemTracking']);

        $storyReview = fixer::input('post')
            ->stripTags($this->config->storyreview->editor->edit['id'] . ',solvedProblem,risk,result,influence,problemTracking', $this->config->allowedTags)
            ->join('mailto', ',')
            ->join('reviewStories', ',')
            ->join('storyReviewers', ',')
            ->join('devReviewers', ',')
            ->join('testReviewers', ',')
            ->join('otherReviewers', ',')
            ->join('teamDev', ',')
            ->remove('uid')
            ->get();

        $storyReview = $this->loadModel('file')->processImgURL($storyReview, $this->config->storyreview->editor->edit['id'], $this->post->uid);

        $this->dao->update(TABLE_STORYREVIEW)->data($storyReview)
            ->autoCheck()
            //->batchCheck($this->config->storyReview->editBatchBuild->requiredFields, 'notempty')
            ->where('id')->eq((int)$storyReviewID)
            ->check('title', 'unique', "id != $storyReviewID AND deleted = '0'")
            ->exec();

        if(!dao::isError())
        {
            $this->file->updateObjectID($this->post->uid, $storyReviewID, 'build');
            $changes = common::createChanges($oldStoryReview, $storyReview);

            foreach($changes as $change)
            {
                if ($change['field'] == 'reviewStories')
                {
                    $oldStoryReviews = explode(',', trim($change['old'], ','));
                    $storyReviews    = explode(',', trim($change['new'], ','));
                    $unlinkStories   = array_diff($oldStoryReviews, $storyReviews);
                    $linkStories     = array_diff($storyReviews, $oldStoryReviews);
                    $this->unLinkStory($unlinkStories, $storyReviewID);
                    $this->linkStory($linkStories, $storyReviewID);
                }
            }

            return $changes;
        }
    }

    /**
     * 需求评审单关联需求
     *
     * @param $stories
     * @param $storyReviewID
     * @return void
     */
    public function linkStory($stories, $storyReviewID)
    {
        foreach ($stories as $storyID)
        {
            $storyInfo = new stdClass();
            $storyInfo->reviewStatus = 'hasReview';

            $linkStories = $this->dao->select('storyReviewID')->FROM(TABLE_STORY)->where('id')->eq($storyID)->fetch();
            $storyInfo->storyReviewID = trim($linkStories->storyReviewID .','. $storyReviewID, ',');

            $this->dao->update(TABLE_STORY)->data($storyInfo)
                ->autoCheck()
                ->where('id')->eq($storyID)
                ->exec();
            if(dao::isError()) die(js::error(dao::getError()));
        }
    }

    /**
     * 需求评审单解除需求关联
     *
     * @param $stories
     * @param $storyReviewID
     * @return void
     */
    public function unLinkStory($stories, $storyReviewID)
    {
        foreach ($stories as $storyID)
        {
            $storyInfo = new stdClass();
            $storyInfo->reviewStatus = 'notReview';
            //$storyInfo->storyReviewID = 0;

            $oldLinkStories = $this->dao->select('storyReviewID')->FROM(TABLE_STORY)->where('id')->eq($storyID)->fetch();
            $storyInfo->storyReviewID = trim(str_replace(',' . $storyReviewID . ',', '',  ',' . $oldLinkStories->storyReviewID . ','), ',');

            $this->dao->update(TABLE_STORY)->data($storyInfo)
                ->autoCheck()
                ->where('id')->eq($storyID)
                ->exec();
        }
    }

    /**
     * Get a storyReview info.
     *
     * @param  int    $storyReviewID
     * @param  bool   $setImgSize
     * @access public
     * @return object
     */
    public function getStoryReviewById($storyReviewID, $setImgSize = false)
    {
        $storyReview = $this->dao->select('t1.*, t2.name as projectName, t3.name as productName, t3.type as productType')
            ->from(TABLE_STORYREVIEW)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.id')->eq((int)$storyReviewID)
            ->fetch();
        if(!$storyReview) return false;

        $storyReview = $this->loadModel('file')->replaceImgURL($storyReview, 'comment');
        $storyReview->files = $this->loadModel('file')->getByObject('storyreview', $storyReviewID);
        if($setImgSize) $storyReview->comment = $this->file->setImgSize($storyReview->comment);

        return $storyReview;
    }

    /**
     * Send mail.
     *
     * @param  int    $storyReviewID
     * @param  int    $actionID
     * @access public
     * @return void
     */
    public function sendmail($storyReviewID, $actionID)
    {
        $this->loadModel('mail');
        $storyReview = $this->getStoryReviewById($storyReviewID);
        $users    = $this->loadModel('user')->getPairs('noletter');

        /* Get action info. */
        $action          = $this->loadModel('action')->getById($actionID);
        $history         = $this->action->getHistory($actionID);
        $action->history = isset($history[$actionID]) ? $history[$actionID] : array();

        /* Get mail content. */
        $modulePath = $this->app->getModulePath($appName = '', 'storyreview');
        $oldcwd     = getcwd();
        $viewFile   = $modulePath . 'view/sendmail.html.php';
        chdir($modulePath . 'view');
        if(file_exists($modulePath . 'ext/view/sendmail.html.php'))
        {
            $viewFile = $modulePath . 'ext/view/sendmail.html.php';
            chdir($modulePath . 'ext/view');
        }
        ob_start();
        include $viewFile;
        foreach(glob($modulePath . 'ext/view/sendmail.*.html.hook.php') as $hookFile) include $hookFile;
        $mailContent = ob_get_contents();
        ob_end_clean();
        chdir($oldcwd);

        /* Set toList and ccList. */
        $toList   = '';
        $toList = trim($toList, ',');
        $ccList   = str_replace(' ', '', trim($storyReview->mailto, ','));
        if(empty($toList))
        {
            if(empty($ccList)) return;
            if(strpos($ccList, ',') === false)
            {
                $toList = $ccList;
                $ccList = '';
            }
            else
            {
                $commaPos = strpos($ccList, ',');
                $toList   = substr($ccList, 0, $commaPos);
                $ccList   = substr($ccList, $commaPos + 1);
            }
        }

        /* Set email title. */
        if($action->action == 'opened')
        {
            $mailTitle = sprintf($this->lang->storyreview->mail->create->title, $this->app->user->realname, $storyReviewID, $this->post->title);
        }
        elseif($action->action == 'closed')
        {
            $mailTitle = sprintf($this->lang->storyreview->mail->close->title, $this->app->user->realname, $storyReviewID, $storyReview->title);
        }
        else
        {
            $mailTitle = sprintf($this->lang->storyreview->mail->edit->title, $this->app->user->realname, $storyReviewID, $this->post->title);
        }

        /* Send mail. */
        $this->mail->send($toList, $mailTitle, $mailContent, $ccList);
        if($this->mail->isError()) trigger_error(join("\n", $this->mail->getError()));
    }

    /**
     * get storyReviews of project
     *
     * @param $project
     * @return array
     */
    public function getStoryPairs($project)
    {
        $stories = $this->dao->select('t2.id, t2.title, t2.pri, t2.estimate')
            ->from(TABLE_PROJECTSTORY)->alias('t1')
            ->leftJoin(TABLE_STORY)->alias('t2')->on('t1.story = t2.id')
            ->where('t1.project')->eq((int)$project)
            ->andWhere('t2.deleted')->eq(0)
            ->orderBy('t1.`order` desc')
            ->fetchAll();
        
        return $this->loadModel('story')->formatStories($stories, 'full');
    }
}