<?php
include '../../control.php';
class mytask extends task
{
    public function export($projectID, $orderBy)
    {
        if($_POST)
        {
            $this->task->setListValue($projectID);
        }
        parent::export($projectID, $orderBy);
    }
}
