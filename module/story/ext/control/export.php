<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mystory extends story
{
    public function export($productID, $orderBy)
    {
        if($_POST)
        {
            $this->story->setListValue($productID);
        }
        parent::export($productID, $orderBy);
    }
}
