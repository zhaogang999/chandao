<?php
$config->installed       = true;
$config->debug           = true;//开发模式为true,生产模式为false
$config->requestType     = 'PATH_INFO';//路由形式
$config->db->host        = '127.0.0.1';//数据库主机名
$config->db->port        = '3306';
$config->db->name        = 'zentao';
$config->db->user        = 'root';
$config->db->password    = 'root';
$config->db->prefix      = 'zt_';
$config->webRoot         = getWebRoot();
$config->default->lang   = 'zh-cn';

define('TABLE_REVIEW',         '`' . $config->db->prefix . 'review`');
define('TABLE_REVIEWDETAIL',    '`' . $config->db->prefix . 'reviewDetail`');

$config->objectTables['review']         = TABLE_REVIEW;
$config->objectTables['reviewDetail']   = TABLE_REVIEWDETAIL;

<<<<<<< HEAD
=======
$config->file->maxSize = 1024 * 1024 * 1024;
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
$config->timeout       = 60000;