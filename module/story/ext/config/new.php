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