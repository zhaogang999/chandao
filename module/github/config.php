<?php
//配置文件
$config->github = new stdclass();
header('Content-Type: text/html; charset=UTF-8');
$config->github = new stdclass();

$config->github->github_k='63a345b6d925ee8e4266'; //GitHub应用Client ID
$config->github->github_s='12faf3ac3a17c376e20524f83171d592c7a9974e'; //GitHub应用Client Secret
$config->github->callback_url='http://123.206.62.117/github-callback'; //授权回调网址http://123.206.62.117/callback.php
