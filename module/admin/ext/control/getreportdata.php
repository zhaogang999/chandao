<?php
include '../../control.php';
class myAdmin extends admin
{
    /**
     * 每日抓取report数据
     * 
     * @return void
     */
    public function getReportData()
    {
        $this->admin->getBurnUpData();
        $this->admin->getDailyBugStatistics();
        $this->admin->getUndoneTaskCount();
        echo "ok\n";
    }
}