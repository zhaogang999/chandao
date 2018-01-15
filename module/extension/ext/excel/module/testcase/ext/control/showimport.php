<?php
include '../../control.php';
class mytestcase extends testcase
{
    public function showImport($productID, $branch = 0)
    {
        $branch = (int)$branch;
        if($_POST)
        {
            $this->testcase->createFromImport($productID, $branch);
            die(js::locate(inlink('browse', "productID=$productID&branch=$branch"), 'parent'));
        }
        $this->testcase->setMenu($this->products, $productID, $branch);

        $file       = $this->session->importFile;
        $caseLang   = $this->lang->testcase;
        $caseConfig = $this->config->testcase;
        $fields     = explode(',', $caseConfig->exportFields);
        foreach($fields as $key => $fieldName)
        {
            $fieldName = trim($fieldName);
            $fields[$fieldName] = isset($caseLang->$fieldName) ? $caseLang->$fieldName : $fieldName;
            unset($fields[$key]);
        }

        $phpExcel  = $this->app->loadClass('phpexcel');
        $phpReader = new PHPExcel_Reader_Excel2007(); 
        if(!$phpReader->canRead($file)) $phpReader = new PHPExcel_Reader_Excel5(); 

        $phpExcel     = $phpReader->load($file);
        $currentSheet = $phpExcel->getSheet(0); 
        $allRows      = $currentSheet->getHighestRow(); 
        $allColumns   = $currentSheet->getHighestColumn(); 
        $columnKey    = array();
        for($currentColumn = 'A'; $currentColumn <= $allColumns; $currentColumn++)
        {
            $title = $currentSheet->getCell($currentColumn . '1')->getValue();
            $field = array_search($title, $fields);
            $columnKey[$currentColumn] = $field ? $field : '';
        }

        $caseData = array();
        $stepData = array();
        for($currentRow = 2; $currentRow <= $allRows; $currentRow++)
        {
            $case      = new stdclass();
            $ignoreRow = false;
            for($currentColumn = 'A'; $currentColumn <= $allColumns; $currentColumn++)
            {
                $cellValue = $currentSheet->getCell($currentColumn . $currentRow)->getValue();
                if(empty($columnKey[$currentColumn])) continue;
                $field = $columnKey[$currentColumn];

                // check empty data.
                $requiredFields = explode(',', $caseConfig->create->requiredFields);
                if(in_array($field, $requiredFields) and empty($cellValue))
                {
                    $ignoreRow = true;
                    break;
                }
                if(empty($cellValue)) continue;

                if(in_array($field, $caseConfig->import->ignoreFields)) continue;
                if($field == 'product')
                {
                    $case->$field = $productID;
                }
                elseif(in_array($field, $caseConfig->export->listFields))
                {
                    if(strrpos($cellValue, '(#') === false)
                    {
                        if(!isset($caseLang->{$field . 'List'}))
                        {
                            $case->$field = empty($case->id) ? $cellValue : '';
                            continue;
                        }

                        /* when the cell value is key of list then eq the key. */
                        $listKey = array_keys($caseLang->{$field . 'List'});
                        unset($listKey[0]);
                        unset($listKey['']);
                        if($field == 'stage')
                        {
                            $stages = explode("\n", $cellValue);
                            foreach($stages as $stage) $case->stage[] = in_array($cellValue, $listKey) ? $cellValue : array_search($stage, $caseLang->{$field . 'List'});
                            $case->stage = join(',', $case->$field);
                            continue;
                        }
                        $case->$field = in_array($cellValue, $listKey, true) ? $cellValue : array_search($cellValue, $caseLang->{$field . 'List'});
                    }
                    else
                    {
                        $id = trim(substr($cellValue, strrpos($cellValue,'(#') + 2), ')');
                        $case->$field = $id;
                    }
                }
                elseif($field == 'stepDesc' or $field == 'stepExpect')
                {
                    $steps    = explode("\n", $cellValue);
                    $stepKey  = str_replace('step', '', strtolower($field));
                    $caseStep = array();
                    foreach($steps as $step)
                    {
                        $step = trim($step);
                        if(empty($step)) continue;
                        if(preg_match('/^([0-9]+)([.、]{1})/U', $step, $out))
                        {
                            $num     = $out[1];
                            $sign    = $out[2];
                            $signbit = $sign == '.' ? 1 : 3;
                            $step    = trim(substr($step, strpos($step, $sign) + $signbit));
                            if(!empty($step)) $caseStep[$num] = $step;
                        }
                        else
                        {
                            if(isset($num)) $caseStep[$num] .= "\n" . $step;
                        }
                    }
                    unset($num);
                    unset($sign);
                    $stepData[$currentRow][$stepKey] = $caseStep;
                }
                else
                {
                    $case->$field = $cellValue;
                }
            }
            if(!$ignoreRow) $caseData[$currentRow] = $case;
            unset($case);
        }

        if(empty($caseData))
        {
            unlink($this->session->importFile);
            unset($_SESSION['importFile']);
            echo js::alert($this->lang->excel->noData);
            die(js::locate(inlink('browse', "productID=$productID&branch=$branch")));
        }

        $this->view->title      = $this->lang->testcase->common . $this->lang->colon . $this->lang->testcase->showImport;
        $this->view->position[] = $this->lang->testcase->showImport;

        $this->view->stories   = $this->loadModel('story')->getProductStoryPairs($productID, $branch);
        $this->view->modules   = $this->loadModel('tree')->getOptionMenu($productID, 'case', 0, $branch);
        $this->view->cases     = $this->dao->select('id, module, story')->from(TABLE_CASE)->where('product')->eq($productID)->andWhere('deleted')->eq(0)->fetchAll('id');
        $this->view->caseData  = $caseData;
        $this->view->stepData  = $stepData;
        $this->view->productID = $productID;
        $this->view->product   = $this->products[$productID];
        $this->view->branch    = $branch;
        $this->display();
    }
}
