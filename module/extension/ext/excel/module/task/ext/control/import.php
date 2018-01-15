<?php
include '../../control.php';
class mytask extends task
{
    public function import($projectID)
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
            die(js::locate(inlink('showImport', "projectID=$projectID"), 'parent.parent'));
        }
        $this->display();
    }
}
