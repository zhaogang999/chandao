<?php

/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/5/2
 * Time: 16:26
 */
include '../../control.php';
class myCustom extends custom
{
    /**
     * loginDefaultPage zentao.
     *
     * @access public
     * @return void
     */
    public function customStoryCollectPool()
    {
        if($_POST)
        {
            $customStoryCollectPool = substr($this->post->customStoryCollectPool, strrpos($this->post->customStoryCollectPool, '/'));
            $this->loadModel('setting')->setItem('system.custom.customStoryCollectPool', $customStoryCollectPool);
            die(js::reload('parent'));
        }

        $nowCustomStoryCollectPool = $this->dao->select('value')->from(TABLE_CONFIG)
            ->where('`key`')->eq('customStoryCollectPool')
            ->fetch('value');

        $this->view->nowCustomStoryCollectPool = $nowCustomStoryCollectPool;
        $this->view->title      = $this->lang->custom->customStoryCollectPool;
        $this->view->position[] = $this->lang->custom->customStoryCollectPool;
        $this->display();
    }

}