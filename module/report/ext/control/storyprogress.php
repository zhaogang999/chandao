<?php
include '../../control.php';
class myReport extends report
{
    /**
     * 项目需求进展统计.
     *
     * @return void
     */
    public function storyProgress()
    {
        $info = $this->report->storyProgress();

        $this->view->info       = $info;
        $this->view->title      = $this->lang->report->storyProgress;
        $this->view->position[] = $this->lang->report->storyProgress;
        $this->view->submenu    = 'project';
        $this->display();
    }
}
