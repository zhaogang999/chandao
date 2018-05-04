<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\branch\model.php');
helper::cd();
class extbranchModel extends branchModel 
{
/**
 * Get pairs.
 *
 * @param  int    $productID
 * @param  string $params
 * @access public
 * @return array
 */
public function getPairs($productID, $params = '')
{
    $branches = $this->dao->select('*')->from(TABLE_BRANCH)->where('product')->eq($productID)->andWhere('deleted')->eq(0)->orderBy('`order`')->fetchPairs('id', 'name');
    if(strpos($params, 'noempty') === false)
    {
        $product = $this->loadModel('product')->getById($productID);
        if(!$product or $product->type == 'normal') return array();
        //交换位置
        $branches = $branches + array('0' => $this->lang->branch->all . $this->lang->product->branchName[$product->type]);
    }
    return $branches;
}
}