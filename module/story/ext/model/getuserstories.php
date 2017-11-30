<?php
/**
 * Get stories of a user.
 *
 * @param  string $account
 * @param  string $type         the query type
 * @param  string $orderBy
 * @param  object $pager
 * @access public
 * @return array
 */
public function getUserStories($account, $type = 'assignedTo', $orderBy = 'id_desc', $pager = null)
{
    $stories = $this->dao->select('t1.*, t2.name as productTitle')->from(TABLE_STORY)->alias('t1')
        ->leftJoin(TABLE_PRODUCT)->alias('t2')->on('t1.product = t2.id')
        ->where('t1.deleted')->eq(0)
        ->beginIF($type != 'all')
        //需求可以指派给多个人；查询指派给用like
        ->beginIF($type == 'assignedTo')->andWhere('assignedTo')->like('%' . $account . '%')->fi()
        ->beginIF($type == 'openedBy')->andWhere('openedBy')->eq($account)->fi()
        ->beginIF($type == 'reviewedBy')->andWhere('reviewedBy')->like('%' . $account . '%')->fi()
        ->beginIF($type == 'closedBy')->andWhere('closedBy')->eq($account)->fi()
        ->fi()
        ->orderBy($orderBy)
        ->page($pager)
        ->fetchAll();

    $this->loadModel('common')->saveQueryCondition($this->dao->get(), 'story');
    $productIdList = array();
    //2828 我的地盘--指派给我的需求（点击需求可以直接定位到可以拆任务的界面）
    foreach($stories as $story)
    {
        $productIdList[$story->product] = $story->product;
        $story->projectID = $this->dao->select('project')->from(TABLE_PROJECTSTORY)->where('story')->eq($story->id)->fetch('project');
    }

    return $this->mergePlanTitle($productIdList, $stories);
}