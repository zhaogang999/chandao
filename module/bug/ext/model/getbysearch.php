<?php
/**
 * Get bugs by search.
 *
 * @param  int    $productID
 * @param  int    $queryID
 * @param  string $orderBy
 * @param  object $pager
 * @param  int    $branch
 * @param  string $status  // 增加参数$status
 * @access public
 * @return array
 */
public function getBySearch($productID, $queryID, $orderBy, $pager = null, $branch = 0, $status = '')
{
    if($queryID)
    {
        $query = $this->loadModel('search')->getQuery($queryID);
        if($query)
        {
            $this->session->set('bugQuery', $query->sql);
            $this->session->set('bugForm', $query->form);
        }
        else
        {
            $this->session->set('bugQuery', ' 1 = 1');
        }
    }
    else
    {
        if($this->session->bugQuery == false) $this->session->set('bugQuery', ' 1 = 1');
    }

    $allProduct = "`product` = 'all'";
    $bugQuery   = $this->session->bugQuery;

    if (empty($status))
    {
        if(strpos($bugQuery, '`product` =') === false) $bugQuery .= ' AND `product` = ' . $productID;
    }

    if(strpos($bugQuery, $allProduct) !== false)
    {
        $products = array_keys($this->loadModel('product')->getPrivProducts());
        $bugQuery = str_replace($allProduct, '1', $bugQuery);
        $bugQuery = $bugQuery . ' AND `product` ' . helper::dbIN($products);
    }
    $allBranch = "`branch` = 'all'";
    if($branch and strpos($bugQuery, '`branch` =') === false) $bugQuery .= " AND `branch` in('0','$branch')";
    if(strpos($bugQuery, $allBranch) !== false) $bugQuery = str_replace($allBranch, '1', $bugQuery);

    $bugs = $this->dao->select('*')->from(TABLE_BUG)->where($bugQuery)
        ->andWhere('deleted')->eq(0)
        //->beginIF($status != '')->andWhere('status')->in($status)->fi() //取消bug状态限制
        ->orderBy($orderBy)->page($pager)->fetchAll();
    return $bugs;
}