<?php
/**
 * Get stories pairs of a product.
 *
 * @param  int           $productID
 * @param  array|string  $moduleIdList
 * @param  string        $status
 * @param  string        $order
 * @param  int           $limit
 * @access public
 * @return array
 */
public function getProductStoryPairs($productID = 0, $branch = 0, $moduleIdList = 0, $status = 'all', $order = 'id_desc', $limit = 0)
{
    if($branch) $branch = "0,$branch";//Fix bug 1059.
    $stories = $this->dao->select('t1.id, t1.title, t1.module, t1.pri, t1.estimate, t1.openedBy, t2.name AS product')
        ->from(TABLE_STORY)->alias('t1')->leftJoin(TABLE_PRODUCT)->alias('t2')->on('t1.product = t2.id')
        ->where('1=1')
        ->beginIF($productID)->andWhere('t1.product')->in($productID)->fi()
        ->beginIF($moduleIdList)->andWhere('t1.module')->in($moduleIdList)->fi()
        ->beginIF($branch)->andWhere('t1.branch')->in($branch)->fi()
        ->beginIF($status and $status != 'all')->andWhere('t1.status')->in($status)->fi()
        ->andWhere('t1.deleted')->eq(0)
        ->orderBy($order)
        ->fetchAll();
    if(!$stories) return array();
    return $this->formatStories($stories, 'full', $limit);
}