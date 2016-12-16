<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
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
