<?php
include '../../control.php';
class myReport extends report
{
    /**
     * 每日获取bug分布情况数据
     * 
     * @return void
     */
    public function getDailyBugStatistics()
    {
        $this->report->getDailyBugStatistics();
    }
}