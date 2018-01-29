<?php
/**
 * @param $productID
 * @param $status
 * @return array
 */
public function getProductBugsPairs($productID, $status='')
{
    $bugs = array('' => '');
    $data = $this->dao->select('id, title')->from(TABLE_BUG)
        ->where('deleted')->eq(0)
        ->beginIF($productID != 0)->andWhere('product')->eq((int)$productID)->fi()
        ->beginIF(!empty($status))->andWhere('status')->in($status)->fi()
        ->orderBy('id desc')
        ->fetchAll();
    foreach($data as $bug)
    {
        $bugs[$bug->id] = $bug->id . ':' . $bug->title;
    }
    return $bugs;
}