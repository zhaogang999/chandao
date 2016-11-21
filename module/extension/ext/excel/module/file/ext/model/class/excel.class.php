<?php
class excelFile extends fileModel
{
    public function excludeHtml($content, $extra = '')
    {
        $content = str_replace(array('<i>', '&nbsp;', '<br />'), array('', ' ', "\n"),$content);
        $content = preg_replace('/<[^ia\/]+(.*)>/U', '', $content);
        $content = preg_replace('/<\/[^a]{1}.*>/U', '', $content);
        $content = preg_replace('/<i .*>/U', '', $content);
        if($extra != 'noImg') $content = preg_replace('/<img src="data\/"(.*)\/>/U', "<img src=\"" . common::getSysURL() . "data/\"\$1/>", $content);
        return $content;
    }

    public function setAreaStyle($excelSheet, $style, $area)
    {
        $styleObj = new PHPExcel_Style(); 
        $styleObj->applyFromArray($style); 
        $excelSheet->setSharedStyle($styleObj, $area);
    }
}
