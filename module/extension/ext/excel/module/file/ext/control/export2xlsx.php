<?php
include "../../control.php";
class myfile extends file
{
    /**
     * File count 
     * 
     * @var int 
     * @access public
     */
    public $fileCount       = 1;

    /**
     * Data record in sharedStrings.
     * 
     * @var int 
     * @access public
     */
    public $record          = 0;

    /**
     * Style setting
     * 
     * @var array 
     * @access public
     */
    public $styleSetting    = array();

    /**
     * rels about link
     * 
     * @var string
     * @access public
     */
    public $rels            = '';

    /**
     * sheet1 sheetData 
     * 
     * @var string
     * @access public
     */
    public $sheet1SheetData = '';

    /**
     * sheet1 params like cols mergeCells ... 
     * 
     * @var array 
     * @access public
     */
    public $sheet1Params = array();

    /**
     * every counts in need count.
     * 
     * @var array 
     * @access public
     */
    public $counts = array();

    /**
     * init for excel data. 
     * 
     * @access public
     * @return void
     */
    public function init()
    {
        $this->app->loadClass('pclzip', true);
        $this->zfile  = $this->app->loadClass('zfile');
        $this->fields = $this->post->fields;
        $this->rows   = $this->post->rows;

        /* Init excel file. */
        $this->exportPath = $this->app->getCacheRoot() . $this->app->user->account . $this->post->kind . uniqid() . '/';
        if(is_dir($this->exportPath))$this->zfile->removeDir($this->exportPath);
        $this->zfile->mkdir($this->exportPath);
        $this->zfile->copyDir($this->app->getCoreLibRoot() . 'phpexcel/xlsx', $this->exportPath);

        $this->sharedStrings = file_get_contents($this->exportPath . 'xl/sharedStrings.xml');

        $this->fieldsKey = array_keys($this->fields);

        $this->sheet1Params['dataValidations'] = '';
        $this->sheet1Params['cols']            = array();
        $this->sheet1Params['mergeCells']      = '';
        $this->sheet1Params['hyperlinks']      = '';

        $this->counts['dataValidations'] = 0;
        $this->counts['mergeCells']      = 0;
        $this->counts['hyperlinks']      = 0;
    }

    /**
     * Export data to Excel. This is main function.
     * 
     * @access public
     * @return void
     */
    public function export2Xlsx()
    {
        $this->init();
        $this->setDocProps();
        $this->excelKey  = array();
        $this->maxWidths = array();
        for($i = 0; $i < count($this->fieldsKey); $i++)
        {
            $field = $this->fieldsKey[$i];
            $this->excelKey[$field] = $this->setExcelFiled($i);
            if(in_array($field, $this->config->excel->centerFields)) $this->styleSetting['center'][$this->excelKey[$field]] = 1;
            if(strpos($field, 'Date') !== false or in_array($field, $this->config->excel->dateField))$this->styleSetting['date'][$this->excelKey[$field]] = 1;
        }

        /* Show header data. */
        $this->sheet1SheetData = '<row r="1" spans="1:%colspan%" ht="20" customHeight="1">';
        foreach($this->fields as $key => $field) $this->sheet1SheetData .= $this->setCellValue($this->excelKey[$key], '1', $field);
        $this->sheet1SheetData .= '</row>';

        /* Write system data in excel.*/
        $this->writeSysData();

        $i = 1;
        $excelData = array();
        foreach($this->rows as $num => $row)
        {
            $i++;
            $columnData = array();
            $this->sheet1SheetData .= '<row r="' . $i . '" spans="1:%colspan%" ht="' . $this->config->excel->cellHeight . '" customHeight="1">';
            foreach($this->excelKey as $key => $letter)
            {
                $value = isset($row->$key) ? $row->$key : '';
                if(in_array($key, $this->config->excel->autoWidths))
                {
                    if(!isset($this->maxWidths[$key])) $this->maxWidths[$key] = 0;
                    if($this->maxWidths[$key] < strlen($value)) $this->maxWidths[$key] = strlen($value);
                }
                /* Merge Cells.*/
                if(isset($this->post->rowspan[$num]) and strpos($this->post->rowspan[$num]['rows'], ",$key,") !== false)
                {
                    $this->mergeCells($letter . $i, $letter . ($i + $this->post->rowspan[$num]['num'] - 1));
                }
                if(isset($this->post->colspan[$num]) and strpos($this->post->colspan[$num]['cols'], ",$key,") !== false)
                {
                    $this->mergeCells($letter . $i , chr(ord($letter) + $this->post->colspan[$num]['num'] - 1) . $i);
                }

                /* Wipe off html tags.*/
                if(isset($this->config->excel->editor[$this->post->kind]) and in_array($key, $this->config->excel->editor[$this->post->kind])) $value = $this->file->excludeHtml($value);
                if($key == 'files')
                {
                    $this->formatFiles($letter, $i, $value);
                } 
                else
                {
                    if(($key == 'project' or $key == 'product') and isset($value[1])) $value = $value[1] == ':' ? $substr($value, 2) : $value;
                    $this->sheet1SheetData .= $this->setCellValue($letter, $i, $value);
                }

                /* Build excel list.*/
                if(!empty($_POST['listStyle']) and in_array($key, $this->post->listStyle)) $this->buildList($key, $i);
            }
            $this->sheet1SheetData .= '</row>';
        }

        $initField = isset($this->config->excel->{$this->post->kind}->initField) ? $this->config->excel->{$this->post->kind}->initField : array();
        if(!empty($_POST['extraNum']))
        {
            $i++;
            $extraNum = $i + $this->post->extraNum;
            for($i; $i < $extraNum; $i++)
            {
                $this->sheet1SheetData .= '<row r="' . $i . '" spans="1:%colspan%" ht="' . $this->config->excel->cellHeight . '" customHeight="1">';
                foreach($this->fieldsKey as $field)
                {
                    if(isset($this->excelKey[$field]))
                    {
                        if(($field == 'project' or $field == 'product') and isset($_POST[$field]))
                        {
                            $this->sheet1SheetData .= $this->setCellValue($this->excelKey[$field], $i, $_POST[$field]);
                        }
                        elseif(strpos($field, 'Date') !== false or in_array($field, $this->config->excel->dateField))
                        {
                            $this->sheet1SheetData .= $this->setCellValue($this->excelKey[$field], $i, '0000-00-00');
                        }
                        elseif(isset($initField[$field]))
                        {
                            $this->sheet1SheetData .= $this->setCellValue($this->excelKey[$field], $i, $initField[$field]);
                        }
                        else
                        {
                            $this->sheet1SheetData .= $this->setCellValue($this->excelKey[$field], $i, '');
                        }
                    }

                    /* Build excel list.*/
                    if(!empty($_POST['listStyle']) and in_array($field, $this->post->listStyle)) $this->buildList($field, $i);
                }
                $this->sheet1SheetData .= '</row>';
            }
        }
        $this->sheet1Params['colspan'] = count($this->excelKey) + $this->fileCount - 1;
        /*Add help lang in end.*/
        if(isset($this->lang->excel->help->{$this->post->kind}) and !empty($_POST['extraNum']))
        {
            $this->mergeCells('A' . $i, $this->setExcelFiled($this->sheet1Params['colspan'] - 1) . $i);
            $this->sheet1SheetData .= '<row r="' . $i . '" spans="1:%colspan%">';
            $this->sheet1SheetData .= $this->setCellValue("A", $i, $this->lang->excel->help->{$this->post->kind});
            $this->sheet1SheetData .= '</row>';
        }
        $this->setStyle($i);

        if(!empty($this->sheet1Params['cols'])) $this->sheet1Params['cols'] = '<cols>' . join($this->sheet1Params['cols']) . '</cols>';
        if(!empty($this->sheet1Params['mergeCells'])) $this->sheet1Params['mergeCells'] = '<mergeCells count="' . $this->counts['mergeCells'] . '">' . $this->sheet1Params['mergeCells'] . '</mergeCells>';
        if(!empty($this->sheet1Params['dataValidations'])) $this->sheet1Params['dataValidations'] = '<dataValidations count="' . $this->counts['dataValidations'] . '">' . $this->sheet1Params['dataValidations'] . '</dataValidations>';
        if(!empty($this->sheet1Params['hyperlinks'])) $this->sheet1Params['hyperlinks'] = '<hyperlinks>' . $this->sheet1Params['hyperlinks'] . '</hyperlinks>';

        /* Save sheet1*/
        $endColumn = $this->setExcelFiled(count($this->excelKey) + $this->fileCount - 2);
        $sheet1 = file_get_contents($this->exportPath . 'xl/worksheets/sheet1.xml');
        $sheet1 = str_replace(array('%area%', '%xSplit%', '%topLeftCell%', '%cols%', '%sheetData%', '%mergeCells%', '%autoFilter%', '%dataValidations%', '%hyperlinks%', '%colspan%'),
            array($this->sheet1Params['area'], $this->sheet1Params['xSplit'], $this->sheet1Params['topLeftCell'], $this->sheet1Params['cols'], $this->sheet1SheetData, $this->sheet1Params['mergeCells'],
            empty($this->rows) ? '' : '<autoFilter ref="A1:' . $endColumn . '1"/>',
            $this->sheet1Params['dataValidations'], $this->sheet1Params['hyperlinks'], $this->sheet1Params['colspan']), $sheet1);
        file_put_contents($this->exportPath . 'xl/worksheets/sheet1.xml', $sheet1);

        $workbookFile = file_get_contents($this->exportPath . 'xl/workbook.xml');
        $workbookFile = str_replace('%autoFilter%', empty($this->rows) ? '' : '!$A$1:$' . $endColumn . '$1', $workbookFile);
        file_put_contents($this->exportPath . 'xl/workbook.xml', $workbookFile);

        /* Save sharedStrings file. */
        $this->sharedStrings .= '</sst>';
        $this->sharedStrings  = str_replace('%count%', $this->record, $this->sharedStrings);
        file_put_contents($this->exportPath . 'xl/sharedStrings.xml', $this->sharedStrings);

        /* Save link message. */
        if($this->rels)
        {
            $this->rels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' . $this->rels . '</Relationships>';
            if(!is_dir($this->exportPath . 'xl/worksheets/_rels/')) mkdir($this->exportPath . 'xl/worksheets/_rels/');
            file_put_contents($this->exportPath . 'xl/worksheets/_rels/sheet1.xml.rels', $this->rels);
        }

        /* urlencode the filename for ie. */
        $fileName = uniqid() . '.xlsx';

        /* Zip to xlsx. */
        helper::cd($this->exportPath);
        $files = array('[Content_Types].xml', '_rels', 'docProps', 'xl');
        $zip   = new pclzip($fileName);
        $zip->create($files);

        $fileData = file_get_contents($this->exportPath . $fileName);
        $this->zfile->removeDir($this->exportPath);
        $this->sendDownHeader($this->post->fileName . '.xlsx', 'xlsx', $fileData);
    }

    /**
     * Set excel style 
     * 
     * @param  int    $excelSheet 
     * @access public
     * @return void
     */
    public function setStyle($i)
    {
        $endColumn = $this->setExcelFiled(count($this->excelKey) + $this->fileCount - 2);
        $this->sheet1Params['area'] = "A1:$endColumn$i";
        $i         = isset($this->lang->excel->help->{$this->post->kind}) ? $i - 1 : $i;
        $letters   = array_values($this->excelKey);

        /* Freeze column.*/
        if(isset($this->config->excel->freeze->{$this->post->kind}))
        {
            $column = $this->excelKey[$this->config->excel->freeze->{$this->post->kind}];
            $column ++;
            $this->sheet1Params['topLeftCell'] = $column . '2';
            $this->sheet1Params['xSplit'] = array_search($column, $letters);
        }

        /* Set column width */
        foreach($this->excelKey as $key => $letter)
        {
            $shortWidth = $this->config->excel->width->short;
            $titleWidth = $this->config->excel->width->middle;
            $contWidth  = $this->config->excel->width->long;
            $postion    = array_search($letter, $letters) + 1;

            if(strpos($key, 'Date') !== false) $this->setWidth($postion, 12);
            if(in_array($key, $this->config->excel->shortFields)) $this->setWidth($postion, $shortWidth);
            if(in_array($key, $this->config->excel->titleFields)) $this->setWidth($postion, $titleWidth);
            if(isset($this->config->excel->editor[$this->post->kind]) and in_array($key, $this->config->excel->editor[$this->post->kind])) $this->setWidth($postion, $contWidth);
            if(in_array($key, $this->config->excel->autoWidths) and isset($this->maxWidths[$key]) and ($this->maxWidths[$key] * 0.7 + 0.71) > $shortWidth)
            {
                $this->setWidth($postion, $this->maxWidths[$key] * 0.7 + 0.71);
            }
            if(isset($_POST['width'][$key])) $this->setWidth($postion, $_POST['width'][$key]);
        }
    }

    /**
     * Set excel filed name.
     * 
     * @param  int    $count 
     * @access public
     * @return void
     */
    public function setExcelFiled($count)
    {
        $letter = 'A';
        for($i = 1; $i <= $count; $i++)$letter++;
        return $letter;
    }

    /**
     * Format files field.
     * 
     * @param  int    $excelSheet 
     * @param  int    $i 
     * @param  int    $content 
     * @access public
     * @return void
     */
    public function formatFiles($letter, $i, $content)
    {
        if(empty($content))
        {
            $this->sheet1SheetData .= $this->setCellValue($letter, $i, $content);
            return;
        }

        $content    = explode('<br />', $content);
        $fileCount  = 0;
        $fieldCount = count($this->excelKey);
        foreach($content as $key => $linkHtml)
        {
            if(empty($linkHtml)) continue;
            $fileCount ++;
            preg_match("/<a href='([^']+)'[^>]*>(.+)<\/a>/", $linkHtml, $out);
            $linkHref = $out[1];
            $linkName = $out[2];
            $fieldName = $this->setExcelFiled($fieldCount + $key - 1);
            $this->sheet1SheetData .= $this->setCellValue($fieldName, $i, $linkName);
            $this->counts['hyperlinks']++;
            $this->rels .= '<Relationship Id="rId' . $this->counts['hyperlinks'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink" Target="' . $linkHref . '" TargetMode="External"/>';
            $this->sheet1Params['hyperlinks'] .= '<hyperlink ref="' . $fieldName . $i . '" r:id="rId' . $this->counts['hyperlinks'] . '" display="' . $linkHref . '"/>';
        }

        if($fileCount > $this->fileCount) $this->fileCount = $fileCount;
    }

    /**
     * Write system data to sheet2
     * 
     * @access public
     * @return void
     */
    public function writeSysData()
    {
        $count   = 0;
        $maxList = '';
        $storyList   = isset($_POST['storyList']) ? array_values($_POST['storyList']) : '';
        $moduleList  = isset($_POST['moduleList']) ? array_values($_POST['moduleList']) : '';
        $projectList = isset($_POST['projectList']) ? array_values($_POST['projectList']) : '';
        $planList    = isset($_POST['planList']) ? array_values($_POST['planList']) : '';
        $buildList   = isset($_POST['buildList']) ? array_values($_POST['buildList']) : '';

        if($storyList and count($storyList) > $count)
        {
            $count   = count($storyList);
            $maxList = 'storyList';
        }
        if($moduleList and count($moduleList) > $count)
        {
            $count   = count($moduleList);
            $maxList = 'moduleList';
        }
        if($projectList and count($projectList) > $count)
        {
            $count   = count($projectList);
            $maxList = 'projectList';
        }
        if($planList and count($planList) > $count)
        {
            $count   = count($planList);
            $maxList = 'planList';
        }
        if($buildList and count($buildList) > $count)
        {
            $count   = count($buildList);
            $maxList = 'buildList';
        }
        $sheetData = '';
        if($maxList)
        {
            foreach($$maxList as $key => $value)
            {
                $row = $key + 1;
                $sheetData .= '<row r="' . $row . '" spans="1:5">';
                $sheetData .= $this->setCellValue('A', $row, isset($storyList[$key]) ? $storyList[$key] : '', false);
                $sheetData .= $this->setCellValue('B', $row, isset($moduleList[$key]) ? $moduleList[$key] : '', false);
                $sheetData .= $this->setCellValue('C', $row, isset($projectList[$key]) ? $projectList[$key] : '', false);
                $sheetData .= $this->setCellValue('D', $row, isset($planList[$key]) ? $planList[$key] : '', false);
                $sheetData .= $this->setCellValue('E', $row, isset($buildList[$key]) ? $buildList[$key] : '', false);
                $sheetData .= '</row>';
            }
        }

        $sheet2 = file_get_contents($this->exportPath . 'xl/worksheets/sheet2.xml');
        $sheet2 = sprintf($sheet2, "A1:E$count", $sheetData);
        file_put_contents($this->exportPath . 'xl/worksheets/sheet2.xml', $sheet2);
    }

    /**
     * Build drop list.
     * 
     * @param  string    $field 
     * @param  int       $row 
     * @access public
     * @return void
     */
    public function buildList($field, $row)
    {
        $listName = $field . 'List';
        $range = ($field == 'story' and isset($_POST['storyList'])) ? "{$this->lang->excel->title->sysValue}!\$A\$1:\$A\$" . (count($_POST['storyList']) == 0 ? 1 : count($_POST['storyList'])) :  (is_array($this->post->$listName) ? '' : '"' . $this->post->$listName . '"');
        $range = ($field == 'module' and isset($_POST['moduleList'])) ?  "{$this->lang->excel->title->sysValue}!\$B\$1:\$B\$" . (count($_POST['moduleList']) == 0 ? 1 : count($_POST['moduleList']))  : $range;
        $range = ($field == 'project' and isset($_POST['projectList'])) ? "{$this->lang->excel->title->sysValue}!\$C\$1:\$C\$" . (count($_POST['projectList']) == 0 ? 1 : count($_POST['projectList'])) : $range;
        $range = ($field == 'plan' and isset($_POST['planList'])) ? "{$this->lang->excel->title->sysValue}!\$D\$1:\$D\$" . (count($_POST['planList']) == 0 ? 1 : count($_POST['planList']))  : $range;
        $range = ($field == 'openedBuild' and isset($_POST['buildList'])) ? "{$this->lang->excel->title->sysValue}!\$E\$1:\$E\$" . (count($_POST['buildList']) == 0 ? 1 : count($_POST['buildList'])) : $range;

        $this->sheet1Params['dataValidations'] .= '<dataValidation type="list" showErrorMessage="1" errorTitle="' . $this->lang->excel->errorTitle . '" error="' . $this->lang->excel->error . '" sqref="' . $this->excelKey[$field] . $row . '">';
        $this->sheet1Params['dataValidations'] .= '<formula1>' . $range . '</formula1></dataValidation>';
        $this->counts['dataValidations']++;
    }

    /**
     * Merge cells 
     * 
     * @param  string    $start   like A1
     * @param  string    $end     like B1 
     * @access public
     * @return void
     */
    public function mergeCells($start, $end)
    {
        $this->sheet1Params['mergeCells'] .= '<mergeCell ref="' . $start . ':' . $end . '"/>';
        $this->counts['mergeCells']++;
    }

    /**
     * Set column width 
     * 
     * @param  int    $column 
     * @param  int    $width 
     * @access public
     * @return void
     */
    public function setWidth($column, $width)
    {
        $this->sheet1Params['cols'][$column] = '<col min="' . $column . '" max="' . $column . '" width="' . $width . '" customWidth="1"/>';
    }

    /**
     * Set cell value 
     * 
     * @param  string    $key 
     * @param  int       $i 
     * @param  int       $value 
     * @param  bool      $style 
     * @access public
     * @return string
     */
    public function setCellValue($key, $i, $value, $style = true)
    {
        /* Set style. The id number in styles.xml. */
        $s = '';
        if($style)
        {
            $s = $i % 2 == 0 ? '2' : '5';
            $s = $i == 1 ? 1 : $s;
            if($s != 1)
            {
                if(isset($this->styleSetting['center'][$key])) $s = $s == 2 ? 3 : 6;
                if(isset($this->styleSetting['date'][$key])) $s = $s <= 3 ? 4 : 7;
            }
            $s = 's="' . $s . '"';
        }

        $cellValue = '';
        if($value or $value === 0)
        {
            $cellValue .= '<c r="' . $key . $i . '" ' . $s . ' t="s"><v>' . $this->record . '</v></c>';
            $this->appendSharedStrings($value);
        }
        else
        {
            $cellValue .= '<c r="' . $key . $i . '" ' . $s . '/>';
        }

        return $cellValue;
    }

    /**
     * Set doc props 
     * 
     * @access public
     * @return void
     */
    public function setDocProps()
    {
        $sheetTitle = isset($this->lang->excel->title->{$this->post->kind}) ? $this->lang->excel->title->{$this->post->kind} : $this->post->kind;
        $appFile    = file_get_contents($this->exportPath . 'docProps/app.xml');
        $appFile    = sprintf($appFile, $sheetTitle, $this->lang->excel->title->sysValue);
        file_put_contents($this->exportPath . 'docProps/app.xml', $appFile);

        $coreFile   = file_get_contents($this->exportPath . 'docProps/core.xml');
        $createDate = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';
        $coreFile   = sprintf($coreFile, $createDate, $createDate);
        file_put_contents($this->exportPath . 'docProps/core.xml', $coreFile);

        $workbookFile = file_get_contents($this->exportPath . 'xl/workbook.xml');
        $workbookFile = str_replace(array('%sheetTitle%', '%sysValue%', '%definedNames%'), array($sheetTitle, $this->lang->excel->title->sysValue, empty($this->rows) ? '' : '<definedNames><definedName name="_xlnm._FilterDatabase" localSheetId="0" hidden="1">' . $sheetTitle . '%autoFilter%</definedName></definedNames>'), $workbookFile);
        file_put_contents($this->exportPath . 'xl/workbook.xml', $workbookFile);
    }

    /**
     * Append shared strings 
     * 
     * @param  string    $value 
     * @access public
     * @return void
     */
    public function appendSharedStrings($value)
    {
        $value    = htmlspecialchars($value);
        $preserve = strpos($value, "\n") === false ? '' : ' xml:space="preserve"';
        $this->sharedStrings .= '<si><t' . $preserve . '>' . $value . '</t></si>';
        $this->record++;
    }
}
