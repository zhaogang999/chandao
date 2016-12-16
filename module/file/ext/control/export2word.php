<?php
<<<<<<< HEAD
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
=======
include "../../control.php";

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
function checkFileExist($matches)
{
    global $config;
    $filePath = $config->word->filePath;
    return file_exists($filePath . $matches[2]) ? '<img src="' . $matches[2] . '" alt="" />' : '';
}

class myfile extends file
{
    public $wordContent   = '';
    public $imgExtensions = array();
    public $relsID        = array();
    /**
     * Init for word 
     * 
     * @access public
     * @return void
     */
<<<<<<< HEAD
    public function docxInit()
    {
        $this->app->loadClass('pclzip', true);
        $this->zfile  = $this->app->loadClass('zfile');
        $this->fields = $this->post->fields;
=======
    public function init()
    {
        $this->app->loadClass('pclzip', true);
        $this->zfile  = $this->app->loadClass('zfile');
        $this->fields = $this->post->fields;//字段和字段名称对应
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $this->rows   = $this->post->rows;
        $this->relsID[6] = '';

        /* Init excel file. */
        $this->exportPath = $this->app->getCacheRoot() . $this->app->user->account . $this->post->kind . uniqid() . '/';
        if(is_dir($this->exportPath))$this->zfile->removeDir($this->exportPath);
        $this->zfile->mkdir($this->exportPath);
        $this->zfile->copyDir($this->app->getCoreLibRoot() . 'word', $this->exportPath);

        // post content: kind(string), exportFields(array), fields(array), rows(array), tableName(string), style(array), header(array).
        $this->kind         = $this->post->kind;
<<<<<<< HEAD
        $this->exportFields = isset($this->config->word->{$this->kind}->exportFields) ? $this->config->word->{$this->kind}->exportFields : '';
        $this->rowKey       = array();
        if(!empty($_POST['exprotFields'])) $this->exportFields = $this->post->exportFields;
        $this->fields['files'] = $this->lang->word->fileField;
=======
        //导出字段
        $this->exportFields = isset($this->config->word->{$this->kind}->exportFields) ? $this->config->word->{$this->kind}->exportFields : '';
        $this->rowKey       = array();
        if(!empty($_POST['exprotFields'])) $this->exportFields = $this->post->exportFields;
        $this->fields['files'] = $this->lang->word->fileField;//附件
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5

        $this->host = common::getSysURL();
    }

    /**
     * Export to Word 
     * 
     * @access public
     * @return void
     */
    public function export2Word()
    {
<<<<<<< HEAD
        $this->docxInit();
        $header     = isset($this->config->word->header->{$this->kind}) ? $this->config->word->header->{$this->kind} : (isset($this->post->header) ? $this->post->header : '');
        $header     = (object)$header;
        $headerName = empty($header) ? '' : $this->dao->select('*')->from($header->tableName)->where('id')->eq($this->session->{$header->name})->fetch();
        $this->setDocxDocProps($headerName);

        $tableName  = (empty($_POST['tableName'])) ? (isset($this->config->word->tableName->{$this->kind}) ? $this->config->word->tableName->{$this->kind} : '') : $this->post->tableName;
        if(empty($tableName)) die(js::alert($this->lang->word->notice->noexport));
=======
        $this->init();
        $header     = isset($this->config->word->header->{$this->kind}) ? $this->config->word->header->{$this->kind} : (isset($this->post->header) ? $this->post->header : '');
        $header     = (object)$header;
        $headerName = empty($header) ? '' : $this->dao->select('*')->from($header->tableName)->where('id')->eq($this->session->{$header->name})->fetch();
        $this->setDocProps($headerName);

        $tableName  = (empty($_POST['tableName'])) ? (isset($this->config->word->tableName->{$this->kind}) ? $this->config->word->tableName->{$this->kind} : '') : $this->post->tableName;
        if(empty($tableName)) die(js::alert($this->lang->word->notice->noexport));
        //模块信息
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $modules = $this->dao->select('t2.id, t2.path, t2.name, t2.parent, t2.grade, t1.id as kindID, t2.order')->from($this->config->word->tableName->{$this->kind})->alias('t1')
            ->leftJoin(TABLE_MODULE)->alias('t2')->on('t1.module=t2.id')
            ->where('t1.id')->in(array_keys($this->rows))
            ->orderBy('t2.grade asc, t2.order asc')
            ->fetchAll('kindID');

        $path   = '';
        $idList = array();
        foreach($modules as $module)$path .= ",{$module->path},";
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        foreach(explode(',', $path) as $moduleID)
        {
            if(empty($moduleID)) continue;
            $idList[$moduleID] = $moduleID;
        }
        $allModules = $this->dao->select('id,path,name,parent,grade,`order`')->from(TABLE_MODULE)
            ->where('id')->in($idList)
<<<<<<< HEAD
            ->andWhere('deleted')->eq(0)
=======
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
            ->orderBy('grade asc, `order` asc')
            ->fetchAll('id');

        $treeMenu = array();
        $rowKey   = array();
        $treeMenu[0][0] = 0;
        foreach($allModules as $id => $module)
        {
            if(!isset($treeMenu[$module->parent]) or !in_array($module->id, $treeMenu[$module->parent])) $treeMenu[$module->parent][] = $module->id;
        }
<<<<<<< HEAD
=======
        //$rowKey：模块id，需求id和对应的模块名称
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        foreach($modules as $id => $module) $rowKey[(int)$module->id][$id] = empty($module->name) ? '/' : $module->name;

        if(!isset($rowKey[0]))  unset($treeMenu[0][0]);
        if(empty($treeMenu[0])) unset($treeMenu[0]);
        reset($treeMenu);

<<<<<<< HEAD
        $this->treeMenu = $treeMenu;
        $this->modules  = $allModules;
=======
        $this->treeMenu = $treeMenu;//模块id
        $this->modules  = $allModules;//模块信息
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $this->rowKey   = $rowKey;

        if($headerName)
        {
            $this->addTitle($headerName->name, 2, 'center');
            $this->wordContent .= '<w:p><w:pPr><w:jc w:val="center"/><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr>';
            $this->addText('(' .$this->lang->word->headNotice, array('color' => '3F3F3F'), true);
            $this->addLink($this->lang->word->visitZentao, $this->host, array('color'=>'0000FF'), true);
            $this->addText(')', array('color' => '3F3F3F'), true);
            $this->wordContent .= '</w:p>';
        }

<<<<<<< HEAD
        $order = 1;
=======
        $order = 1;//word模块标题编号
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        foreach($treeMenu as $moduleID => $modules)
        {
            if(!isset($this->treeMenu[$moduleID])) continue;
            foreach($modules as $module) $this->createWord($module, 2, $order++);
        }

        $defaultImage   = '';
        $contentTypeXML = file_get_contents($this->exportPath . '[Content_Types].xml');
        foreach($this->imgExtensions as $imgExtension => $val) $defaultImage .= '<Default ContentType="image/' . $imgExtension . '" Extension="' . $imgExtension . '"/>'; 
        $contentTypeXML = str_replace('%defaultimage%', $defaultImage, $contentTypeXML);
        file_put_contents($this->exportPath . '[Content_Types].xml', $contentTypeXML);

        $imageRels    = '';
        $documentRels = file_get_contents($this->exportPath . 'word/_rels/document.xml.rels');
        foreach($this->relsID as $i => $extension)
        {
            if($extension) $imageRels .= '<Relationship Id="rId' . $i . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/image' . $i . '.' . $extension . '"/>';
        }
        $documentRels = str_replace('%image%', $imageRels, $documentRels);
        file_put_contents($this->exportPath . 'word/_rels/document.xml.rels', $documentRels);

        $documentXML = file_get_contents($this->exportPath . 'word/document.xml');
        $documentXML = str_replace('%wordContent%', $this->wordContent, $documentXML);
        file_put_contents($this->exportPath . 'word/document.xml', $documentXML);

        setcookie('downloading', 1);

        /* Zip to xlsx. */
        $fileName = uniqid() . '.docx';
        helper::cd($this->exportPath);
        $files = array('[Content_Types].xml', '_rels', 'docProps', 'word', 'customXml');
        $zip   = new pclzip($fileName);
        $zip->create($files);

        $fileData = file_get_contents($this->exportPath . $fileName);
        $this->zfile->removeDir($this->exportPath);
        $this->sendDownHeader($this->post->fileName . '.docx', 'docx', $fileData);
        exit;
    }

    /**
     * Create Word 
     * 
     * @param  int|array    $module 
     * @param  int    $step 
     * @param  int    $order 
     * @access public
     * @return void
     */
    public function createWord($module, $step = 1, $order = 0)
    {
        if(isset($this->treeMenu[$module]) and $module != 0)
        {
            $order = $this->createTitle($module, $step, $order);
<<<<<<< HEAD
            foreach($this->treeMenu[$module] as $childModule)
            {
=======

            foreach($this->treeMenu[$module] as $childModule)
            {

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
                $order = $this->getNextOrder($order, $step + 1);
                $this->createWord($childModule, $step + 1, $order);
            }
            unset($this->treeMenu[$module]);
        }
        else
        {
<<<<<<< HEAD
=======
        //执行else
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
            $this->createTitle($module, $step, $order);
        }
    }

    /**
     * Create title 
     * 
     * @param  int    $moduleID 
     * @param  int    $step 
     * @param  int    $order 
     * @access public
     * @return string
     */
    public function createTitle($moduleID, $step, $order)
    {
        if(isset($this->rowKey[$moduleID]))
        {
            $moduleName = current($this->rowKey[$moduleID]);
        }
        elseif(isset($this->modules[$moduleID]))
        {
            $moduleName = $this->modules[$moduleID]->name;
        }
<<<<<<< HEAD
=======
        //模块标题
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $this->addTitle($order . " " . $moduleName . "（#{$moduleID}）", $step);
        if(isset($this->rowKey[$moduleID]))
        {
            ksort($this->rowKey[$moduleID]);
<<<<<<< HEAD
            foreach($this->rowKey[$moduleID] as $rowID => $moduleName)
            {
                $order = $this->getNextOrder($order, $step + 1);
                $this->createContent($rowID, $step + 1, $order);
=======
            /*$this->rowKey数据格式
             * array(1) {
                  [7]=>
                  array(2) {
                    [7]=>
                    string(12) "关于我们"
                    [33]=>
                    string(12) "关于我们"
                    }
               }*/
            foreach($this->rowKey[$moduleID] as $rowID => $moduleName)
            {
                $order = $this->getNextOrder($order, $step + 1);//1,3  $order = 1.1
                //获得所属模块的需求内容
                $this->createContent($rowID, $step + 1, $order);//33,3,1.1  $rowID 需求id
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
            }
        }

        return $order;
    }

    /**
<<<<<<< HEAD
     * Create content 
=======
     * Create content 需求内容
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
     * 
     * @param  int    $contentID 
     * @param  int    $step 
     * @param  int    $order 
     * @access public
     * @return void
     */
    public function createContent($contentID, $step, $order)
    {
        if(!isset($this->rows[$contentID])) return false;
<<<<<<< HEAD
        $content  = $this->rows[$contentID];
        $filePath = $this->config->word->filePath;
        foreach($this->exportFields as $exportField)
        {
            $fieldName = $exportField;
            $style =isset($_POST['style'][$exportField]) ? $_POST['style'][$exportField] : (isset($this->config->word->{$this->kind}->style[$exportField]) ? $this->config->word->{$this->kind}->style[$exportField] : '');
            if($style == 'title')
            {
                $fieldContent = $order . ' ' . $content->$fieldName . "（#{$contentID}）";
                $this->addTitle($fieldContent, $step);
            }
            elseif($style == 'showImage')
            {
                $this->addText($this->fields[$fieldName] . ":", array('font-weight' => 'bold'));
                /* Change the tag of u em and stong to span. */
                $search       = array('<u>', '</u>', '<em>', '</em>', '<strong>', '</strong>', '<b>', '</b>', '&nbsp;');
                $replace      = array('<span style="text-decoration:underline">', '</span>', '<span style="font-style:italic">', '</span>', '<span style="font-weight:bold;">', '</span>', '<span style="font-weight:bold;">', '</span>', ' ');
                $fieldContent = preg_replace_callback('/<img .*src=([\"|\'])(.+)\\1 .*\/?>/U', 'checkFileExist', $content->$fieldName);
=======
        $content  = $this->rows[$contentID];//输出内容
        $filePath = $this->config->word->filePath;
        $number = 1;
        foreach($this->exportFields as $exportField)
        {

            $fieldName = $exportField;

            $style =isset($_POST['style'][$exportField]) ? $_POST['style'][$exportField] : (isset($this->config->word->{$this->kind}->style[$exportField]) ? $this->config->word->{$this->kind}->style[$exportField] : '');

            if($style == 'title')//需求标题
            {
                $fieldContent = $order . ' ' . $content->$fieldName . "（#{$contentID}）";
                $this->addTitle($fieldContent, $step);//,3
            }
            elseif($style == 'showImage')
            {
                //不用addText(),用addTitle();start
                //$this->addText($this->fields[$fieldName] . ":", array('font-weight' => 'bold'));
                if (!in_array($fieldName,$this->config->word->story->sonTitle))
                {
                    $order = $this->getNextOrder($order, $step + 1);
                    $this->addTitle($order . ' ' .$this->fields[$fieldName] . ":", $step+1);
                }else{
                    $sonNumber = $order . '.' .$number++;
                    $this->addTitle($sonNumber . ' ' .$this->fields[$fieldName] . ":", $step+2);
                }
                //end
                /* Change the tag of u em and stong to span. */
                $search       = array('<u>', '</u>', '<em>', '</em>', '<strong>', '</strong>', '<b>', '</b>', '&nbsp;');
                $replace      = array('<span style="text-decoration:underline">', '</span>', '<span style="font-style:italic">', '</span>', '<span style="font-weight:bold;">', '</span>', '<span style="font-weight:bold;">', '</span>', ' ');
                $fieldContent = preg_replace_callback('/<img .*src=([\"|\'])(.+)\\1 .*\/?>/U', 'checkFileExist', $content->$fieldName);//$fieldContent 字段内容
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
                $fieldContent = str_replace($search, $replace, $fieldContent);
                $fieldContent = str_replace(array("</li>", '</tr>', '<br />', '</p>'), "\n", $fieldContent);
                $fieldContent = preg_replace(array('/<h\d>/', '/<\/h\d>/'), array('', "\n"), $fieldContent);
                $fieldContent = strip_tags($fieldContent, '<a><img><span>');
                $fieldContent = explode("\n", $fieldContent);
<<<<<<< HEAD

=======
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
                foreach($fieldContent as $text)
                {
                    if(trim(strip_tags($text, '<img>')) == '') continue;
                    $this->wordContent .= '<w:p><w:pPr><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr>';
                    $this->pauseHtmlTag($text);
                    $this->wordContent .= '</w:p>';
                }
            }
<<<<<<< HEAD
            elseif($fieldName == 'files')
            {
                $this->formatDocxFiles($content);
=======
            elseif($fieldName == 'files')//附件
            {
                $this->formatFiles($content);
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
            }
            else
            {
                $this->wordContent .= '<w:p><w:pPr><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr>';
<<<<<<< HEAD
                $this->addText($this->fields[$fieldName] . "：", array('font-weight' => 'bold'), true);
=======
                //增加字段名称
                $this->addText($this->fields[$fieldName] . "：", array('font-weight' => 'bold'), true);
                //增加字段内容
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
                $this->addText($content->$fieldName, array(), true);
                $this->wordContent .= '</w:p>';
            }
        }
        $detailLink = substr($this->server->http_referer, 0, strpos($this->server->http_referer, '/', 10)) . $this->createLink($this->kind, 'view', "id=$contentID");
        $this->wordContent .= '<w:p><w:pPr><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr>';
<<<<<<< HEAD
=======
        //增加‘更多点击’
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $this->addText($this->lang->word->more . '：',  array('font-weight' => 'bold'), true);
        $this->addLink($detailLink, $detailLink, array('color'=>'0000FF'), true);
        $this->wordContent .= '</w:p>';
        $this->addTextBreak();
    }

    /**
     * Format files 
     * 
     * @param  string    $content 
     * @access public
     * @return void
     */
<<<<<<< HEAD
    public function formatDocxFiles($content)
=======
    public function formatFiles($content)
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
    {
        if(empty($content->files)) return;
        $this->addText($this->fields['files'] . ':', array('font-weight' => 'bold'));
        $filePath     = $this->config->word->filePath;
        $fieldContent = explode('<br />', $content->files);
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        foreach($fieldContent as $linkHtml)
        {
            if(empty($linkHtml)) continue;
            preg_match("/<a href=([\"|\'])([^']+)\\1[^>]*>(.+)<\/a>/", $linkHtml, $out);
            $linkHref = $out[2];
            $extension = strtolower(trim(strrchr($linkHref, '.'), '.'));
            $linkName = $out[3];
            if(in_array($extension, $this->config->word->imageExtension))
            {
                $linkHref = strstr(strstr($linkHref, $this->server->server_name), '/');
                if(!file_exists($filePath . $linkHref)) continue;
                $this->addImage($filePath . $linkHref);
                $this->addTextBreak();
            }
            else
            {
                $this->addLink($linkName . ".$extension", $linkHref, array('color'=>'0000FF'));
            }
        }
    }

    /**
     * Get next order 
     * 
     * @param  int    $order 
     * @param  int    $step 
     * @access public
     * @return void
     */
    public function getNextOrder($order, $step)
    {
        if($step == 1) return 0;
        $orders = explode('.', $order);
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        if(count($orders) + 1 == $step -1)
        {
            $order .= '.1';
        }
        else
        {
            $orders[count($orders) -1] = end($orders) + 1;
            $order = join('.', $orders);
        }
        return $order;
    }

    /**
     * Add title 
     * 
     * @param  sting    $text 
     * @param  int    $grade 
     * @param  string $align 
     * @access public
     * @return void
     */
    public function addTitle($text, $grade = 1, $align = 'left')
    {
        $this->wordContent .= "<w:p><w:pPr><w:pStyle w:val='$grade'/>";
        if($align != 'left') $this->wordContent .= "<w:jc w:val='$align'/>"; 
        $this->wordContent .= "<w:rPr><w:rFonts w:hint='eastAsia'/><w:lang w:val='en-US' w:eastAsia='zh-CN'/></w:rPr></w:pPr>";
        $this->pauseHtmlTag($text);
        $this->wordContent .= '</w:p>';
    }

    /**
     * Pause html tag 
     * 
     * @param  string    $text 
     * @access public
     * @return void
     */
    public function pauseHtmlTag($text)
    {
        $out = array();
        preg_match_all('/(<br ?\/?>)/U', $text, $out);
        $splitByBR = preg_split("/<br ?\/?>/U", $text);
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        if($out[0])
        {
            foreach($splitByBR as $i => $content)
            {
                if($content) $this->pauseHtmlTag($content);

                if(!isset($out[1][$i])) continue;
                $this->wordContent .= '</w:p><w:p><w:pPr><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr>';
            }
            return false;
        }

        $out = array();
        preg_match_all("/<img .*src=([\"|\'])(.*)\\1 .*\/?>/U", $text, $out);
        $splitByIMG = preg_split("/<img .*src=([\"|\'])(.*)\\1 .*\/?>/U", $text);
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        if($out[0])
        {
            foreach($splitByIMG as $i => $content)
            {
                if($content) $this->pauseHtmlTag($content);

                if(!isset($out[2][$i])) continue;
                $this->addImage($this->config->word->filePath . $out[2][$i], true);
            }
            return false;
        }

        $out = array();
        preg_match_all("/<a .*href=([\"|\'])(.*)\\1.*>(.*)<\/a>/U", $text, $out);
        $splitByA = preg_split("/<a .*href=([\"|\'])(.*)\\1.*>(.*)<\/a>/U", $text);
        if($out[0])
        {
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
            foreach($splitByA as $i => $content)
            {
                if($content) $this->pauseHtmlTag($content);

                if(!isset($out[3][$i])) continue;
                $content = trim($out[3][$i]);
                if(empty($content)) continue;
                $this->addLink($out[3][$i], $out[2][$i], array('color'=>'0000FF'), true);
            }
            return false;
        }
<<<<<<< HEAD

=======
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $this->addText($text, array(), true);
    }

    /**
<<<<<<< HEAD
     * Add text 
=======
     * Add text
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
     * 
     * @param  string    $text 
     * @param  array  $styles 
     * @param  bool    $inline 
     * @access public
     * @return void
     */
    public function addText($text, $styles = array(), $inline = false)
    {
        $out = array();
        preg_match_all("/<span .*style=([\"|\'])(.*)\\1>(.*)<\/span>/U", $text, $out);
        $noTags = preg_split("/<span .*style=([\"|\'])(.*)\\1>(.*)<\/span>/U", $text);
<<<<<<< HEAD
=======

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        if($out[2])
        {
            foreach($out[2] as $i => $styles)
            {
                $styles = explode(';', $styles);
                unset($out[2][$i]);
                foreach($styles as $style)
                {   
                    if(empty($style)) continue;
                    if(strpos($style, ':') === false) continue;
                    list($key, $value) = explode(':', $style);

                    $out[2][$i][$key] = $value;
                }   
            }

            foreach($noTags as $i => $content)
            {
                if($content)$this->addText($content, array(), true);

                if(!isset($out[3][$i])) continue;
                $content = trim($out[3][$i]);
                if(empty($content)) continue;
                $this->addText($content, $out[2][$i], true);
            }
            return false;
        }
        $text = trim(strip_tags($text));
        if(empty($text)) return false;
        $document = '';
        if(!$inline) $document .= '<w:p><w:pPr><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr>';
        $document .= '<w:r>';
        $document .= $this->transformStyle($styles);
        $document .= "<w:t><![CDATA[$text]]></w:t>";
        $document .= '</w:r>';
        if(!$inline) $document .= '</w:p>';
        $this->wordContent .= $document;
    }
    /**
     * Add link 
     * 
     * @param  string    $text 
     * @param  string    $href 
     * @param  array     $styles 
     * @param  bool      $inline 
     * @access public
     * @return void
     */
    public function addLink($text, $href, $styles = array(), $inline = false)
    {
        $document = '';
        $href     = preg_replace('/&(quot|#34);/i', '&', $href);
        if(!$inline) $document .= '<w:p><w:pPr><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr>';
        $document .= '<w:r><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr><w:fldChar w:fldCharType="begin"/></w:r>';
        $document .= '<w:r><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr><w:instrText xml:space="preserve">HYPERLINK "<![CDATA[' . $href . ']]>"</w:instrText></w:r>';
        $document .= '<w:r><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr><w:fldChar w:fldCharType="separate"/></w:r>';
        $document .= '<w:r>';
        $document .= $this->transformStyle($styles);
        $document .= "<w:t><![CDATA[$text]]></w:t>";
        $document .= '</w:r><w:r><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr><w:fldChar w:fldCharType="end"/></w:r>';
        if(!$inline) $document .= '</w:p>';
        $this->wordContent .= $document;
    }

    /**
     * Add image 
     * 
     * @param  int    $path 
     * @param  int    $inline 
     * @access public
     * @return void
     */
    public function addImage($path, $inline = false)
    {
        if(!file_exists($path)) return false;

        $extension = substr($path, strrpos($path, '.') + 1);
        $this->imgExtensions[$extension] = true;
        $this->relsID[] = $extension;

        end($this->relsID);
        $relsID = key($this->relsID);
        copy($path, $this->exportPath . '/word/media/image' . $relsID . '.' . $extension);

        list($width, $height) = getimagesize($path);
        $rate = (float)$height / $width;
        if($width >= 540)
        {
            $width  = 540;
            $height = $width * $rate;
        }

        $document = '';
        if(!$inline) $document .= '<w:p><w:pPr><w:rPr><w:rFonts w:hint="eastAsia"/><w:kern w:val="2"/><w:sz w:val="21"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr>';
        $document .= '<w:r><w:rPr><w:rFonts w:hint="eastAsia" /><w:kern w:val="2"/><w:sz w:val="21"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr>';
        $document .= '<w:pict><v:shape id="pict' . $relsID . '" o:spid="_x0000_s1025" type="#_x0000_t75" style="height:' . $height . 'px;width:' . $width . 'px;rotation:0f;" o:ole="f" fillcolor="#FFFFFF" filled="f" o:preferrelative="t" stroked="f" coordorigin="0,0" coordsize="21600,21600"><v:fill on="f" color2="#FFFFFF" focus="0%"/>';
        $document .= '<v:imagedata gain="65536f" blacklevel="0f" gamma="0" o:title="5" r:id="rId' . $relsID . '"/>';
        $document .= '<o:lock v:ext="edit" position="f" selection="f" grouping="f" rotation="f" cropping="f" text="f" aspectratio="t"/><w10:wrap type="none"/><w10:anchorlock/></v:shape></w:pict></w:r>';
        if(!$inline) $document .= '</w:p>';

        $this->wordContent .= $document;
    }

    /**
     * Add text break 
     * 
     * @param  int    $num 
     * @access public
     * @return void
     */
    public function addTextBreak($num = 1)
    {
        $document = '';
        for($i = 0; $i < $num; $i++) $document .= '<w:p><w:pPr><w:rPr><w:rFonts w:hint="eastAsia"/><w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr></w:pPr></w:p>';
        $this->wordContent .= $document;
    }

    /**
     * Transform style 
     * 
     * @param  array  $styles 
     * @access public
     * @return void
     */
    public function transformStyle($styles = array())
    {

        $wordStyle  = '<w:rPr>';
        if(isset($styles['font-family'])) $styles['font-family'] = str_replace(array('&', ';'), '', $styles['font-family']);
        $wordStyle .= isset($styles['font-family']) ? '<w:rFonts w:hint="eastAsia" w:ascii="' . $styles['font-family'] . '" w:hAnsi="' . $styles['font-family'] . '" w:eastAsia="' . $styles['font-family'] . '" w:cs="' . $styles['font-family'] . '"/>' : '<w:rFonts w:hint="eastAsia"/>';
        foreach($styles as $key => $value)
        {
            switch($key)
            {
            case 'font-style':
                $wordStyle .= '<w:i/><w:iCs/>';
                break;
            case 'font-weight':
                $wordStyle .= '<w:b/><w:bCs/>';
                break;
            case 'text-decoration':
                $wordStyle .= '<w:u w:val="single" w:color="auto"/>';
                break;
            case 'color':
                $wordStyle .= '<w:color w:val="' . substr($value, 1) .'"/>';
                break;
            case 'font-size':
                preg_match('/\d+(\.\d+)?/', $value, $out);
                $value = $out[0] * 2;
                $wordStyle .= '<w:sz w:val="' . $value . '"/><w:szCs w:val="' . $value . '"/>';
                break;
            }
        }
        $wordStyle .= '<w:lang w:val="en-US" w:eastAsia="zh-CN"/></w:rPr>';
        return $wordStyle;
    }
        
    /** 
<<<<<<< HEAD
     * Set doc props 
=======
     * Set doc props 配置文档信息
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
     *  
     * @access public 
     * @return void 
     */
<<<<<<< HEAD
    public function setDocxDocProps($header)
    {
        $title      = $header ? $header->name : $this->post->kind;
        $coreFile   = file_get_contents($this->exportPath . 'docProps/core.xml');
        $createDate = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';
=======
    public function setDocProps($header)
    {
        $title      = $header ? $header->name : $this->post->kind;//标题
        $coreFile   = file_get_contents($this->exportPath . 'docProps/core.xml');
        $createDate = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';//创建时间
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        $account    = $this->app->user->account;
        $coreFile   = sprintf($coreFile, $createDate, $account, $account, $createDate, $title);
        file_put_contents($this->exportPath . 'docProps/core.xml', $coreFile);
    }
}
