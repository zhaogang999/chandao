<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/3/19
 * Time: 14:12
 */
class myStory extends story
{
    public function switchStoryLock($project, $status)
    {
        $status = $status == '0' ? '1' : '0';
        $this->dao->update(TABLE_PROJECT)->set('lockStory')->eq($status)->where('id')->eq($project)->exec();
        if(dao::isError()) die(js::error(dao::getError()));
        die(js::reload('parent'));
    }
}