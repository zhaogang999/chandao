<?php
include '../../control.php';
class mytask extends task
{
    public function exportTemplet($projectID)
    {
        if($_POST)
        {
            $this->task->setListValue($projectID);
            foreach($this->config->task->export->templateFields as $field) $fields[$field] = $this->lang->task->$field;
            $this->post->set('fields', $fields);
            $this->post->set('kind', 'task');
            $this->post->set('rows', array());
            $this->post->set('extraNum',   $this->post->num);
            $this->post->set('fileName', 'taskTemplate');
            $this->fetch('file', 'export2' . $this->post->fileType, $_POST);
        }

        $this->display();
    }
}
