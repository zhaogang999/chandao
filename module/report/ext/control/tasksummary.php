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
            $data = $this->post;
            $result = $this->report->taskSummary($data);

            $this->view->info              = $result['info'];
            $this->view->echartData       = $result['echartData'];
            $this->view->undoneTaskCount  = $result['undoneTaskCount'];
            $this->view->undoneTaskByType  = $result['undoneTaskByType'];
            $this->view->finishedTasksPerDay  = $result['finishedTasksPerDay'];
            $this->view->data = $data;
        }
        else
        {
            $data = new stdClass();
            $now = helper::today();
            $data->project = '';
            $data->begin = empty($data->begin)?date('Y-m-d', strtotime('-15days')):$data->begin;
            $data->end = empty($data->end)?$now:$data->end;
            $this->view->data = $data;
        }

        $projects = $this->loadModel('project')->getPairs();
        krsort($projects);
        $this->view->projects   = $projects;
        $this->view->project    = '';
        $this->view->title      = $this->lang->report->taskSummary;
        $this->view->position[] = $this->lang->report->taskSummary;
        $this->view->submenu    = 'project';

        $this->display();
    }
}
