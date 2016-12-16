<?php
$config->word->story->exportFields[] = 'title';
$config->word->story->exportFields[] = 'spec';
<<<<<<< HEAD
=======
//需求描述拆分，增加输出字段
$config->word->story->exportFields[] = 'spec2';
$config->word->story->exportFields[] = 'spec3';

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
$config->word->story->exportFields[] = 'verify';
$config->word->story->exportFields[] = 'pri';
$config->word->story->exportFields[] = 'estimate';
$config->word->story->exportFields[] = 'stage';
$config->word->story->exportFields[] = 'status';
$config->word->story->exportFields[] = 'files';

<<<<<<< HEAD
$config->word->story->style['title']  = 'title';
$config->word->story->style['spec']   = 'showImage';
$config->word->story->style['verify'] = 'showImage';

=======
//控制输出字段的样式
$config->word->story->style['title']  = 'title';
$config->word->story->style['spec']   = 'showImage';
$config->word->story->style['spec2']   = 'showImage';
$config->word->story->style['spec3']   = 'showImage';

$config->word->story->style['verify'] = 'showImage';

//控制需求描述拆分为子目录，有次配置则为标题4
$config->word->story->sonTitle[] = 'spec2';
$config->word->story->sonTitle[] = 'spec3';

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
$config->word->tableName        = new stdclass();
$config->word->tableName->story = TABLE_STORY;

$config->word->header        = new stdclass();
$config->word->header->story = array( 'name' => 'product', 'tableName' => TABLE_PRODUCT);
$config->word->header->task  = array( 'name' => 'project', 'tableName' => TABLE_PROJECT);

$config->word->size->titles[1] = 20;
$config->word->size->titles[2] = 16;
$config->word->size->titles[3] = 12;
$config->word->size->titles[4] = 8;

$config->word->imageExtension = array('png', 'jpg', 'gif', 'jpeg');

global $app;
$config->word->filePath = $app->getBasePath() . 'www/';
