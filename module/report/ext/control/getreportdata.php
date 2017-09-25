<?php
include '../../control.php';
class myReport extends report
{
    /**
     * 每日抓取report数据
     * 
     * @return void
     */
    public function getReportData()
    {
        //$this->report->getBurnUpData();
        $this->report->getDailyBugStatistics();
        //$this->report->getUndoneTaskCount();
    }
}