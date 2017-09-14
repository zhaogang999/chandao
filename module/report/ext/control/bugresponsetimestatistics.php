<?php
include '../../control.php';
class myReport extends report
{
    /**
     * bug解决&响应时间.
     *
     * @return void
     */
    public function bugResponseTimeStatistics()
    {
        $info = $this->report->bugResponseTimeStatistics();
        
        $this->view->info       = $info;
        $this->view->title      = $this->lang->report->bugResponseTimeStatistics;
        $this->view->position[] = $this->lang->report->bugResponseTimeStatistics;
        $this->view->submenu    = 'test';
        $this->display();
    }
}
