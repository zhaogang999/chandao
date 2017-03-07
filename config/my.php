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

if(!defined('TABLE_REVIEW')) define('TABLE_REVIEW', '`' . $config->db->prefix . 'review`');
if(!defined('TABLE_REVIEWDETAIL')) define('TABLE_REVIEWDETAIL', '`' . $config->db->prefix . 'reviewDetail`');
if(!defined('TABLE_QAAUDIT')) define('TABLE_QAAUDIT', '`' . $config->db->prefix . 'qaaudit`');

$config->timeout       = 60000;