<?php
include '../../control.php';
class mystory extends story
{
    public function showImport($productID, $branch = 0)
    {
        $branch = (int)$branch;
        if($_POST)
        {
            $this->story->createFromImport($productID, $branch);
            die(js::locate($this->createLink('product','browse', "productID=$productID&branch=$branch"), 'parent'));
        }
        $this->loadModel('product')->setMenu($this->product->getPairs(), $productID, $branch);

        $file        = $this->session->importFile;
        $storyLang   = $this->lang->story;
        $storyConfig = $this->config->story;
        $fields      = explode(',', $storyConfig->list->exportFields);
        foreach($fields as $key => $fieldName)
        {
            $fieldName = trim($fieldName);
            $fields[$fieldName] = isset($storyLang->$fieldName) ? $storyLang->$fieldName : $fieldName;
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

        $storyData = array();
        for($currentRow = 2; $currentRow <= $allRows; $currentRow++)
        {
            $currentColumn = 'A'; 
            $story         = new stdclass();
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
                $requiredFields = explode(',', $storyConfig->create->requiredFields);
                if(in_array($field, $requiredFields) and empty($cellValue))
                {
                    $ignoreRow = true;
                    break;
                }
                if(empty($cellValue))
                {
                    $story->$field = '';
                    continue;
                }

                if(in_array($field, $storyConfig->import->ignoreFields)) continue;
                if($field == 'product')
                {
                    $story->$field = $productID;
                }
                elseif(in_array($field, $storyConfig->export->listFields))
                {
                    if(strrpos($cellValue, '(#') === false)
                    {
                        if(!isset($storyLang->{$field . 'List'}))
                        {
                            $story->$field = empty($story->id) ? $cellValue : '';
                            continue;
                        }

                        /* when the cell value is key of list then eq the key. */
                        $listKey = array_keys($storyLang->{$field . 'List'});
                        unset($listKey[0]);
                        unset($listKey['']);
                        $story->$field = in_array($cellValue, $listKey, true) ? $cellValue : array_search($cellValue, $storyLang->{$field . 'List'});
                    }
                    else
                    {
                        $id = trim(substr($cellValue, strrpos($cellValue,'(#') + 2), ')');
                        $story->$field = $id;
                    }
                }
                elseif($field == 'spec' or $field == 'verify')
                {
                    $story->$field = str_replace("\n", "\n", $cellValue);
                }
                else
                {
                    $story->$field = $cellValue;
                }
            }
            if(!$ignoreRow) $storyData[$currentRow] = $story;
            unset($story);
        }

        if(empty($storyData))
        {
            unlink($this->session->importFile);
            unset($_SESSION['importFile']);
            echo js::alert($this->lang->excel->noData);
            die(js::locate($this->createLink('product','browse', "productID=$productID&branch=$branch")));
        }

        $this->view->title      = $this->lang->story->common . $this->lang->colon . $this->lang->story->showImport;
        $this->view->position[] = $this->lang->story->showImport;

        $this->view->modules   = $this->loadModel('tree')->getOptionMenu($productID, 'story', 0, $branch);
        $this->view->stories   = $this->dao->select('*')->from(TABLE_STORY)->where('product')->eq($productID)->andWhere('deleted')->eq(0)->fetchAll('id');
        $this->view->plans     = $this->loadModel('productplan')->getPairs($productID, $branch);
        $this->view->storyData = $storyData;
        $this->view->productID = $productID;
        $this->view->branch    = $branch;
        $this->display();
    }
}
