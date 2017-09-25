<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/8/20
 * Time: 14:45
 */

class patchbuild extends control
{
    public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);
        /* Load need modules. */
        $this->loadModel('patchbuild');
    }

    /**
     * 补丁版本列表页
     * 
     * @param int $objectID
     * @param string $from
     * @param string $orderBy
     * @param int $recTotal
     * @param int $recPerPage
     * @param int $pageID
     */
    public function patchBuild($objectID, $from, $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->loadModel('project');
        $this->loadModel('product');
        $this->loadModel('qa');

        $this->session->set('patchbuildList', $this->app->getURI(true));

        $table  = $from == 'qa' ? TABLE_PRODUCT : TABLE_PROJECT;
        $object = $this->dao->select('id,name')->from($table)->where('id')->eq($objectID)->fetch();

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        if($from == 'qa')
        {
            $this->lang->patchbuild->menu      = $this->lang->qa->menu;
            $this->lang->patchbuild->menuOrder = $this->lang->qa->menuOrder;

            $this->patchbuild->setMenu($this->product->getPairs(), $objectID);
            $this->lang->set('menugroup.patchbuild', 'qa');
            $this->view->product       = $object;
            $this->view->position[] = html::a(helper::createLink('product', 'browse', "productID=$objectID"), $object->name);
            $this->view->position[] = $this->lang->patchbuild->patchBuild;
            $this->view->patchBuilds = $this->patchbuild->getproductPatchBuild((int)$object->id, $sort, $pager);
        }
        elseif($from == 'project')
        {
            $this->lang->patchbuild->menu      = $this->lang->project->menu;
            $this->lang->patchbuild->menuOrder = $this->lang->project->menuOrder;
            $this->project->setMenu($this->project->getPairs('nocode'), $objectID, 'project');
            $this->lang->set('menugroup.patchbuild', 'project');
            $this->view->project       = $object;
            $this->view->products      = $this->project->getProducts($object->id);
            $this->view->position[] = html::a(helper::createLink('product', 'browse', "productID=$objectID"), $object->name);
            $this->view->position[] = $this->lang->patchbuild->patchBuild;
            $this->view->patchBuilds = $this->patchbuild->getProjectPatchBuild((int)$object->id, $sort, $pager);
        }

        /* Header and position. */
        $this->view->title      = $object->name . $this->lang->colon . $this->lang->patchbuild->patchBuild;
        //$this->view->position[] = $this->lang->project->patchBuild;
        $this->view->users  = $this->loadModel('user')->getPairs('noletter');
        $this->view->from   = $from;
        $this->view->object = $object;
        $this->view->pager       = $pager;
        $this->view->orderBy     = $orderBy;
        $this->view->objectID     = $objectID;

        $this->display();
    }

    /**
     * Create a patchBuld.
     *
     * @param  int    $projectID
     * @access public
     * @return void
     */
    public function createpatchbuild($projectID)
    {
        if(!empty($_POST))
        {
            $buildID = $this->patchbuild->createPatchBuild($projectID);
            if(dao::isError()) die(js::error(dao::getError()));
            
            $actionID = $this->loadModel('action')->create('patchBuild', $buildID, 'opened');

            $this->patchbuild->sendmail($buildID, $actionID);
            die(js::locate($this->createLink('patchbuild', 'patchBuild', "objectID=$projectID&from=project"), 'parent'));
        }

        /* Load these models. */
        $this->loadModel('product');
        $this->loadModel('project');
        $this->loadModel('user');

        $this->lang->patchbuild->menu      = $this->lang->project->menu;
        $this->lang->menugroup->patchbuild       = 'project';

        if($this->config->global->flow == 'onlyTest')
        {
            $product  = $this->product->getByID($projectID);
            $products = $this->product->getPairs();
            $this->product->setMenu($products, $projectID);

            $productGroups   = array();
            //$product->branch = 0;
            foreach($products as $productID => $name) $productGroups[$productID]['branch'] = 0;

            $this->view->title    = $this->lang->patchbuild->patchBuild;
            $this->view->product  = $product;
            //$this->view->branches = ($product and $product->type == 'normal') ? array() : $this->loadModel('branch')->getPairs($projectID);
        }
        else
        {
            /* Set menu. */
            $this->project->setMenu($this->project->getPairs(), $projectID);

            /* Get stories and bugs. */
            $orderBy  = 'status_asc, stage_asc, id_desc';

            /* Assign. */
            $project = $this->loadModel('project')->getById($projectID);

            $productGroups = $this->project->getProducts($projectID);
            $productID     = key($productGroups);
            $products      = array();
            foreach($productGroups as $product) $products[$product->id] = $product->name;

            $this->view->title         = $project->name . $this->lang->colon . $this->lang->patchbuild->createPatchBuild;
            $this->view->position[]    = html::a($this->createLink('project', 'task', "projectID=$projectID"), $project->name);
            $this->view->position[]    = $this->lang->patchbuild->createPatchBuild;
            $this->view->product       = isset($productGroups[$productID]) ? $productGroups[$productID] : '';
            //$this->view->branches      = (isset($productGroups[$productID]) and $productGroups[$productID]->type == 'normal') ? array() : $this->loadModel('branch')->getPairs($productID);
            $this->view->projectID     = $projectID;

            $this->view->orderBy       = $orderBy;

        }

        $this->view->products      = $products;
        $this->view->lastPatchBuild    = $this->patchbuild->getLastPatchBuild($product->id);
        $this->view->productGroups = $productGroups;
        $this->view->users         = $this->user->getPairs('nodeleted|noclosed');
        $this->display();
    }

    /**
     * Edit a batchBuild.
     *
     * @param  int    $buildID
     * @access public
     * @return void
     */
    public function editpatchbuild($buildID, $objectID, $from)
    {
        if(!empty($_POST))
        {
            $changes = $this->patchbuild->updateBatchBuild($buildID);
            if(dao::isError()) die(js::error(dao::getError()));
            //$files = $this->loadModel('file')->saveUpload('build', $buildID);

            if($changes)
            {
                //$fileAction = '';
                //if(!empty($files)) $fileAction = $this->lang->addFiles . join(',', $files) . "\n" ;
                $actionID = $this->loadModel('action')->create('patchbuild', $buildID, 'Edited');
                if(!empty($changes)) $this->action->logHistory($actionID, $changes);

                /* send mail.*/
                $this->patchbuild->sendmail($buildID, $actionID);
            }
            if ($from == 'project')
            {
                die(js::locate($this->createLink('patchbuild', 'patchBuild', "objectID=$objectID&from=project"), 'parent'));
            }
            else
            {
                die(js::locate($this->createLink('patchbuild', 'patchBuild', "objectID=$objectID&from=qa"), 'parent'));
            }
        }

        $build = $this->patchbuild->getPatchBuildById((int)$buildID);

        if ($from == 'project')
        {
            $this->loadModel('project')->setMenu($this->project->getPairs('nocode'), $objectID, 'project');
            $this->lang->patchbuild->menu      = $this->lang->project->menu;
            $this->lang->menugroup->patchbuild       = 'project';
        }
        elseif ($from == 'qa')
        {
            $this->patchbuild->setMenu($this->loadModel('product')->getPairs(), $objectID);
            $this->lang->patchbuild->menu      = $this->lang->qa->menu;
            $this->lang->menugroup->patchbuild       = 'qa';
        }

        if($this->config->global->flow == 'onlyTest')
        {

            $product  = $this->loadModel('product')->getById($build->product);
            $products = $this->product->getPairs();
            $this->product->setMenu($products, $build->product);

            $productGroups   = array();
            $product->branch = 0;
            foreach($products as $productID => $name) $productGroups[$productID]['branch'] = 0;

            $this->view->title      = $this->lang->patchbuild->editpatchbuild;
            $this->view->position[] = $this->lang->patchbuild->editpatchbuild;
            $this->view->product    = $product;
            $this->view->branches   = ($product and $product->type == 'normal') ? array() : $this->loadModel('branch')->getPairs($build->product);
        }
        else
        {
            $this->loadModel('project');

            /* Set menu. */
            //$this->project->setMenu($this->project->getPairs(), $build->project, '');

            /* Get stories and bugs. */
            $orderBy = 'status_asc, stage_asc, id_desc';

            /* Assign. */
            $project = $this->loadModel('project')->getById($build->project);
            if(empty($project))
            {
                $project = new stdclass();
                $project->name = '';
            }

            $productGroups = $this->project->getProducts($build->project);

            $products      = array();
            foreach($productGroups as $product) $products[$product->id] = $product->name;
            if(empty($productGroups) and $build->product)
            {
                $product = $this->loadModel('product')->getById($build->product);
                $products[$product->id] = $product->name;
            }

            $this->view->title      = $project->name . $this->lang->colon . $this->lang->patchbuild->editpatchbuild;
            $this->view->position[] = html::a($this->createLink('project', 'task', "projectID=$build->project"), $project->name);
            $this->view->position[] = $this->lang->patchbuild->editpatchbuild;
            $this->view->product    = isset($productGroups[$build->product]) ? $productGroups[$build->product] : '';
            $this->view->branches   = (isset($productGroups[$build->product]) and $productGroups[$build->product]->type == 'normal') ? array() : $this->loadModel('branch')->getPairs($build->product);
            $this->view->orderBy    = $orderBy;
        }
        
        $this->view->productGroups = $productGroups;
        $this->view->products      = $products;
        $this->view->users         = $this->loadModel('user')->getPairs();
        $this->view->build         = $build;
        $this->view->from          = $from;

        $this->display();
    }

    /**
     * Delete a patchbuild.
     *
     * @param  int    $buildID
     * @param  string $confirm  yes|noe
     * @access public
     * @return void
     */
    public function deletePatchBuild($buildID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->patchbuild->confirmDelete, $this->createLink('patchbuild', 'deletePatchBuild', "buildID=$buildID&confirm=yes")));
        }
        else
        {
            $build = $this->patchbuild->getPatchBuildById($buildID);
            $this->patchbuild->delete(TABLE_PATCHBUILD, $buildID);

            /* if ajax request, send result. */
            if($this->server->ajax)
            {
                if(dao::isError())
                {
                    $response['result']  = 'fail';
                    $response['message'] = dao::getError();
                }
                else
                {
                    $response['result']  = 'success';
                    $response['message'] = '';
                }
                $this->send($response);
            }

            if($this->config->global->flow == 'onlyTest') die(js::locate($this->createLink('project', 'patchBuild', "productID=$build->product"), 'parent'));

            die(js::locate($this->createLink('patchbuild', 'patchBuild', "objectID=$build->project&from=project"), 'parent'));
        }
    }

    /**
     * View a patchBuild case.
     *
     * @param  int    $buildID
     * @param  string $from
     * @access public
     * @return void
     */
    public function view($buildID, $from = 'project')
    {
        $this->loadModel('project');

        $build = $this->patchbuild->getPatchBuildById((int)$buildID);
        if(!$build) die(js::error($this->lang->notFound) . js::locate('back'));

        if ($from == 'project')
        {
            $projects = $this->project->getPairs('empty');
            $this->loadModel('project')->setMenu($this->project->getPairs('nocode'), $build->project, 'project');

            $this->lang->patchbuild->menu      = $this->lang->project->menu;
            $this->lang->menugroup->patchbuild       = 'project';
            $this->view->position[]    = html::a($this->createLink('project', 'task', "projectID=$build->project"), $projects[$build->project]);
            $this->view->position[]    = $this->lang->patchbuild->view;
            $this->view->from = 'project';
            $this->view->objectID = $build->project;
            $this->view->title         = "PATCHBUILD #$build->id $build->version - " . $projects[$build->project];
        }
        elseif($from == 'qa')
        {
            $product = $this->loadModel('product')->getById($build->product);
            $this->patchbuild->setMenu($this->loadModel('product')->getPairs(), $build->product);
            $this->lang->patchbuild->menu      = $this->lang->qa->menu;
            $this->lang->menugroup->patchbuild       = 'qa';
            $this->view->position[]    = html::a($this->createLink('product', 'browse', "productID=$build->product"), $product->name);
            $this->view->position[]    = $this->lang->patchbuild->view;
            $this->view->from = 'qa';
            $this->view->objectID = $build->product;
            $this->view->title         = "PATCHBUILD #$build->id $build->version - " . $product->name;
        }
        
        /* Assign. */
        $this->view->users         = $this->loadModel('user')->getPairs('noletter');
        $this->view->build         = $build;
        $this->view->actions       = $this->loadModel('action')->getList('patchbuild', $buildID);
        //$this->view->link          = $link;
        //$this->view->param         = $param;
        //$this->view->branchName    = $build->productType == 'normal' ? '' : $this->loadModel('branch')->getById($build->branch);
        $this->display();
    }
}