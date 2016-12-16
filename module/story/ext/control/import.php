<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mystory extends story
{
    public function import($productID, $branch = 0)
    {
        if($_FILES)
        {
            $file = $this->loadModel('file')->getUpload('file');
            $file = $file[0];
            move_uploaded_file($file['tmpname'], $this->file->savePath . $file['pathname']);

            $file = $this->file->savePath . $file['pathname'];
            $phpExcel  = $this->app->loadClass('phpexcel');
            $phpReader = new PHPExcel_Reader_Excel2007(); 
            if(!$phpReader->canRead($file))
            { 
                $phpReader = new PHPExcel_Reader_Excel5(); 
                if(!$phpReader->canRead($file))die(js::alert($this->lang->excel->canNotRead));
            } 
            $this->session->set('importFile', $file);
            die(js::locate(inlink('showImport', "productID=$productID&branch=$branch"), 'parent.parent'));
        }
        $this->display();
    }
}
