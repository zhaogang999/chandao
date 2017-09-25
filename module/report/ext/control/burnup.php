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
            
            $this->view->burnUpData = $result;
        }

        $projects = $this->loadModel('project')->getPairs();
        krsort($projects);

        $this->view->project    = isset($data['project'])?$data['project']:0;
        $this->view->begin    = isset($data['begin'])?$data['begin']:'';
        $this->view->end    = isset($data['end'])?$data['end']:'';
        $this->view->projects   = array(''=>'') + $projects;
        $this->view->title      = $this->lang->report->burnUp;
        $this->view->position[] = $this->lang->report->burnUp;
        $this->view->submenu    = 'project';

        $this->display();
    }
}
