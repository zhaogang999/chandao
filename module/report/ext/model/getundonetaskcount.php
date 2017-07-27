<?php
public function getUndoneTaskCount()
{
    $projects = $this->dao->select("GROUP_CONCAT(`id`) AS ids")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetch();
    $undoneDevelTaskCount = $this->dao->select('project, count(id) as undoneDevelCount')->from(TABLE_TASK)->where('deleted')->eq('0')->andWhere('status')->in('wait, doing, pause')->andWhere('type')->in('fos, devel, sdk, web, ios, android')->andWhere('project')->in($projects->ids)->groupBy('project')->fetchAll('project');
    $undoneTestTaskCount = $this->dao->select('project, count(id) as undoneTestCount')->from(TABLE_TASK)->where('deleted')->eq('0')->andWhere('status')->in('wait, doing, pause')->andWhere('type')->in('test')->andWhere('project')->in($projects->ids)->groupBy('project')->fetchAll('project');

    $projects = explode(',', $projects->ids);
    foreach($projects as $project)
    {
        $data = new stdClass();
        $data->project = $project;
        $data->date = date('Y-m-d');
        $data->undoneDevelTaskCount = isset($undoneDevelTaskCount[$project])?$undoneDevelTaskCount[$project]->undoneDevelCount:0;
        $data->undoneTestTaskCount = isset($undoneTestTaskCount[$project])?$undoneTestTaskCount[$project]->undoneTestCount:0;
        $this->dao->insert(TABLE_UNDONETASKREPORT)->data($data)->exec();
    }
}