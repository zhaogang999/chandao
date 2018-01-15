<?php
include '../../control.php';
class mybug extends bug
{
    public function export($productID, $orderBy)
    {
        if($_POST)
        {
            $this->bug->setListValue($productID);
        }
        parent::export($productID, $orderBy);
    }
}
