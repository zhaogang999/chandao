<?php
/**
* get info of dailyBugStatistics
*
* @param $data array
* @return array
*/
public function dailyBugStatistics($data)
{
    $this->loadModel('project');

    $result = $this->dao->select('*')->from(TABLE_BUGREPORT)->where('product')->eq($data['product'])->andWhere('date')->between($data['begin'],$data['end'])->orderBy('date')->fetchAll('date');

    return $result;
}