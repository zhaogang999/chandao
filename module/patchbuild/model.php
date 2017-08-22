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
            ->add('project', (int)$projectID)
            ->stripTags($this->config->build->editor->createPatchBuild['id'], $this->config->allowedTags)
            //->remove('resolvedBy,allchecker,files,labels,uid')
            ->get();

        //$build = $this->loadModel('file')->processEditor($build, $this->config->build->editor->create['id'], $this->post->uid);
        $this->dao->insert(TABLE_PATCHBUILD)->data($build)
            ->autoCheck()
            ->batchCheck($this->config->build->createPatchBuild->requiredFields, 'notempty')
            ->check("product = {$build->product} AND deleted = '0'")
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
     * Update a build.
     *
     * @param  int    $buildID
     * @access public
     * @return void
     */
    public function updateBatchBuild($buildID)
    {
        $oldBuild = $this->getPatchBuildById($buildID);
        $build = fixer::input('post')->stripTags($this->config->build->editor->editBatchBuild['id'], $this->config->allowedTags)
            ->remove('files,uid')
            ->get();
        //if(!isset($build->branch)) $build->branch = $oldBuild->branch;

        $build = $this->loadModel('file')->processEditor($build, $this->config->build->editor->editBatchBuild['id'], $this->post->uid);
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
     * Get bugBuilds of a project.
     *
     * @param  int    $projectID
     * @access public
     * @return array
     */
    public function getProjectPatchBuild($projectID)
    {
        return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
            ->from(TABLE_PATCHBUILD)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.project')->eq((int)$projectID)
            ->andWhere('t1.deleted')->eq(0)
            ->orderBy('t1.id desc')
            ->fetchAll();
    }

    /**
     * Get last build.
     *
     * @param  int    $projectID
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
     * Get bugBuilds of a product.
     *
     * @param  int    $projectID
     * @access public
     * @return array
     */
    public function getProductPatchBuild($productID)
    {
        return $this->dao->select('t1.*, t2.name as projectName, t3.name as productName')
            ->from(TABLE_PATCHBUILD)->alias('t1')
            ->leftJoin(TABLE_PROJECT)->alias('t2')->on('t1.project = t2.id')
            ->leftJoin(TABLE_PRODUCT)->alias('t3')->on('t1.product = t3.id')
            ->where('t1.product')->eq((int)$productID)
            ->andWhere('t1.deleted')->eq(0)
            ->orderBy('t1.id desc')
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
}