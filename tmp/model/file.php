<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\file\model.php');
helper::cd();
class extfileModel extends fileModel 
{
public function excludeHtml($content, $extra = '')
{
    return $this->loadExtension('excel')->excludeHtml($content, $extra);
}

public function setAreaStyle($excelSheet, $style, $area)
{
    return $this->loadExtension('excel')->setAreaStyle($excelSheet, $style, $area);
}
//**//
}