<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
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
