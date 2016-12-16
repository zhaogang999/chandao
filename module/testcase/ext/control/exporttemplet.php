<?php
helper::import(dirname(dirname(dirname(__FILE__))) . "/control.php");
class mytestcase extends testcase
{
    public function exportTemplet($productID, $branch = 0)
    {
        if($_POST)
        {
            $this->testcase->setListValue($productID, $branch);
            $fields['module']       = $this->lang->testcase->module;
            $fields['story']        = $this->lang->testcase->story;
            $fields['title']        = $this->lang->testcase->title;
            $fields['stepDesc']     = $this->lang->testcase->stepDesc;
            $fields['stepExpect']   = $this->lang->testcase->stepExpect;
            $fields['keywords']     = $this->lang->testcase->keywords;
            $fields['type']         = $this->lang->testcase->type;
            $fields['pri']          = $this->lang->testcase->pri;
            $fields['status']       = $this->lang->testcase->status;
            $fields['stage']        = $this->lang->testcase->stage;
            $fields['precondition'] = $this->lang->testcase->precondition;
            $this->post->set('fields', $fields);
            $this->post->set('kind', 'testcase');
            $this->post->set('rows', array());
            $this->post->set('extraNum',   $this->post->num);
            $this->post->set('fileName', 'caseTemplate');
            $this->fetch('file', 'export2' . $this->post->fileType, $_POST);
        }

        $this->display();
    }
}
