<?php
/**
 * Get stories by assignedTo.
 *
 * @param  int    $productID
 * @param  string $account
 * @param  string $orderBy
 * @param  object $pager
 * @access public
 * @return array
 */
public function getByAssignedTo($productID, $branch, $modules, $account, $orderBy, $pager)
{
    //需求可以指派给多个人；查询自拍给用like
    return $this->getByField($productID, $branch, $modules, 'assignedTo', $account, $orderBy, $pager, 'include');
}