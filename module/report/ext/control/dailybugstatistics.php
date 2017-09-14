 <?php
include '../../control.php';
class myReport extends report
{
    /**
     * 每日bug情况统计
     *
     * @return void
     */
    public function dailyBugStatistics()
    {
        if ($_POST)
        {
            $data = $_POST;
            $now = helper::today();

            $data['begin'] = empty($data['begin'])?date('Y-m-d', strtotime('-1month')):$data['begin'];
            $data['end'] = empty($data['end'])?$now:$data['end'];

            $result = $this->report->dailyBugStatistics($data);

            $this->view->product    = $data['product'];
            $this->view->begin    = $data['begin'];
            $this->view->end    = $data['end'];
            $this->view->result = $result;
        }

        $this->view->products   = array(''=>'') + $this->loadModel('product')->getPairs('noclosed');
        $this->view->title      = $this->lang->report->dailyBugStatistics;
        $this->view->position[] = $this->lang->report->dailyBugStatistics;
        $this->view->submenu    = 'test';

        $this->display();
    }
}
