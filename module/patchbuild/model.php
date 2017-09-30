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
     * Create a patchBuild
     *
     * @param  int    $projectID
     * @access public
     * @return void
     */
    public function createPatchBuild($projectID)
    {
        $build = fixer::input('post')
            ->setDefault('product', 0)
            ->setDefault('patchDate', helper::today())
            ->join('mailto', ',')
            ->add('project', (int)$projectID)
            ->stripTags($this->config->patchbuild->editor->createpatchbuild['id'], $this->config->allowedTags)
            //->remove('resolvedBy,allchecker,files,labels,uid')
            ->get();

        //$build = $this->loadModel('file')->processEditor($build, $this->config->build->editor->create['id'], $this->post->uid);
        $this->dao->insert(TABLE_PATCHBUILD)->data($build)
            ->autoCheck()
            ->batchCheck($this->config->build->createPatchBuild->requiredFields, 'notempty')
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
        //if(!isset($build->branch)) $build->branch = $oldBuild->branch;


        //$build = $this->loadModel('file')->processEditor($build, $this->config->build->editor->editBatchBuild['id'], $this->post->uid);
        $this->dao->update(TABLE_PATCHBUILD)->data($build)
            ->autoCheck()
            //->batchCheck($this->config->build->editBatchBuild->requiredFields, 'notempty')
            ->where('id')->eq((int)$buildID)
            ->check('name', 'unique', "id != $buildID AND product = {$build->product} AND deleted = '0'")
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
     * @param  object    $pager
     * @access public
     * @return array
     */
    public function getProjectPatchBuild($projectID, $orderBy = 'id_desc', $pager = null)
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
     * @param  object    $pager
     * @access public
     * @return array
     */
    public function getProductPatchBuild($productID, $orderBy = 'id_desc', $pager = null)
    {
        return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
            ->from(TABLE_PATCHBUILD)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.product')->eq((int)$productID)
            ->andWhere('t1.deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
    }

    /**
     * Set menu.
     *
     * @param  array  $products
     * @param  int    $productID
     * @param  int    $branch
     * @access public
     * @return void
     */
    public function setMenu($products, $productID, $branch = 0)
    {
        $this->loadModel('product')->setMenu($products, $productID, $branch);
        $selectHtml = $this->product->select($products, $productID, 'qa', 'index', '', $branch);
        foreach($this->lang->qa->menu as $key => $menu)
        {
            $replace = ($key == 'product') ? $selectHtml : $productID;
            common::setMenuVars($this->lang->qa->menu, $key, $replace);
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
}