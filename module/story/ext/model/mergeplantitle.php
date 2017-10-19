<?php
/**
 * Merge plan title.
 *
 * @param  int|array    $productID
 * @param  array    $stories
 * @access public
 * @return array
 */
public function mergePlanTitle($productID, $stories, $branch = 0)
{
    $query = $this->dao->get();

    if(is_array($branch))
    {
        unset($branch[0]);
        $branch = join(',', $branch);
        if($branch) $branch = "0,$branch";
    }
    //2273 需求增加一个字段“期望实现时间”，该字段的值采用下拉菜单格式，并且下拉菜单最好能调用产品-计划中的未关闭计划
    $plans = $this->dao->select('id,title')->from(TABLE_PRODUCTPLAN)
        ->where('product')->in($productID)
        //->beginIF($branch)->andWhere('branch')->in($branch)->fi()
        ->andWhere('deleted')->eq(0)
        ->fetchPairs('id', 'title');

    $stages = $this->dao->select('*')->from(TABLE_STORYSTAGE)->where('branch')->in($branch)->fetchGroup('story', 'branch');

    $branch = trim(str_replace(',0,', '', ",$branch,"), ',');
    $branch = empty($branch) ? 0 : $branch;

    foreach($stories as $story)
    {
        //2273 需求增加一个字段“期望实现时间”，该字段的值采用下拉菜单格式，并且下拉菜单最好能调用产品-计划中的未关闭计划
        $story->customPlan = zget($plans, $story->customPlan, '') . ' ';

        $story->planTitle = '';
        $storyPlans = explode(',', trim($story->plan, ','));
        foreach($storyPlans as $planID) $story->planTitle .= zget($plans, $planID, '') . ' ';
    }

    /* For save session query. */
    $this->dao->sqlobj->sql = $query;

    return $stories;
}
