<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mytask extends task
{
    public function import($projectID)
    {
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        if($_FILES)
        {
            $file = $this->loadModel('file')->getUpload('file');
            $file = $file[0];
            move_uploaded_file($file['tmpname'], $this->file->savePath . $file['pathname']);

            $file = $this->file->savePath . $file['pathname'];
            $phpExcel  = $this->app->loadClass('phpexcel');
<<<<<<< HEAD
            $phpReader = new PHPExcel_Reader_Excel2007(); 
=======
            $phpReader = new PHPExcel_Reader_Excel2007();

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
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
