<?php
include '../../control.php';
class myMy extends my
{
    /**
     * 每日抓取report数据
     * 
     * @return void
     */
    public function getReportData()
    {
        $this->my->getBurnUpData();
        $this->my->getDailyBugStatistics();
        $this->my->getUndoneTaskCount();
        echo "ok\n";
    }
}