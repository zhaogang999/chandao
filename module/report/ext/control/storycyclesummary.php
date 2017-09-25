 <?php
include '../../control.php';
class myReport extends report
{
    /**
     * 需求周期统计
     *
     * @param $project int
     * @return void
     */
    public function storyCycleSummary($project=0)
    {
        if ($project !=0)
        {
            $result = $this->report->storyCycleSummary($project);
            
            $this->view->result = $result;
        }

        $this->view->project    = $project;
        $this->view->projects   = array(''=>'') + $this->loadModel('project')->getPairs();
        $this->view->title      = $this->lang->report->storyCycleSummary;
        $this->view->position[] = $this->lang->report->storyCycleSummary;
        $this->view->submenu    = 'project';

        $this->display();
    }
}
