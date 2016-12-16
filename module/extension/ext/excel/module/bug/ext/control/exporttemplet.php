<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mybug extends bug
{
    public function exportTemplet($productID, $branch = 0)
    {
        if($_POST)
        {
            $this->bug->setListValue($productID, $branch);
            foreach($this->config->bug->export->templateFields as $field) $fields[$field] = $this->lang->bug->$field;
            $this->post->set('fields', $fields);
            $this->post->set('kind', 'bug');
            $this->post->set('rows', array());
            $this->post->set('extraNum',   $this->post->num);
            $this->post->set('fileName', 'bugTemplate');
            $this->fetch('file', 'export2' . $this->post->fileType, $_POST);
        }

        $this->display();
    }
}
