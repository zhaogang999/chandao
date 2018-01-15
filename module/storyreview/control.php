<?php

/**
 * The control file of storyReview module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     storyReview
 * @version     20171214
 */
class storyreview extends control
{
    public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);
        /* Load need modules. */
        $this->loadModel('storyreview');
    }

    /**
     * 需求评审单列表页
     * 
     * @param $objectID
     * @param $from
     * @param string $type
     * @param int $param
     * @param string $orderBy
     * @param int $recTotal
     * @param int $recPerPage
     * @param int $pageID
     */
    public function storyreview($objectID, $from, $type = 'byModule', $param = 0, $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->loadModel('project');

        $this->session->set('storyReviewList', $this->app->getURI(true));
        $queryID   = ($type == 'bySearch')  ? (int)$param : 0;

        $table  = $from == 'qa' ? TABLE_PRODUCT : TABLE_PROJECT;
        $object = $this->dao->select('id,name')->from($table)->where('id')->eq($objectID)->fetch();

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        if($from == 'qa')
        {
            $this->lang->storyreview->menu      = $this->lang->storyreview->qa;
            $this->lang->storyreview->menuOrder = $this->lang->qa->menuOrder;

            //$this->storyreview->setMenu($this->product->getPairs(), $objectID);
            $this->lang->set('menugroup.storyreview', 'qa');
            $this->view->product       = $object;
            //$this->view->position[] = html::a(helper::createLink('product', 'browse', "productID=$objectID"), $object->name);
            $this->view->position[]   = $this->lang->storyreview->storyreview;
            /* Header and position. */
            $this->view->title        = $this->lang->colon . $this->lang->storyreview->storyreview;
            $this->view->storyReviews = $this->storyreview->getStoryReviews((int)$objectID, $from, $sort, $type, $queryID, $pager);
            $actionURL    = $this->createLink('storyreview', 'storyreview', "productID=0&from=qa&type=bySearch&param=myQueryID");
        }
        elseif($from == 'project')
        {
            $this->lang->storyreview->menu      = $this->lang->project->menu;
            $this->lang->storyreview->menuOrder = $this->lang->project->menuOrder;
            $this->project->setMenu($this->project->getPairs('nocode'), $objectID, 'project');
            $this->lang->set('menugroup.storyreview', 'project');
            $this->view->project      = $object;
            //$this->view->products      = $this->project->getProducts($object->id);
            /* Header and position. */
            $this->view->title        = $object->name . $this->lang->colon . $this->lang->storyreview->storyreview;
            $this->view->position[]   = html::a(helper::createLink('product', 'browse', "productID=$objectID"), $object->name);
            $this->view->position[]   = $this->lang->storyreview->storyreview;
            $this->view->storyReviews = $this->storyreview->getStoryReviews((int)$object->id, $from, $sort, $type, $queryID, $pager);
            $actionURL    = $this->createLink('storyreview', 'storyreview', "objectID=$object->id&from=project&type=bySearch&param=myQueryID");
        }

        $this->storyreview->buildStoryReviewSearchForm($actionURL, $queryID);

        $this->view->users      = $this->loadModel('user')->getPairs('noletter');
        $this->view->from       = $from;
        $this->view->type       = $type;
        $this->view->object     = $object;
        $this->view->pager      = $pager;
        $this->view->orderBy    = $orderBy;
        $this->view->objectID   = $objectID;
        $this->view->param      = $param;

        $this->display();
    }

    /**
     * 创建需求评审单
     *
     * @param $projectID
     * @param $type
     */
    public function create($projectID, $type = '')
    {
        if(!empty($_POST))
        {
            $storyReviewListID = $this->storyreview->create($projectID, $type);
            if(dao::isError()) die(js::error(dao::getError()));
            
            $actionID = $this->loadModel('action')->create('storyreview', $storyReviewListID, 'opened');

            $this->storyreview->sendmail($storyReviewListID, $actionID);
            die(js::locate($this->createLink('storyreview', 'storyreview', "objectID=$projectID&from=project"), 'parent'));
        }

        /* Load these models. */
        $this->loadModel('project');
        $this->loadModel('user');

        $this->lang->storyreview->menu          = $this->lang->project->menu;
        $this->lang->menugroup->storyreview     = 'project';

        
        /* Set menu. */
        $this->project->setMenu($this->project->getPairs(), $projectID);

        /* Assign. */
        $project = $this->loadModel('project')->getById($projectID);

        //$productGroups = $this->project->getProducts($projectID);
        //$productID     = key($productGroups);
        //$products      = array();
        //foreach($productGroups as $product) $products[$product->id] = $product->name;

        $this->view->title         = $project->name . $this->lang->colon . $this->lang->storyreview->create;
        $this->view->position[]    = html::a($this->createLink('project', 'task', "projectID=$projectID"), $project->name);
        $this->view->position[]    = $this->lang->storyreview->create;
        //$this->view->product       = isset($productGroups[$productID]) ? $productGroups[$productID] : '';
        $this->view->projectID     = $projectID;
        $this->view->stories       = $this->storyreview->getStoryPairs($projectID);
        //$this->view->products      = $products;
        //$this->view->productGroups = $productGroups;
        $this->view->users         = $this->user->getPairs('nodeleted|noclosed');
        $this->display();
    }

    /**
     * Edit a storyReview.
     *
     * @param  int    $storyReviewID
     * @param int $objectID
     * @param string $from
     * @param $type
     * @access public
     * @return void
     */
    public function edit($storyReviewID, $objectID, $from,  $type = '')
    {
        $this->loadModel('project');
        $this->loadModel('story');

        if(!empty($_POST))
        {
            $changes = $this->storyreview->update($storyReviewID, $from, $type);
            if(dao::isError()) die(js::error(dao::getError()));
            $files = $this->loadModel('file')->saveUpload('build', $storyReviewID);

            if($changes)
            {
                //$fileAction = '';
                //if(!empty($files)) $fileAction = $this->lang->addFiles . join(',', $files) . "\n" ;
                $actionID = $this->loadModel('action')->create('storyreview', $storyReviewID, 'Edited');
                if(!empty($changes)) $this->action->logHistory($actionID, $changes);

                /* send mail.*/
                $this->storyreview->sendmail($storyReviewID, $actionID);
            }
            if ($from == 'project')
            {
                die(js::locate($this->createLink('storyreview', 'view', "buildID=$storyReviewID&from=project"), 'parent'));
            }
            else
            {
                die(js::locate($this->createLink('storyreview', 'view', "buildID=$storyReviewID&from=qa"), 'parent'));
            }
        }

        $storyReview = $this->storyreview->getStoryReviewById((int)$storyReviewID);

        $storyReview->solvedProblem   = str_replace("<br />","\n",trim($storyReview->solvedProblem));
        $storyReview->risk            = str_replace("<br />","\n",$storyReview->risk);
        $storyReview->result          = str_replace("<br />","\n",$storyReview->result);
        $storyReview->influence       = str_replace("<br />","\n",$storyReview->influence);
        $storyReview->problemTracking = str_replace("<br />","\n",$storyReview->problemTracking);

        $orderBy     = 'status_asc, stage_asc, id_desc';

        if ($from == 'project')
        {
            $project = $this->loadModel('project')->getById($storyReview->project);
            if(empty($project))
            {
                $project = new stdclass();
                $project->name = '';
            }
            
            $this->loadModel('project')->setMenu($this->project->getPairs('nocode'), $objectID, 'project');
            
            /* Set menu. */
            $this->lang->storyreview->menu      = $this->lang->project->menu;
            $this->lang->menugroup->storyreview       = 'project';

            $this->view->position[] = html::a($this->createLink('storyreview', 'storyreview', "objectID=$storyReview->project&from=project"), $project->name);

            $this->view->stories    = $this->storyreview->getStoryPairs($objectID, $storyReview->reviewStories);

            $noclosedProjects = $this->project->getPairs('noclosed,nocode');
            unset($noclosedProjects[$storyReview->project]);
            $this->view->projects = array($storyReview->project => $project->name) + $noclosedProjects;
        }
        elseif ($from == 'qa')
        {
            /* Set menu. */
            $this->lang->storyreview->menu      = $this->lang->storyreview->qa;
            $this->lang->menugroup->storyreview       = 'qa';
            //$this->storyreview->setMenu($this->loadModel('product')->getPairs(), $objectID);

            $this->view->position[] = html::a($this->createLink('storyreview', 'storyreview', "objectID=0&from=qa"), $this->lang->storyreview->storyreview);
        }

        $this->view->position[] = $this->lang->storyreview->edit;
        $this->view->title      = $this->lang->storyreview->edit . $this->lang->colon . " #$storyReview->id $storyReview->title";
        //$this->view->product    = isset($productGroups[$storyReview->product]) ? $productGroups[$storyReview->product] : '';
        //$this->view->branches   = (isset($productGroups[$storyReview->product]) and $productGroups[$storyReview->product]->type == 'normal') ? array() : $this->loadModel('branch')->getPairs($storyReview->product);
        $this->view->orderBy       = $orderBy;

        //$this->view->projects      = $this->project->getPairs('noclosed,nocode');
        //$this->view->productGroups = $productGroups;
        //$this->view->products      = $products;
        $this->view->users         = $this->loadModel('user')->getPairs();
        $this->view->storyReview   = $storyReview;
        $this->view->from          = $from;

        $this->display();
    }

    /**
     * View a storyReview case.
     *
     * @param  int    $storyReviewID
     * @param  string $from
     * @access public
     * @return void
     */
    public function view($storyReviewID, $from = 'project')
    {
        $this->loadModel('project');
        $this->loadModel('product');
        
        $storyReview = $this->storyreview->getStoryReviewById((int)$storyReviewID);
        if(!$storyReview) die(js::error($this->lang->notFound) . js::locate('back'));

        if ($from == 'project')
        {
            $projects = $this->project->getPairs('empty');
            $this->loadModel('project')->setMenu($this->project->getPairs('nocode'), $storyReview->project, 'project');

            $this->lang->storyreview->menu      = $this->lang->project->menu;
            $this->lang->menugroup->storyreview       = 'project';
            $this->view->position[]    = html::a($this->createLink('project', 'task', "projectID=$storyReview->project"), $projects[$storyReview->project]);
            $this->view->position[]    = $this->lang->storyreview->storyreview;
            $this->view->position[]    = $this->lang->storyreview->view;
            $this->view->from = 'project';
            $this->view->objectID = $storyReview->project;
            $this->view->title         = "STORYREVIEW #$storyReview->id $storyReview->version - " . $projects[$storyReview->project];
        }
        elseif($from == 'qa')
        {
            $this->lang->storyreview->menu      = $this->lang->qa->menu;
            $this->lang->storyreview->menuOrder = $this->lang->qa->menuOrder;
            $this->lang->menugroup->storyreview       = 'qa';
            $product = $this->loadModel('product')->getById($storyReview->product);
            //$this->storyreview->setMenu($this->loadModel('product')->getPairs(), $storyReview->product);

            $this->view->position[]    = html::a($this->createLink('product', 'browse', "productID=$storyReview->product"), $product->name);
            $this->view->position[]    = $this->lang->storyreview->view;
            $this->view->from = 'qa';
            $this->view->objectID = $storyReview->product;
            $this->view->title         = "STORYREVIEW #$storyReview->id $storyReview->title - " . $product->name;
        }

        if(!empty($storyReview->reviewStories)) $storyReview->reviewStories = $this->dao->select('id,title')->from(TABLE_STORY)->where('id')->in($storyReview->reviewStories)->fetchPairs();

        /* Assign. */
        $this->view->users         = $this->loadModel('user')->getPairs('noletter');
        $this->view->storyReview   = $storyReview;
        $this->view->actions       = $this->loadModel('action')->getList('storyreview', $storyReviewID);
        
        $this->display();
    }

    /**
     * Delete a storyReview.
     *
     * @param  int    $storyReviewID
     * @param  string $confirm  yes|noe
     * @access public
     * @return void
     */
    public function delete($storyReviewID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->storyreview->confirmDelete, $this->createLink('storyreview', 'delete', "$storyReviewID=$storyReviewID&confirm=yes")));
        }
        else
        {
            $storyReview = $this->storyreview->getStoryReviewById($storyReviewID);
            $this->storyreview->delete(TABLE_STORYREVIEW, $storyReviewID);

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

            die(js::locate($this->createLink('storyreview', 'storyreview', "objectID=$storyReview->project&from=project"), 'parent'));
        }
    }
}