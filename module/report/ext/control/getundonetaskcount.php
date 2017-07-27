<?php
include '../../control.php';
class myReport extends report
{
    public function getUndoneTaskCount()
    {
        $this->report->getUndoneTaskCount();
    }
}