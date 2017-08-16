<?php
include '../../control.php';
class myCustom extends custom
{
    /**
     * loginDefaultPage zentao.
     *
     * @access public
     * @return void
     */
    public function loginDefaultPage()
    {
        if($_POST)
        {
            $loginDefaultPage = substr($this->post->loginDefaultPage, strrpos($this->post->loginDefaultPage, '/'));
            $this->loadModel('setting')->setItem('system.custom.loginDefaultPage', $loginDefaultPage);
            die(js::reload('parent'));
        }

        $nowLoginDefaultPage = $this->dao->select('value')->from(TABLE_CONFIG)
            ->where('`key`')->eq('loginDefaultPage')
            ->fetch('value');
        
        $this->view->nowLoginDefaultPage = 'http://' . $_SERVER['HTTP_HOST'] . '/zentao' . $nowLoginDefaultPage;
        $this->view->title      = $this->lang->custom->loginDefaultPage;
        $this->view->position[] = $this->lang->custom->loginDefaultPage;
        $this->display();
    }
}