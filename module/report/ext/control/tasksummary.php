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

            //var_dump($this->view->undoneTaskCount);die;
        }
        $this->view->projects   = $this->loadModel('project')->getPairs();
        $this->view->project    = '';
        $this->view->title      = $this->lang->report->taskSummary;
        $this->view->position[] = $this->lang->report->taskSummary;
        $this->view->submenu    = 'project';

        $this->display();
    }
}
