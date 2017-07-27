 <?php
include '../../control.php';
class myReport extends report
{
    /**
     * 项目任务统计
     *
     * @return void
     */
    public function taskSummary()
    {
        if ($_POST)
        {
            var_dump($_POST);die;
            $projects = $this->post->project;
            asort($projects);
            $projects = trim(implode(',', $projects), ',');
            $result = $this->report->taskSummary($projects);
            $this->view->info       = $result['info'];
            $this->view->echartData       = $result['echartData'];
        }
        $this->view->projects   = array('' => '') + $this->loadModel('project')->getPairs();
        $this->view->project    = '';
        $this->view->title      = $this->lang->report->taskSummary;
        $this->view->position[] = $this->lang->report->taskSummary;
        $this->view->submenu    = 'project';

        $this->display();
    }
}
