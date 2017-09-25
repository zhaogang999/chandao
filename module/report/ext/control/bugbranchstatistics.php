 <?php
include '../../control.php';
class myReport extends report
{
    /**
     * bug按平台统计
     *
     * @param $product int
     * @return void
     */
    public function bugBranchStatistics($product=0)
    {
        if ($product !=0)
        {
            $result = $this->report->bugBranchStatistics($product);
            
            $this->view->result = $result;
            $this->view->branchs = $this->loadModel('branch')->getPairs($product);
        }

        $this->view->product    = $product;
        $this->view->products   = array(''=>'') + $this->loadModel('product')->getPairs('noclosed');
        $this->view->title      = $this->lang->report->bugBranchStatistics;
        $this->view->position[] = $this->lang->report->bugBranchStatistics;
        $this->view->submenu    = 'test';

        $this->display();
    }
}
