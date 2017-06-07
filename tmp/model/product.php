<?php
helper::import('H:\zentao\chandao\module\product\model.php');
class extproductModel extends productModel 
{
/**
 * Build search form.
 *
 * @param  int    $productID
 * @param  array  $products
 * @param  int    $queryID
 * @param  int    $actionURL
 * @access public
 * @return void
 */
public function buildSearchForm($productID, $products, $queryID, $actionURL)
{
    $this->config->product->search['actionURL'] = $actionURL;
    $this->config->product->search['queryID']   = $queryID;
    $this->config->product->search['params']['plan']['values']    = $this->loadModel('productplan')->getPairs($productID);
    //搜索时默认所属产品为所有产品
    $this->config->product->search['params']['product']['values'] = array('all' => $this->lang->product->allProduct, $productID => $products[$productID]);
    $this->config->product->search['params']['module']['values']  = $this->loadModel('tree')->getOptionMenu($productID, $viewType = 'story', $startModuleID = 0);
    if($this->session->currentProductType == 'normal')
    {
        unset($this->config->product->search['fields']['branch']);
        unset($this->config->product->search['params']['branch']);
    }
    else
    {
        $this->config->product->search['fields']['branch'] = $this->lang->product->branch;
        $this->config->product->search['params']['branch']['values']  = array('' => '') + $this->loadModel('branch')->getPairs($productID, 'noempty') + array('all' => $this->lang->branch->all);
    }

    $this->loadModel('search')->setSearchParams($this->config->product->search);
}
//**//
}