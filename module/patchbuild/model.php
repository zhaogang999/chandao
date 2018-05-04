<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/8/20
 * Time: 14:51
 */
class patchbuildModel extends model
{
    /**
 * Build a search form
 *
 * @param $actionURL  string
 * @param int $queryID
 * @access public
 * @return void
 */
    public function buildPatchBuildSearchForm($actionURL, $queryID)
    {
        $this->config->patchbuild->search['queryID']   = $queryID;
        $this->config->patchbuild->search['actionURL'] = $actionURL;
        $this->loadModel('search')->setSearchParams($this->config->patchbuild->search);
    }
    
    /**
     * Create a patchBuild
     *
     * @param  int    $projectID
     * @param  int    $productID
     * @access public
     * @return void
     */
    public function createPatchBuild($projectID, $productID)
    {
        $build = fixer::input('post')
            ->setDefault('product', 0)
            ->setDefault('patchDate', helper::today())
            ->join('mailto', ',')
            ->add('project', (int)$projectID)
            ->add('product', (int)$productID)
            ->stripTags($this->config->patchbuild->editor->createpatchbuild['id'], $this->config->allowedTags)
            //->remove('resolvedBy,allchecker,files,labels,uid')
            ->get();

        //$build = $this->loadModel('file')->processEditor($build, $this->config->build->editor->create['id'], $this->post->uid);
        $this->dao->insert(TABLE_PATCHBUILD)->data($build)
            ->autoCheck()
            ->batchCheck($this->config->patchbuild->createpatchbuild->requiredFields, 'notempty')
            //->check("product = {$build->product} AND deleted = '0'")
            ->exec();
        if(!dao::isError())
        {
            $buildID = $this->dao->lastInsertID();
            //$this->file->updateObjectID($this->post->uid, $buildID, 'build');
            //$this->file->saveUpload('build', $buildID);
            return $buildID;
        }
    }

    /**
     * Update a patchBuild.
     *
     * @param  int    $buildID
     * @access public
     * @return void
     */
    public function updateBatchBuild($buildID)
    {
        $oldBuild = $this->getPatchBuildById($buildID);
        $build = fixer::input('post')
            ->stripTags($this->config->patchbuild->editor->editpatchbuild['id'], $this->config->allowedTags)
            ->join('mailto', ',')
            ->remove('files,uid')
            ->get();

        if ($build->project !== $oldBuild->project)
        {
            $project = $this->loadModel('project')->getById($build->project);
            if ($project->lockPatchBuild == '1') die(js::error('该项目提交已冻结，如有疑问，请联系测试组'));
        }

        //$build = $this->loadModel('file')->processEditor($build, $this->config->build->editor->editBatchBuild['id'], $this->post->uid);
        $this->dao->update(TABLE_PATCHBUILD)->data($build)
            ->autoCheck()
            ->batchCheck($this->config->patchbuild->editpatchbuild->requiredFields, 'notempty')
            ->where('id')->eq((int)$buildID)
            ->check('name', 'unique', "id != $buildID AND deleted = '0'")
            ->exec();
        //if(isset($build->branch) and $oldBuild->branch != $build->branch) $this->dao->update(TABLE_RELEASE)->set('branch')->eq($build->branch)->where('build')->eq($buildID)->exec();
        if(!dao::isError())
        {
            $this->file->updateObjectID($this->post->uid, $buildID, 'build');
            return common::createChanges($oldBuild, $build);
        }
    }

    /**
     * Get patchBuilds of a project.
     *
     * @param  int    $projectID
     * @param  string    $orderBy
     * @param  string    $type
     * @param  int    $queryID
     * @param  object    $pager
     * @access public
     * @return array
     */
    public function getProjectPatchBuild($projectID, $orderBy = 'id_desc', $type  = 'byModule', $queryID, $pager = null)
    {
        if ($type == 'bySearch')
        {
            if($queryID)
            {
                $query = $this->loadModel('search')->getQuery($queryID);
                if($query)
                {
                    $this->session->set('patchbuildQuery', $query->sql);
                    $this->session->set('patchbuildForm', $query->form);
                }
                else
                {
                    $this->session->set('patchbuildQuery', ' 1 = 1');
                }
            }
           /* else
            {
                if($this->session->taskQuery == false) $this->session->set('patchbuildQuery', ' 1 = 1');
            }*/
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
            return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
                ->from(TABLE_PATCHBUILD)->alias('t1')
                ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
                ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
                ->where('t1.project')->eq((int)$projectID)
                ->andWhere('t1.deleted')->eq(0)
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
    }

    /**
     * Get last patchBuild.
     *
     * @param  int    $productID
     * @access public
     * @return bool | object
     */
    public function getLastPatchBuild($productID)
    {
        return $this->dao->select('id, version')->from(TABLE_PATCHBUILD)
            ->where('product')->eq((int)$productID)
            ->orderBy('id DESC')
            ->limit(1)
            ->fetch();
    }

    /**
     * Get build info.
     *
     * @param  int    $buildID
     * @param  bool   $setImgSize
     * @access public
     * @return object
     */
    public function getPatchBuildById($buildID, $setImgSize = false)
    {
        $build = $this->dao->select('t1.*, t2.name as projectName, t3.name as productName, t3.type as productType')
            ->from(TABLE_PATCHBUILD)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.id')->eq((int)$buildID)
            ->fetch();
        if(!$build) return false;

        $build->files = $this->loadModel('file')->getByObject('patchBuild', $buildID);
        if($setImgSize) $build->patchContent = $this->file->setImgSize($build->patchContent);
        return $build;
    }

    /**
     * Get patchBuilds of a product.
     *
     * @param  int    $productID
     * @param  string    $orderBy
     * @param  string    $type
     * @param  int    $queryID
     * @param  object    $pager
     * @access public
     * @return array
     */
    public function getProductPatchBuild($productID, $orderBy = 'id_desc', $type  = 'byModule', $queryID = 0, $pager = null)
    {
        if ($type == 'bySearch')
        {
            if($queryID)
            {
                $query = $this->loadModel('search')->getQuery($queryID);
                if($query)
                {
                    $this->session->set('patchbuildQuery', $query->sql);
                    $this->session->set('patchbuildForm', $query->form);
                }
                else
                {
                    $this->session->set('patchbuildQuery', ' 1 = 1');
                }
            }
            /*else
            {
                if($this->session->taskQuery == false) $this->session->set('patchbuildQuery', ' 1 = 1');
            }*/

            $patchBuildQuery = $this->session->patchbuildQuery;
            $patchBuildQuery = preg_replace('/`(\w+)`/', 't1.`$1`', $patchBuildQuery);

            return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
                ->from(TABLE_PATCHBUILD)->alias('t1')
                ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
                ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
                ->where('t1.deleted')->eq(0)
                ->beginIF($productID)->andWhere('t1.product')->eq((int)$productID)->fi()
                ->andwhere($patchBuildQuery)
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
        else
        {
            return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
                ->from(TABLE_PATCHBUILD)->alias('t1')
                ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
                ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
                ->where('t1.deleted')->eq(0)
                ->beginIF($productID)->andWhere('t1.product')->eq((int)$productID)->fi()
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll();
        }
    }

    /**
     * Set menu.
     *
     * @param  array  $products
     * @param  int    $productID
     * @access public
     * @return void
     */
    public function setMenu($products, $productID)
    {
        //var_dump($objectID);die;
        if ($productID == '0')
        {
            $productID = 2;
        }

        $this->loadModel('product')->setMenu($products, $productID);
        $selectHtml = $this->product->select($products, $productID, 'patchbuild', 'patchbuild', 'qa');
        foreach($this->lang->patchbuild->menu as $key => $menu)
        {
            $replace = ($key == 'product') ? $selectHtml : $productID;
            common::setMenuVars($this->lang->patchbuild->menu, $key, $replace);
        }

    }

    /**
     * Send mail.
     *
     * @param  int    $buildID
     * @param  int    $actionID
     * @access public
     * @return void
     */
    public function sendmail($buildID, $actionID)
    {
        $this->loadModel('mail');
        $patchBuild = $this->getPatchBuildById($buildID);
        $users    = $this->loadModel('user')->getPairs('noletter');

        /* Get action info. */
        $action          = $this->loadModel('action')->getById($actionID);
        $history         = $this->action->getHistory($actionID);
        $action->history = isset($history[$actionID]) ? $history[$actionID] : array();

        /* Get mail content. */
        $modulePath = $this->app->getModulePath($appName = '', 'patchbuild');
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
        $toList   = $patchBuild->assignedTo . ',' . $patchBuild->submitter;
        $toList = trim($toList, ',');
        $ccList   = str_replace(' ', '', trim($patchBuild->mailto, ','));
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
            $mailTitle = sprintf($this->lang->patchbuild->mail->create->title, $this->app->user->realname, $buildID, $this->post->version);
        }
        elseif($action->action == 'closed')
        {
            $mailTitle = sprintf($this->lang->patchbuild->mail->close->title, $this->app->user->realname, $buildID, $patchBuild->version);
        }
        else
        {
            $mailTitle = sprintf($this->lang->patchbuild->mail->edit->title, $this->app->user->realname, $buildID, $this->post->version);
        }

        /* Send mail. */
        $this->mail->send($toList, $mailTitle, $mailContent, $ccList);
        if($this->mail->isError()) trigger_error(join("\n", $this->mail->getError()));
    }

    /**
     * Link stories
     *
     * @param  int    $buildID
     * @access public
     * @return void
     */
    public function linkStory($buildID)
    {
        $build = $this->getPatchBuildById($buildID);

        $build->linkStories .= ',' . join(',', $this->post->stories);
        $this->dao->update(TABLE_PATCHBUILD)->set('linkStories')->eq($build->linkStories)->where('id')->eq((int)$buildID)->exec();
        foreach($this->post->stories as $storyID)
        {
            $this->loadModel('action')->create('story', $storyID, 'linked2patchbuild', '', $buildID);
        }
    }

    /**
     * Unlink story
     *
     * @param  int    $buildID
     * @param  int    $storyID
     * @access public
     * @return void
     */
    public function unlinkStory($buildID, $storyID)
    {
        $build = $this->getPatchBuildById($buildID);
        $build->linkStories = trim(str_replace(",$storyID,", ',', ",$build->linkStories,"), ',');
        $this->dao->update(TABLE_PATCHBUILD)->set('linkStories')->eq($build->linkStories)->where('id')->eq((int)$buildID)->exec();
        $this->loadModel('action')->create('story', $storyID, 'unlinkedfrompatchbuild', '', $buildID);
    }

    /**
     * Batch unlink story.
     *
     * @param  int    $buildID
     * @access public
     * @return void
     */
    public function batchUnlinkStory($buildID)
    {
        $storyList = $this->post->unlinkStories;
        if(empty($storyList)) return true;

        $build = $this->getPatchBuildById($buildID);
        $build->linkStories = ",$build->linkStories,";
        foreach($storyList as $storyID) $build->linkStories = str_replace(",$storyID,", ',', $build->linkStories);
        $build->linkStories = trim($build->linkStories, ',');
        $this->dao->update(TABLE_PATCHBUILD)->set('linkStories')->eq($build->linkStories)->where('id')->eq((int)$buildID)->exec();
        foreach($this->post->unlinkStories as $unlinkStoryID)
        {
            $this->loadModel('action')->create('story', $unlinkStoryID, 'unlinkedfrompatchbuild', '', $buildID);
        }
    }
    
    /**
     * Link bugs.
     *
     * @param  int    $buildID
     * @access public
     * @return void
     */
    public function linkBug($buildID)
    {
        $build = $this->getPatchBuildById($buildID);
        $build->linkBugs .= ',' . join(',', $this->post->bugs);
        $this->dao->update(TABLE_PATCHBUILD)->set('linkBugs')->eq($build->linkBugs)->where('id')->eq((int)$buildID)->exec();
        foreach($this->post->bugs as $bugID)
        {
            $this->loadModel('action')->create('bug', $bugID, 'linked2patchbuild', '', $buildID);
        }
    }

    /**
     * Unlink bug.
     *
     * @param  int    $buildID
     * @param  int    $bugID
     * @access public
     * @return void
     */
    public function unlinkBug($buildID, $bugID)
    {
        $build = $this->getPatchBuildById($buildID);
        $build->linkBugs = trim(str_replace(",$bugID,", ',', ",$build->linkBugs,"), ',');
        $this->dao->update(TABLE_PATCHBUILD)->set('linkBugs')->eq($build->linkBugs)->where('id')->eq((int)$buildID)->exec();
        $this->loadModel('action')->create('bug', $bugID, 'unlinkedfrompatchbuild', '', $buildID);
    }

    /**
     * Batch unlink bug.
     *
     * @param  int    $buildID
     * @access public
     * @return void
     */
    public function batchUnlinkBug($buildID)
    {
        $bugList = $this->post->unlinkBugs;
        if(empty($bugList)) return true;

        $build = $this->getPatchBuildById($buildID);
        $build->linkBugs = ",$build->linkBugs,";
        foreach($bugList as $bugID) $build->linkBugs = str_replace(",$bugID,", ',', $build->linkBugs);
        $build->linkBugs = trim($build->linkBugs, ',');
        $this->dao->update(TABLE_PATCHBUILD)->set('linkBugs')->eq($build->linkBugs)->where('id')->eq((int)$buildID)->exec();
        foreach($this->post->unlinkBugs as $unlinkBugID)
        {
            $this->loadModel('action')->create('bug', $unlinkBugID, 'unlinkedfrompatchbuild', '', $buildID);
        }
    }
    
    /**
     * Update linked bug to resolved.
     *
     * @param  object    $build
     * @access public
     * @return void
     */
    public function updateLinkedBug($build)
    {
        $bugs = empty($build->bugs) ? '' : $this->dao->select('*')->from(TABLE_BUG)->where('id')->in($build->bugs)->fetchAll();
        $data = fixer::input('post')->get();
        $now  = helper::now();

        $resolvedPairs = array();
        if(isset($_POST['bugs']))
        {
            foreach($data->linkBugs as $key => $bugID)
            {
                if(isset($_POST['resolvedBy'][$key]))$resolvedPairs[$bugID] = $data->resolvedBy[$key];
            }
        }

        $this->loadModel('action');
        if(!$bugs) return false;
        foreach($bugs as $bug)
        {
            if($bug->status == 'resolved' or $bug->status == 'closed') continue;

            $bug->resolvedBy     = $resolvedPairs[$bug->id];
            $bug->resolvedDate   = $now;
            $bug->status         = 'resolved';
            $bug->confirmed      = 1;
            $bug->assignedDate   = $now;
            $bug->assignedTo     = $bug->openedBy;
            $bug->lastEditedBy   = $this->app->user->account;
            $bug->lastEditedDate = $now;
            $bug->resolution     = 'fixed';
            $bug->resolvedBuild  = $build->name;
            $this->dao->update(TABLE_BUG)->data($bug)->where('id')->eq($bug->id)->exec();
            $this->action->create('bug', $bug->id, 'Resolved', '', 'fixed', $bug->resolvedBy);
        }
    }
}