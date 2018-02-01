<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/1/29
 * Time: 17:04
 */
include '../../control.php';
class myRelease extends release
{
    /**
     * Change status.
     *
     * @param  int    $releaseID
     * @param  string $status
     * @access public
     * @return void
     */
    public function changeStatus($releaseID, $status)
    {
        $this->release->changeStatus($releaseID, $status);
        if(dao::isError()) die(js::error(dao::getError()));
        $actionID = $this->loadModel('action')->create('release', $releaseID, 'changestatus', '', $status);
        die(js::locate($this->createLink('release', 'view', "releaseID=$releaseID"), 'parent'));
    }
}