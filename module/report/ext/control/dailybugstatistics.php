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
            
            $this->view->result = $result;
        }

        $this->view->product    = isset($data['product'])?$data['product']:0;
        $this->view->begin    = isset($data['begin'])?$data['begin']:'';
        $this->view->end    = isset($data['end'])?$data['end']:'';
        $this->view->products   = array(''=>'') + $this->loadModel('product')->getPairs('noclosed');
        $this->view->title      = $this->lang->report->dailyBugStatistics;
        $this->view->position[] = $this->lang->report->dailyBugStatistics;
        $this->view->submenu    = 'test';

        $this->display();
    }
}
