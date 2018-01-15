<?php
include '../../control.php';
class mytestcase extends testcase
{
    public function export($productID, $orderBy, $taskID = 0)
    {
        if($_POST)
        {
            $this->testcase->setListValue($productID);
        }
        parent::export($productID, $orderBy, $taskID);
    }
}
