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
        ->where('product')->eq((int)$productID)
        ->andWhere('deleted')->eq(0)
        ->beginIF(!empty($status))->andWhere('status')->eq($status)
        ->orderBy('id desc')
        ->fetchAll();
    foreach($data as $bug)
    {
        $bugs[$bug->id] = $bug->id . ':' . $bug->title;
    }
    return $bugs;
}