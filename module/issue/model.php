<?php

/**
 * The model file of issue module of ZenTaoPMS
 */
class issueModel extends model
{
    /**
     * Build a search form
     *
     * @param $actionURL  string
     * @param int $queryID
     * @access public
     * @return void
     */
    public function buildIssueSearchForm($actionURL, $queryID)
    {
        $this->config->issue->search['queryID']   = $queryID;
        $this->config->issue->search['actionURL'] = $actionURL;
        $this->loadModel('search')->setSearchParams($this->config->issue->search);
    }

    /**
     * 获取流出问题列表
     *
     * @param $orderBy
     * @param $type
     * @param $queryID
     * @param $pager
     * @return array
     */
    public function getIssues($orderBy = 'id_desc', $type  = 'byModule', $queryID, $pager = null)
    {
        if ($type == 'bySearch')
        {
            if($queryID)
            {
                $query = $this->loadModel('search')->getQuery($queryID);
                if($query)
                {
                    $this->session->set('issueQuery', $query->sql);
                    $this->session->set('issueForm', $query->form);
                }
                else
                {
                    $this->session->set('issueQuery', ' 1 = 1');
                }
            }
            
            $issueQuery = $this->session->issueQuery;
            $issueQuery = preg_replace('/`(\w+)`/', 't1.`$1`', $issueQuery);
            return $this->dao->select('t1.*')
                ->from(TABLE_ISSUE)->alias('t1')
                ->where('t1.deleted')->eq('0')
                ->andWhere($issueQuery)
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
        else
        {
            return $this->dao->select('t1.*')
                ->from(TABLE_ISSUE)->alias('t1')
                ->where('t1.deleted')->eq('0')
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
    }

    /**
     * Create a issue
     *
     * @access public
     * @return void
     */
    public function create($fromBug = 0)
    {
        $issue = fixer::input('post')
            ->setDefault('fromBug', 0)
            ->add('openedTime', helper::now())
            ->add('openedBy', $this->app->user->account)
            ->setIF($fromBug != 0, 'fromBug', $fromBug)
            ->join('mailto', ',')
            ->stripTags($this->config->issue->editor->create['id'], $this->config->allowedTags)
            ->remove('uid')
            ->get();
        $issue = $this->loadModel('file')->processImgURL($issue, $this->config->issue->editor->create['id'], $this->post->uid);

        $this->dao->insert(TABLE_ISSUE)->data($issue)
            ->autoCheck()
            ->exec();
        if(!dao::isError())
        {
            $issueID = $this->dao->lastInsertID();
            $this->file->updateObjectID($this->post->uid, $issueID, 'issue');
            $this->file->saveUpload('issue', $issueID);

            if($fromBug > 0) 
            {
                $bug = new stdclass();
                $bug->toIssue = $issueID;
                $this->dao->update(TABLE_BUG)->data($bug)->where('id')->eq($fromBug)->exec();
                $this->loadModel('action')->create('bug', $fromBug, 'toissue', '', $issueID);
            }
            elseif ($issue->frombug != 0)
            {
                $bug = new stdclass();
                $bug->toIssue = $issueID;
                $this->dao->update(TABLE_BUG)->data($bug)->where('id')->eq($fromBug)->exec();
            }
            return $issueID;
        }
    }

    /**
     * Update a issue.
     *
     * @param  int    $issueID
     * @access public
     * @return void
     */
    public function update($issueID)
    {
        $oldIssue = $this->getById($issueID);
        $issue = fixer::input('post')
            ->stripTags($this->config->issue->editor->edit['id'], $this->config->allowedTags)
            ->setDefault('fromBug', 0)
            ->join('mailto', ',')
            ->remove('uid,comment')
            ->get();

        $issue = $this->loadModel('file')->processImgURL($issue, $this->config->issue->editor->edit['id'], $this->post->uid);
        $this->dao->update(TABLE_ISSUE)->data($issue)
            ->autoCheck()
            ->where('id')->eq((int)$issueID)
            ->check('title', 'unique', "id != $issueID AND deleted = '0'")
            ->exec();

        if(!dao::isError())
        {
            $this->file->updateObjectID($this->post->uid, $issueID, 'issue');
            $changes = common::createChanges($oldIssue, $issue);
            foreach($changes as $change)
            {
                if ($change['field'] == 'fromBug')
                {
                    $this->dao->update(TABLE_BUG)->set('toIssue')->eq(0)->where('id')->eq($change['old'])->exec();
                    $this->dao->update(TABLE_BUG)->set('toIssue')->eq($issueID)->where('id')->eq($change['new'])->exec();
                }
            }
            return $changes;
        }
    }

    /**
     * Get a issue info.
     *
     * @param  int    $issueID
     * @param  bool   $setImgSize
     * @access public
     * @return object
     */
    public function getById($issueID, $setImgSize = false)
    {
        $issue = $this->dao->select('t1.*')
            ->from(TABLE_ISSUE)->alias('t1')
            ->where('t1.id')->eq((int)$issueID)
            ->fetch();
        if(!$issue) return false;

        $issue = $this->loadModel('file')->replaceImgURL($issue, 'comment,reason');
        //$issue->files = $this->loadModel('file')->getByObject('issue', $issueID);
        if($setImgSize)
        {
            //$issue->comment = $this->file->setImgSize($issue->comment);
            //$issue->countermeasure = $this->file->setImgSize($issue->countermeasure);
        }

        return $issue;
    }

    /**
     * Send mail.
     *
     * @param  int    $issueID
     * @param  int    $actionID
     * @access public
     * @return void
     */
    public function sendmail($issueID, $actionID)
    {
        $this->loadModel('mail');
        $issue = $this->getById($issueID);
        $users    = $this->loadModel('user')->getPairs('noletter');

        /* Get action info. */
        $action          = $this->loadModel('action')->getById($actionID);
        $history         = $this->action->getHistory($actionID);
        $action->history = isset($history[$actionID]) ? $history[$actionID] : array();

        /* Get mail content. */
        $modulePath = $this->app->getModulePath($appName = '', 'issue');
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
        $ccList   = str_replace(' ', '', trim($issue->mailto, ','));
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
            $mailTitle = sprintf($this->lang->issue->mail->create->issueDesc, $this->app->user->realname, $issueID, $this->post->issueDesc);
        }
        elseif($action->action == 'closed')
        {
            $mailTitle = sprintf($this->lang->issue->mail->close->issueDesc, $this->app->user->realname, $issueID, $issue->issueDesc);
        }
        else
        {
            $mailTitle = sprintf($this->lang->issue->mail->edit->issueDesc, $this->app->user->realname, $issueID, $this->post->issueDesc);
        }

        /* Send mail. */
        $this->mail->send($toList, $mailTitle, $mailContent, $ccList);
        if($this->mail->isError()) trigger_error(join("\n", $this->mail->getError()));
    }

}