<?php
$config->issue = new stdclass();

$config->issue->editor   = new stdclass();
$config->issue->editor->create = array('id' => 'reason', 'tools' => 'simpleTools');
$config->issue->editor->edit = array('id' => 'comment, reason', 'tools' => 'simpleTools');