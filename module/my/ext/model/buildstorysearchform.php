<?php
/**
 * Build search form.
 *
 * @param  array  $products
 * @param  int    $queryID
 * @param  int    $actionURL
 * @access public
 * @return void
 */
public function buildStorySearchForm($products, $queryID=0, $actionURL)
{
    $this->config->product->search['actionURL'] = $actionURL;
    $this->config->product->search['queryID']   = $queryID;
    $this->config->product->search['params']['product']['values'] = array( 'all' => $this->lang->product->allProduct);
    $this->config->product->search['params']['product']['values'] += $products;

    unset($this->config->product->search['fields']['branch']);
    unset($this->config->product->search['params']['branch']);
    unset($this->config->product->search['fields']['module']);
    unset($this->config->product->search['params']['module']);
    unset($this->config->product->search['fields']['plan']);
    unset($this->config->product->search['params']['plan']);
    unset($this->config->product->search['fields']['customPlan']);
    unset($this->config->product->search['params']['customPlan']);

    $this->loadModel('search')->setSearchParams($this->config->product->search);
}
