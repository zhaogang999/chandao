<?php
include '../../control.php';
class myReport extends report
{
    /**
     * Project Summary report.
     *
     * @return void
     */
    public function projectSummary()
    {
        $info = $this->report->projectSummary();
    
        $this->view->info = $info;
        $this->view->title      = $this->lang->report->projectSummary;
        $this->view->position[] = $this->lang->report->projectSummary;
        $this->view->submenu  = 'project';
        $this->display();
    }
}
