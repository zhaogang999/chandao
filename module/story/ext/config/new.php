<?php
//开发任务分类
$config->story->develTask = 'devel,web,ios,android,sdk,fos';
//禅道自身bug，待系统修复后可以删除
$config->story->edit->requiredFields = 'title';

//1522 增加产品需求所关联的需求和已细分需求的显示
$config->story->datatable->fieldList['childStories']['title']    = 'childStories';
$config->story->datatable->fieldList['childStories']['fixed']    = 'left';
$config->story->datatable->fieldList['childStories']['width']    = '100';
$config->story->datatable->fieldList['childStories']['required'] = 'no';

$config->story->datatable->fieldList['linkStories']['title']    = 'linkStories';
$config->story->datatable->fieldList['linkStories']['fixed']    = 'left';
$config->story->datatable->fieldList['linkStories']['width']    = '100';
$config->story->datatable->fieldList['linkStories']['required'] = 'no';

//1788 首次提需求时，屏蔽所属计划字段
$config->story->list->customCreateFields      = 'source,verify,pri,estimate,mailto,keywords';
$config->story->list->customBatchCreateFields = 'module,spec,source,verify,pri,estimate,review,keywords';
$config->story->custom->batchCreateFields = 'module,spec,pri,estimate,review';