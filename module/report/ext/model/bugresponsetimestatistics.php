<?php
/**
* bug解决周期&bug响应时间
*
* @access public
* @return array
*/
public function bugResponseTimeStatistics()
{
    $data = array();

    $products = $this->loadModel('product')->getPairs('noclosed');


    foreach ($products as $productID => $product)
    {
        $data[$productID] = $this->getBugStatisticsData($productID);
        $data[$productID]->productName = $product;
    }

    ksort($data);
    return $data;
}

/**
 * bug解决周期&bug响应时间 分项目
 *
 * @param  $productID string
 * @access public
 * @return object
 */
public function getBugStatisticsData($productID)
{
    $now = time();
    $data = new stdClass();
    $data->resolving1week   = 0;
    $data->resolving2weeks  = 0;
    $data->resolvinglong    = 0;
    $data->responsed1week   = 0;
    $data->responsed1weekbugs = array();
    $data->responsed2weeks  = 0;
    $data->responsed2weeksbugs = array();
    $data->responsedlong    = 0;
    $data->responsedlongbugs = array();

    $bugs = $this->dao->select('id,assignedDate,openedDate')->from(TABLE_BUG)
        ->where('product')->eq($productID)
        ->andWhere('deleted')->eq(0)
        ->andWhere('status')->eq('active')
        ->orderBy('id')
        ->fetchAll('id');

    foreach ($bugs as $bugID =>$bug)
    {
        $dif = ceil(($now-strtotime($bug->openedDate))/24/60/60);
        //var_dump($dif);die;
        switch ($dif)
        {
            case $dif < 7:
                $data->resolving1week++;
                break;
            case $dif>=7 && $dif<14:
                $data->resolving2weeks++;
                break;
            default:
                $data->resolvinglong++;
        }

        $responseTime = ceil(($now-strtotime($bug->assignedDate))/24/60/60);
        switch ($responseTime)
        {
            case $responseTime <7 :
                $data->responsed1week++;
                $data->responsed1weekbugs[] = $bugID;
                break;
            case $responseTime >=7 && $responseTime <= 14 :
                $data->responsed2weeks ++;
                $data->responsed2weeksbugs[] = $bugID;
                break;
            default :
                $data->responsedlong++;
                $data->responsedlongbugs[] = $bugID;
        }
    }

    return $data;
}