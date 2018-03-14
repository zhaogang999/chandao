<?php

/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/3/1
 * Time: 16:09
 */
class riskmanageModel extends model
{
    /**
     * Build a search form
     *
     * @param $actionURL  string
     * @param int $queryID
     * @access public
     * @return void
     */
    public function buildRiskManageSearchForm($actionURL, $queryID)
    {
        $this->config->riskmanage->search['queryID']   = $queryID;
        $this->config->riskmanage->search['actionURL'] = $actionURL;
        $this->loadModel('search')->setSearchParams($this->config->riskmanage->search);
    }

    /**
     * 获取流出问题列表
     *
     * @param  $status
     * @param $orderBy
     * @param $type
     * @param $queryID
     * @param $pager
     * @return array
     */
    public function getRiskManages($status = 'unclosed', $orderBy = 'id_desc', $type  = 'byModule', $queryID, $pager = null)
    {
        if ($type == 'bySearch')
        {
            if($queryID)
            {
                $query = $this->loadModel('search')->getQuery($queryID);
                if($query)
                {
                    $this->session->set('riskManageQuery', $query->sql);
                    $this->session->set('riskManageForm', $query->form);
                }
                else
                {
                    $this->session->set('riskManageQuery', ' 1 = 1');
                }
            }

            $riskManageQuery = $this->session->riskmanageQuery;
            $riskManageQuery = preg_replace('/`(\w+)`/', 't1.`$1`', $riskManageQuery);
            return $this->dao->select('t1.*')
                ->from(TABLE_RISKMANAGE)->alias('t1')
                ->where('t1.deleted')->eq('0')
                ->beginIF($status == 'unclosed')->andWhere('t1.stateTracking')->ne('closed')->fi()
                ->andWhere($riskManageQuery)
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
        else
        {
            return $this->dao->select('t1.*')
                ->from(TABLE_RISKMANAGE)->alias('t1')
                ->where('t1.deleted')->eq('0')
                ->beginIF($status == 'unclosed')->andWhere('t1.stateTracking')->ne('closed')->fi()
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
    }

    /**
     * Create a riskManage
     *
     * @access public
     * @return void
     */
    public function create()
    {
        $riskScore = $this->post->influence * $this->post->probability;

        $riskManage = fixer::input('post')
            ->add('openedDate', helper::now())
            ->add('openedBy', $this->app->user->account)
            ->add('riskScore', $riskScore)
            ->setDefault('monitoringTime', '0000-00-00')
            ->setDefault('influence,probability', '0')
            ->setIF($riskScore == 9, 'pri', 'H')
            ->setIF($riskScore < 9 and $riskScore >=4, 'pri', 'M')
            ->setIF($riskScore < 4, 'pri', 'L')
            ->join('mailto', ',')
            ->stripTags($this->config->riskmanage->editor->create['id'], $this->config->allowedTags)
            ->remove('uid')
            ->get();
        $riskManage = $this->loadModel('file')->processImgURL($riskManage, $this->config->riskmanage->editor->create['id'], $this->post->uid);

        $this->dao->insert(TABLE_RISKMANAGE)->data($riskManage)
            ->autoCheck()
            ->batchCheck($this->config->riskmanage->create->requiredFields, 'notempty')
            ->exec();
        if(!dao::isError())
        {
            $riskManageID = $this->dao->lastInsertID();
            $this->file->updateObjectID($this->post->uid, $riskManageID, 'riskmanage');
            $this->file->saveUpload('riskmanage', $riskManageID);
            
            return $riskManageID;
        }
    }

    /**
     * Update a riskManage.
     *
     * @param  int    $riskManageID
     * @access public
     * @return void
     */
    public function update($riskManageID)
    {
        $oldRiskManage = $this->getById($riskManageID);
        $riskScore = $this->post->influence * $this->post->probability;

        $riskManage = fixer::input('post')
            ->add('riskScore', $riskScore)
            ->setDefault('monitoringTime', '0000-00-00')
            ->setDefault('influence,probability', '0')
            ->setIF($riskScore == 9, 'pri', 'H')
            ->setIF($riskScore < 9 and $riskScore >=4, 'pri', 'M')
            ->setIF($riskScore < 4, 'pri', 'L')
            ->stripTags($this->config->riskmanage->editor->edit['id'], $this->config->allowedTags)
            ->join('mailto', ',')
            ->remove('uid,comment')
            ->get();

        $riskManage = $this->loadModel('file')->processImgURL($riskManage, $this->config->riskmanage->editor->edit['id'], $this->post->uid);
        $this->dao->update(TABLE_RISKMANAGE)->data($riskManage)
            ->autoCheck()
            ->batchCheck($this->config->riskmanage->edit->requiredFields, 'notempty')
            ->where('id')->eq((int)$riskManageID)
            ->exec();

        if(!dao::isError())
        {
            $this->file->updateObjectID($this->post->uid, $riskManageID, 'riskmanage');
            $changes = common::createChanges($oldRiskManage, $riskManage);
            
            return $changes;
        }
    }

    /**
     * Get a riskManage info.
     *
     * @param  int    $riskManageID
     * @param  bool   $setImgSize
     * @access public
     * @return object
     */
    public function getById($riskManageID, $setImgSize = false)
    {
        $riskManage = $this->dao->select('t1.*')
            ->from(TABLE_RISKMANAGE)->alias('t1')
            ->where('t1.id')->eq((int)$riskManageID)
            ->fetch();
        if(!$riskManage) return false;

        $riskManage = $this->loadModel('file')->replaceImgURL($riskManage, 'comment');
        //$riskManage->files = $this->loadModel('file')->getByObject('riskmanage', $riskManageID);
        if($setImgSize)
        {
            //$riskManage->comment = $this->file->setImgSize($riskManage->comment);
            //$riskManage->countermeasure = $this->file->setImgSize($riskManage->countermeasure);
        }

        return $riskManage;
    }

    /**
     * Send mail.
     *
     * @param  int    $riskManageID
     * @param  int    $actionID
     * @access public
     * @return void
     */
    public function sendmail($riskManageID, $actionID)
    {
        $this->loadModel('mail');
        $riskManage = $this->getById($riskManageID);
        $users    = $this->loadModel('user')->getPairs('noletter');

        /* Get action info. */
        $action          = $this->loadModel('action')->getById($actionID);
        $history         = $this->action->getHistory($actionID);
        $action->history = isset($history[$actionID]) ? $history[$actionID] : array();

        /* Get mail content. */
        $modulePath = $this->app->getModulePath($appName = '', 'riskmanage');
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
        $ccList   = str_replace(' ', '', trim($riskManage->mailto, ','));
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
            $mailTitle = sprintf($this->lang->riskmanage->mail->create->title, $this->app->user->realname, $riskManageID, $this->post->title);
        }
        elseif($action->action == 'closed')
        {
            $mailTitle = sprintf($this->lang->riskmanage->mail->close->title, $this->app->user->realname, $riskManageID, $riskManage->title);
        }
        else
        {
            $mailTitle = sprintf($this->lang->riskmanage->mail->edit->title, $this->app->user->realname, $riskManageID, $this->post->title);
        }

        /* Send mail. */
        $this->mail->send($toList, $mailTitle, $mailContent, $ccList);
        if($this->mail->isError()) trigger_error(join("\n", $this->mail->getError()));
    }

    /**
     * Close a task.
     *
     * @param  int      $riskID
     * @access public
     * @return void
     */
    public function close($riskID)
    {
        $oldRisk = $this->dao->select('*')->from(TABLE_RISKMANAGE)->where('id')->eq($riskID)->fetch();

        $now  = helper::now();
        $risk = fixer::input('post')
            ->setDefault('stateTracking', 'closed')
            ->setDefault('closedBy', $this->app->user->account)
            ->setDefault('closedDate', $now)
            ->get();

        $this->dao->update(TABLE_RISKMANAGE)->data($risk)->autoCheck()->where('id')->eq((int)$riskID)->exec();

        if(!dao::isError())
        {
            $this->loadModel('score')->create('riskmanage', 'close', $riskID);
            return common::createChanges($oldRisk, $risk);
        }
    }
    
    /**
     * Get risk list.
     *
     * @param  int|array|string    $riskIDList
     * @access public
     * @return array
     */
    public function getByList($riskIDList = 0)
    {
        return $this->dao->select('*')->from(TABLE_RISKMANAGE)
            ->where('deleted')->eq(0)
            ->beginIF($riskIDList)->andWhere('id')->in($riskIDList)->fi()
            ->fetchAll('id');
    }

    /**
     * Adjust the action is clickable.
     *
     * @param  string $object
     * @param  string $action
     * @access public
     * @return void
     */
    public static function isClickable($object, $action)
    {
        $action = strtolower($action);
        if($action == 'close')      return $object->stateTracking != 'closed';

        return true;
    }
}