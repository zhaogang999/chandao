 <?php
include '../../control.php';
class myReport extends report
{
    /**
     * 需求燃起图
     *
     * @return void
     */
    public function burnUp()
    {
        if ($_POST)
        {
            $data = $_POST;

            $project = $this->loadModel('project')->getById($data['project']);
            $data['begin'] = empty($data['begin'])?$project->begin:$data['begin'];
            $data['end'] = empty($data['end'])?$project->end:$data['end'];

            $result = $this->report->burnUp($data);

            $this->view->project    = $data['project'];
            $this->view->begin    = $data['begin'];
            $this->view->end    = $data['end'];
            $this->view->burnUpData = $result;
        }

        $this->view->projects   = array(''=>'') + $this->loadModel('project')->getPairs();
        $this->view->title      = $this->lang->report->burnUp;
        $this->view->position[] = $this->lang->report->burnUp;
        $this->view->submenu    = 'project';

        $this->display();
    }
}
