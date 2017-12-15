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
$config->timeout       = 60000;

if(!defined('TABLE_REVIEW')) define('TABLE_REVIEW', '`' . $config->db->prefix . 'review`');
if(!defined('TABLE_REVIEWDETAIL')) define('TABLE_REVIEWDETAIL', '`' . $config->db->prefix . 'reviewDetail`');
if(!defined('TABLE_QAAUDIT')) define('TABLE_QAAUDIT', '`' . $config->db->prefix . 'qaaudit`');
if(!defined('TABLE_UNDONETASKREPORT')) define('TABLE_UNDONETASKREPORT', '`' . $config->db->prefix . 'undonetaskreport`');
if(!defined('TABLE_PATCHBUILD')) define('TABLE_PATCHBUILD', '`' . $config->db->prefix . 'patchbuild`');
if(!defined('TABLE_BURNUP')) define('TABLE_BURNUP', '`' . $config->db->prefix . 'burnup`');
if(!defined('TABLE_BUGREPORT')) define('TABLE_BUGREPORT', '`' . $config->db->prefix . 'bugreport`');
if(!defined('TABLE_SCRIPT')) define('TABLE_SCRIPT', '`' . $config->db->prefix . 'script`');
if(!defined('TABLE_STORYREVIEW')) define('TABLE_STORYREVIEW', '`' . $config->db->prefix . 'storyreview`');

$config->objectTables['patchbuild']       = TABLE_PATCHBUILD;
$config->objectTables['storyreview']      = TABLE_STORYREVIEW;
