<?php
/**
 * 每日bug情况统计数据
 *
 * @access public
 * @return void
 */
public function getDailyBugStatistics()
{
    $this->loadModel('product');

    $now = helper::today();
    $products = $this->product->getPairs('noclosed');
    $productIDs = implode(',', array_keys($products));

    $createdPerDay = $this->dao->select("product, count(id) as createdPerDay")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('DATE_FORMAT(openedDate, "%Y-%m-%d")')->eq($now)
        ->groupBy('product')
        ->fetchPairs();
    $resolvedPerDay = $this->dao->select("product, count(id) as resolvedPerDay")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('DATE_FORMAT(resolvedDate, "%Y-%m-%d")')->eq($now)
        ->groupBy('product')
        ->fetchPairs();
    $active = $this->dao->select("product, count(id) as actived")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('status')->eq('active')
        ->groupBy('product')
        ->fetchPairs();
    $resolved = $this->dao->select("product, count(id) as resolved")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('status')->eq('resolved')
        ->groupBy('product')
        ->fetchPairs();
    $opened = $this->dao->select("product, count(id) as opened")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->andWhere('status')->ne('closed')
        ->groupBy('product')
        ->fetchPairs();
    $count = $this->dao->select("product, count(id) as count")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->in($productIDs)
        ->groupBy('product')
        ->fetchPairs();

    foreach ($products as $productID => $product)
    {
        $data = new stdClass();

        $data->date             =  $now;
        $data->product          = $productID;
        $data->createdPerDay    = isset($createdPerDay[$productID])?$createdPerDay[$productID]:0;
        $data->resolvedPerDay   = isset($resolvedPerDay[$productID])?$resolvedPerDay[$productID]:0;
        $data->active           = isset($active[$productID])?$active[$productID]:0;
        $data->resolved         = isset($resolved[$productID])?$resolved[$productID]:0;
        $data->opened           = isset($opened[$productID])?$opened[$productID]:0;
        $data->count            = isset($count[$productID])?$count[$productID]:0;

        $this->dao->insert(TABLE_BUGREPORT)->data($data)->exec();
    }
}