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