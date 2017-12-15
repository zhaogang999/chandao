<?php
/**
 * Get product and project of an object.
 *
 * @param  string $objectType
 * @param  int    $objectID
 * @access public
 * @return array
 */
public function getProductAndProject($objectType, $objectID)
{
    $emptyRecord = array('product' => ',0,', 'project' => 0);

    /* If objectType is product or project, return the objectID. */
    if($objectType == 'product') return array('product' => ",$objectID,", 'project' => 0);
    if($objectType == 'project')
    {
        $products = $this->dao->select('product')->from(TABLE_PROJECTPRODUCT)->where('project')->eq($objectID)->fetchPairs('product');
        $productList = ',' . join(',', array_keys($products)) . ',';
        return array('project' => $objectID, 'product' => $productList);
    }

    /* Only process these object types. */
    //增加patchbuild模块
    if(strpos('story, productplan, release, task, build. bug, case, testtask, doc, patchbuild, storyreview', $objectType) !== false)
    {
        if(!isset($this->config->objectTables[$objectType])) return $emptyRecord;

        /* Set fields to fetch. */
        if(strpos('story, productplan, case',  $objectType) !== false) $fields = 'product';
        //增加patchbuild模块
        if(strpos('build, bug, testtask, doc, patchbuild', $objectType) !== false) $fields = 'product, project';
        if($objectType == 'release') $fields = 'product, build';
        if($objectType == 'task')    $fields = 'project, story';

        $record = $this->dao->select($fields)->from($this->config->objectTables[$objectType])->where('id')->eq($objectID)->fetch();

        /* Process story, release and task. */
        if($objectType == 'story')   $record->project = $this->dao->select('project')->from(TABLE_PROJECTSTORY)->where('story')->eq($objectID)->fetch('project');
        if($objectType == 'release') $record->project = $this->dao->select('project')->from(TABLE_BUILD)->where('id')->eq($record->build)->fetch('project');
        if($objectType == 'task')
        {
            if($record->story != 0)
            {
                $product = $this->dao->select('product')->from(TABLE_STORY)->where('id')->eq($record->story)->fetchPairs('product');
                $record->product = join(',', array_keys($product));
            }
            else
            {
                $products = $this->dao->select('product')->from(TABLE_PROJECTPRODUCT)->where('project')->eq($record->project)->fetchPairs('product');
                $record->product = join(',', array_keys($products));
            }
        }

        if($record)
        {
            $record = (array)$record;
            $record['product'] = isset($record['product']) ? ',' . $record['product'] . ',' : ',0,';
            if(!isset($record['project'])) $record['project'] = 0;
            return $record;
        }

        return $emptyRecord;
    }
    return $emptyRecord;
}