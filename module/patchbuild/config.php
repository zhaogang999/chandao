<?php
$config->patchbuild = new stdclass();
$config->patchbuild->createpatchbuild   = new stdclass();

$config->patchbuild->editor   = new stdclass();
$config->patchbuild->editor->createpatchbuild = array('id' => 'patchContent,influence,config,notice', 'tools' => 'simpleTools');
$config->patchbuild->editor->editpatchbuild = array('id' => 'patchContent,influence,config,notice,testComment,testEnvComment', 'tools' => 'simpleTools');
