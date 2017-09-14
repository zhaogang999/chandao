<?php
include '../../control.php';
class myReport extends report
{
    /**
     * 每日抓取燃起图数据
     * 
     * @return void
     */
    public function getBurnUpData()
    {
        $this->report->getBurnUpData();
    }
}