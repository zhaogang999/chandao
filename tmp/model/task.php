<?php
helper::import('F:\zentao\chandao\module\task\model.php');
class exttaskModel extends taskModel 
{
public function setListValue($productID)
{
    return $this->loadExtension('excel')->setListValue($productID);
}

public function createFromImport($productID)
{
    return $this->loadExtension('excel')->createFromImport($productID);
}
//**//
}