<?php
include '../../control.php';
class myIndex extends index
{
    /**
     * The index page of whole zentao system.
     *
     * @access public
     * @return void
     */
    public function index()
    {
        $nowLoginDefaultPage = $this->dao->select('value')->from(TABLE_CONFIG)->where('`key`')->eq('loginDefaultPage')->fetch('value');
        //$nowLoginDefaultPage = $this->createLink('doc', 'view', array('186'));

        $this->loadModel('doc');

        if (isset($nowLoginDefaultPage))
        {
            $data = explode('-', rtrim(trim($nowLoginDefaultPage, '/'), '.html'));

            if ($data['0']== 'doc' && $data['1']=='view')
            {
                $doc = $this->doc->getById($data['2']);
                $lib  = $this->doc->getLibByID($doc->lib);

                if (common::hasPriv('doc', 'view') && $this->doc->checkPriv($lib))
                {
                    die(js::locate($this->createLink('doc', 'view', array($data[2]))));
                }
            }
            if ($data['0']== 'my' && $data['1']=='todostory')
            {
                if (common::hasPriv('my', 'todostory'))
                {
                    die(js::locate($this->createLink('my', 'todostory')));
                }
            }
        }

        $this->locate($this->createLink('my', 'index'));
    }
}
