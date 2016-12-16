<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mystory extends story
{
    public function exportTemplet($productID, $branch = 0)
    {
        if($_POST)
        {
            $this->story->setListValue($productID, $branch);
            foreach($this->config->story->export->templateFields as $field) $fields[$field] = $this->lang->story->$field;
            $this->post->set('fields', $fields);
            $this->post->set('kind', 'story');
            $this->post->set('rows', array());
            $this->post->set('extraNum',   $this->post->num);
            $this->post->set('fileName', 'storyTemplate');
            $this->fetch('file', 'export2' . $this->post->fileType, $_POST);
        }

        $this->display();
    }
}
