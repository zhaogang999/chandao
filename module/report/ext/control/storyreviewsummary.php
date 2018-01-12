<?php
include '../../control.php';
class myReport extends report
{
    /**
     * 项目需求统计.
     *
     * @return void
     */
    public function storyReviewSummary()
    {
        $info = $this->report->storyReviewSummary();

        $this->view->info       = $info;
        $this->view->title      = $this->lang->report->storyReviewSummary;
        $this->view->position[] = $this->lang->report->storyReviewSummary;
        $this->view->submenu    = 'project';
        $this->display();
    }
}
