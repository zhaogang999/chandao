<?php
/**
 * get count of bug of Branch
 *
 * @param $product
 * @access public
 * @return object
*/
public function bugBranchStatistics($product)
{
    $data = new stdClass();

    $activedBugsPerBranch = $this->dao->select("branch, count(id) as bugs")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->eq($product)
        ->andWhere('status')->eq('active')
        ->groupBy('branch')
        ->fetchPairs();
    $bugsPerBranch = $this->dao->select("branch, count(id) as bugs")->from(TABLE_BUG)
        ->where('deleted')->eq('0')
        ->andWhere('product')->eq($product)
        ->groupBy('branch')
        ->fetchPairs();

    $data->activedBugs = $activedBugsPerBranch;
    $data->bugs = $bugsPerBranch;

    return $data;
}