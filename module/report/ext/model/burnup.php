<?php
/**
* get info of burnup
*
 * @param $data object
* @access public
* @return array
*/
public function burnUp($data)
{
    $this->loadModel('project');

    $begin = $data['begin'];
    $end = $data['end'];

    $burnUpData = $this->dao->select('*')->from(TABLE_BURNUP)->where('project')->eq($data['project'])->andWhere('date')->between($begin,$end)->orderBy('date')->fetchAll('date');

    return $burnUpData;
}