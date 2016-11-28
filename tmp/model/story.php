<?php
helper::import('F:\zentao\chandao\module\story\model.php');
class extstoryModel extends storyModel 
{
public function setListValue($productID, $branch = 0)
{
    return $this->loadExtension('excel')->setListValue($productID, $branch);
}

public function createFromImport($productID, $branch = 0)
{
    return $this->loadExtension('excel')->createFromImport($productID, $branch);
}
//**//
}