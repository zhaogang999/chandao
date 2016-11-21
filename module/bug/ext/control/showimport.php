<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mybug extends bug
{
    public function showImport($productID, $branch = 0)
    {
        $branch = (int)$branch;
        if($_POST)
        {
            $this->bug->createFromImport($productID, $branch);
            die(js::locate(inlink('browse', "productID=$productID&branch=$branch"), 'parent'));
        }
        $this->bug->setMenu($this->products, $productID, $branch);

        $file      = $this->session->importFile;
        $bugLang   = $this->lang->bug;
        $bugConfig = $this->config->bug;
        $fields    = explode(',', $bugConfig->list->exportFields);
        foreach($fields as $key => $fieldName)
        {
            $fieldName = trim($fieldName);
            $fields[$fieldName] = isset($bugLang->$fieldName) ? $bugLang->$fieldName : $fieldName;
            unset($fields[$key]);
        }

        $phpExcel  = $this->app->loadClass('phpexcel');
        $phpReader = new PHPExcel_Reader_Excel2007(); 
        if(!$phpReader->canRead($file)) $phpReader = new PHPExcel_Reader_Excel5();

        $phpExcel     = $phpReader->load($file);
        $currentSheet = $phpExcel->getSheet(0); 
        $allRows      = $currentSheet->getHighestRow(); 
        $allColumns   = $currentSheet->getHighestColumn(); 
        $allColumns++;
        $currentColumn = 'A';
        while($currentColumn != $allColumns)
        {
            $title = $currentSheet->getCell($currentColumn . '1')->getValue();
            $field = array_search($title, $fields);
            $columnKey[$currentColumn] = $field ? $field : '';
            $currentColumn++;
        }

        $bugData = array();
        for($currentRow = 2; $currentRow <= $allRows; $currentRow++)
        {
            $currentColumn = 'A'; 
            $bug           = new stdclass(); 
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
                $requiredFields = explode(',', $bugConfig->create->requiredFields);
                if(in_array($field, $requiredFields) and empty($cellValue))
                {
                    $ignoreRow = true;
                    break;
                }
                if(empty($cellValue))
                {
                    $bug->$field = '';
                    continue;
                }

                if(in_array($field, $bugConfig->import->ignoreFields)) continue;
                if($field == 'product')
                {
                    $bug->$field = $productID;
                }
                elseif(in_array($field, $bugConfig->export->listFields))
                {
                    if(strrpos($cellValue, '(#') === false)
                    {
                        if(!isset($bugLang->{$field . 'List'}))
                        {
                            $bug->$field = empty($bug->id) ? $cellValue : '';
                            continue;
                        }

                        /* when the cell value is key of list then eq the key. */
                        $listKey = array_keys($bugLang->{$field . 'List'});
                        unset($listKey[0]);
                        unset($listKey['']);
                        $bug->$field = in_array($cellValue, $listKey, true) ? $cellValue : array_search($cellValue, $bugLang->{$field . 'List'});
                    }
                    elseif($field == 'openedBuild')
                    {
                        $builds    = explode("\n", $cellValue);
                        $buildList = array();

                        foreach($builds as $build) $buildList[] = trim(substr($build, strrpos($build,'(#') + 2), ')');
                        $bug->$field = join(',', $buildList);
                    }
                    else
                    {
                        $id = trim(substr($cellValue, strrpos($cellValue,'(#') + 2), ')');
                        $bug->$field = $id;
                    }
                }
                elseif($field == 'steps')
                {
                    $bug->$field = str_replace("\n", "\n", $cellValue);
                }
                else
                {
                    $bug->$field = $cellValue;
                }
            }
            if(!$ignoreRow) $bugData[$currentRow] = $bug;
            unset($bug);
        }

        if(empty($bugData))
        {
            unlink($this->session->importFile);
            unset($_SESSION['importFile']);
            echo js::alert($this->lang->excel->noData);
            die(js::locate(inlink('browse', "productID=$productID&branch=$branch")));
        }

        $projects = $this->loadModel('product')->getProjectPairs($productID, $branch ? "0,$branch" : 0, $params = 'nodeleted');
        $projects = array('0' => '') + $projects;
        $builds   = $this->loadModel('build')->getProductBuildPairs($productID, $branch, 'noempty');

        $this->view->title      = $this->lang->bug->common . $this->lang->colon . $this->lang->bug->showImport;
        $this->view->position[] = $this->lang->bug->showImport;

        $this->view->stories   = $this->loadModel('story')->getProductStoryPairs($productID, $branch);
        $this->view->modules   = $this->loadModel('tree')->getOptionMenu($productID, 'bug', 0, $branch);
        $this->view->projects  = $projects;
        $this->view->bugs      = $this->dao->select('*')->from(TABLE_BUG)->where('product')->eq($productID)->andWhere('deleted')->eq(0)->fetchAll('id');
        $this->view->builds    = $builds;
        $this->view->bugData   = $bugData;
        $this->view->productID = $productID;
        $this->view->product   = $this->products[$productID];
        $this->view->branch    = $branch;
        
        $this->view->flipProjects = array_flip($this->view->projects);
        $this->view->flipBuilds   = array_flip($this->view->builds);

        $this->display();
    }
}
