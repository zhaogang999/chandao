<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mytask extends task
{
    public function showImport($projectID)
    {
        if($_POST)
        {
<<<<<<< HEAD
=======
            //var_dump($_POST);die;
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
            $this->task->createFromImport($projectID);
            die(js::locate($this->createLink('project','task', "projectID=$projectID"), 'parent'));
        }
        $this->loadModel('project')->setMenu($this->project->getPairs(), $projectID);

        $file       = $this->session->importFile;
        $taskLang   = $this->lang->task;
        $taskConfig = $this->config->task;
        $fields     = explode(',', $taskConfig->exportFields);
        foreach($fields as $key => $fieldName)
        {
            $fieldName = trim($fieldName);
            $fields[$fieldName] = isset($taskLang->$fieldName) ? $taskLang->$fieldName : $fieldName;
            unset($fields[$key]);
        }

        $phpExcel  = $this->app->loadClass('phpexcel');
<<<<<<< HEAD
        $phpReader = new PHPExcel_Reader_Excel2007(); 
        if(!$phpReader->canRead($file)) $phpReader = new PHPExcel_Reader_Excel5(); 

        $phpExcel     = $phpReader->load($file);
        $currentSheet = $phpExcel->getSheet(0); 
        $allRows      = $currentSheet->getHighestRow(); 
        $allColumns   = $currentSheet->getHighestColumn(); 
=======
        $phpReader = new PHPExcel_Reader_Excel2007();
        if(!$phpReader->canRead($file)) $phpReader = new PHPExcel_Reader_Excel5(); 

        $phpExcel     = $phpReader->load($file);
        $currentSheet = $phpExcel->getSheet(0);
        $allRows      = $currentSheet->getHighestRow();
        $allColumns   = $currentSheet->getHighestColumn();
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $allColumns++;
        $currentColumn = 'A';
        while($currentColumn != $allColumns)
        {
            $title = $currentSheet->getCell($currentColumn . '1')->getValue();
            $field = array_search($title, $fields);
            $columnKey[$currentColumn] = $field ? $field : '';
            $currentColumn++;
        }

        $taskData = array();
        for($currentRow = 2; $currentRow <= $allRows; $currentRow++)
        {
            $currentColumn = 'A'; 
            $task          = new stdclass();
            $ignoreRow     = false;
            while($currentColumn != $allColumns)
            {
                $cellValue = $currentSheet->getCell($currentColumn . $currentRow)->getValue();
                if(empty($columnKey[$currentColumn]))
                {
                    $currentColumn++;
                    continue;
                }
                $field = $columnKey[$currentColumn];
                $currentColumn++;

                // check empty data.
                $requiredFields = explode(',', $taskConfig->create->requiredFields);
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
                if(in_array($field, $requiredFields) and empty($cellValue))
                {
                    $ignoreRow = true;
                    break;
                }
                if(empty($cellValue))
                {
                    $task->$field = '';
                    continue;
                }

                if(in_array($field, $taskConfig->import->ignoreFields)) continue;
                if($field == 'project')
                {
                    $task->$field = $projectID;
                }
                elseif(in_array($field, $taskConfig->export->listFields))
                {
                    if(strrpos($cellValue, '(#') === false)
                    {
                        if(!isset($taskLang->{$field . 'List'}))
                        {
                            $task->$field = empty($task->id) ? $cellValue : '';
                            continue;
                        }

                        /* when the cell value is key of list then eq the key. */
                        $listKey = array_keys($taskLang->{$field . 'List'});
                        unset($listKey[0]);
                        unset($listKey['']);
                        $task->$field = in_array($cellValue, $listKey, true) ? $cellValue : array_search($cellValue, $taskLang->{$field . 'List'});
                    }
                    else
                    {
                        $id = trim(substr($cellValue, strrpos($cellValue,'(#') + 2), ')');
                        $task->$field = $id;
                    }
                }
                elseif($field == 'desc')
                {
                    $task->$field = str_replace("\n", "\n", $cellValue);
                }
                else
                {
                    $task->$field = $cellValue;
                }
            }
            if(!$ignoreRow) $taskData[$currentRow] = $task;
            unset($task);
        }

        if(empty($taskData))
        {
            unlink($this->session->importFile);
            unset($_SESSION['importFile']);
            echo js::alert($this->lang->excel->noData);
            die(js::locate($this->createLink('project','task', "projectID=$projectID")));
        }

        $this->view->title      = $this->lang->task->common . $this->lang->colon . $this->lang->task->showImport;
        $this->view->position[] = $this->lang->task->showImport;

        $this->view->stories   = $this->loadModel('story')->getProjectStoryPairs($projectID);
        $this->view->modules   = $this->loadModel('tree')->getTaskOptionMenu($projectID);
        $this->view->tasks     = $this->dao->select('*')->from(TABLE_TASK)->where('project')->eq($projectID)->andWhere('deleted')->eq(0)->fetchAll('id');
        $this->view->taskData  = $taskData;
        $this->view->projectID = $projectID;
        $this->display();
    }
}
