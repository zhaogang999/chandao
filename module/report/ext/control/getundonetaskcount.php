<?php
include '../../control.php';
class myReport extends report
{
    /**
     * 每日获取未完成任务的统计数据
     * 
     * @return void
     */
    public function getUndoneTaskCount()
    {
        $this->report->getUndoneTaskCount();
    }
}