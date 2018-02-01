<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/1/30
 * Time: 15:13
 */
class myRelease extends release
{
    /**
     * View a release.
     *
     * @param  int    $releaseID
     * @access public
     * @return void
     */
    public function view($releaseID, $type = 'story', $link = 'false', $param = '')
    {
        if($type == 'story') $this->session->set('storyList', $this->app->getURI(true));
        if($type == 'bug' or $type == 'leftBug') $this->session->set('bugList', $this->app->getURI(true));

        $this->loadModel('story');
        $this->loadModel('bug');

        $release = $this->release->getById((int)$releaseID, true);
        if(!$release) die(js::error($this->lang->notFound) . js::locate('back'));

        $stories = $this->dao->select('*')->from(TABLE_STORY)->where('id')->in($release->stories)->andWhere('deleted')->eq(0)->fetchAll('id');
        $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'story');
        $stages = $this->dao->select('*')->from(TABLE_STORYSTAGE)->where('story')->in($release->stories)->andWhere('branch')->eq($release->branch)->fetchPairs('story', 'stage');
        foreach($stages as $storyID => $stage)$stories[$storyID]->stage = $stage;
        
        //12332 进度预警-待发布需求列表中增加用户需求ID和创建人
        foreach($stories as $story)
        {
            if (!empty($story->linkStories))
            {
                $relatedStories = $this->dao->select('id,openedBy')->from(TABLE_STORY) ->where('id')->in(trim($story->linkStories, ','))->fetchPairs();
                $users = $this->loadModel('user')->getPairs('noletter');
                foreach ($relatedStories as $relatedStory)
                {
                    $story->linkStoryOpenedBys .= $users[$relatedStory] . ' ';
                };
                $story->linkStoryOpenedBys = implode(' ', array_unique(explode(' ',trim($story->linkStoryOpenedBys))));
            }
        }

        $bugs    = $this->dao->select('*')->from(TABLE_BUG)->where('id')->in($release->bugs)->andWhere('deleted')->eq(0)->fetchAll();
        $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'linkedBug');

        $leftBugs = $this->dao->select('*')->from(TABLE_BUG)->where('id')->in($release->leftBugs)->andWhere('deleted')->eq(0)->fetchAll();
        $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'leftBugs');

        $this->commonAction($release->product);
        $products = $this->product->getPairs();

        $this->view->title         = "RELEASE #$release->id $release->name/" . $products[$release->product];
        $this->view->position[]    = $this->lang->release->view;
        $this->view->release       = $release;
        $this->view->stories       = $stories;
        $this->view->bugs          = $bugs;
        $this->view->leftBugs      = $leftBugs;
        $this->view->actions       = $this->loadModel('action')->getList('release', $releaseID);
        $this->view->users         = $this->loadModel('user')->getPairs('noletter');
        $this->view->type          = $type;
        $this->view->link          = $link;
        $this->view->param         = $param;
        $this->view->branchName    = $release->productType == 'normal' ? '' : $this->loadModel('branch')->getById($release->branch);
        $this->display();
    }
}