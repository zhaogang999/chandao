<?php
global $app;
helper::cd($app->getBasePath());
helper::import('.\module\product\model.php');
helper::cd();
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
    //需求增加一个字段“”期望实现时间“，该字段的值采用下拉菜单格式，并且下拉菜单最好能调用产品-计划中的未关闭计划
    $this->config->product->search['params']['customPlan']['values']    = $this->loadModel('productplan')->getPairs($productID);
    
    //1195 跨产品进行需求关联时，默认搜索条件中所属产品为“所有产品”.搜索时默认所属产品为所有产品
    //$this->config->product->search['params']['product']['values'] = array('all' => $this->lang->product->allProduct, $productID => $products[$productID]);
    $this->config->product->search['params']['product']['values'] = array($productID => $products[$productID], 'all' => $this->lang->product->allProduct);
    $this->config->product->search['params']['product']['values'] += $products;
    //优化搜索功能增加空选项；
    $this->config->product->search['params']['module']['values']  = array('' => '') + $this->loadModel('tree')->getOptionMenu($productID, $viewType = 'story', $startModuleID = 0);

    if($this->session->currentProductType == 'normal')
    {
        unset($this->config->product->search['fields']['branch']);
        unset($this->config->product->search['params']['branch']);
    }
    else
    {
        $this->config->product->search['fields']['branch'] = $this->lang->product->branch;
        //改为默认为所有平台
        $this->config->product->search['params']['branch']['values']  = array('' => '') + $this->loadModel('branch')->getPairs($productID, 'noempty') + array('all' => $this->lang->branch->all);
    }

    $this->loadModel('search')->setSearchParams($this->config->product->search);
}
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/11/8
 * Time: 13:56
 */
/**
 * Create the link from module,method,extra
 *
 * @param  string  $module
 * @param  string  $method
 * @param  mix     $extra
 * @access public
 * @return void
 */
public function getProductLink($module, $method, $extra, $branch = false)
{
    $link = '';
    if(strpos('product,roadmap,bug,testcase,testtask,story,qa,testsuite,testreport,build', $module) !== false)
    {
        if($module == 'product' && $method == 'project')
        {
            $link = helper::createLink($module, $method, "status=all&productID=%s" . ($branch ? "&branch=%s" : ''));
        }
        elseif($module == 'product' && ($method == 'dynamic' or $method == 'doc' or $method == 'view'))
        {
            $link = helper::createLink($module, $method, "productID=%s");
        }
        elseif($module == 'qa' && $method == 'index')
        {
            $link = helper::createLink('bug', 'browse', "productID=%s" . ($branch ? "&branch=%s" : ''));
        }
        elseif($module == 'product' && ($method == 'browse' or $method == 'index' or $method == 'all'))
        {
            $link = helper::createLink($module, 'browse', "productID=%s" . ($branch ? "&branch=%s" : ''));
        }
        else
        {
            $link = helper::createLink($module, $method, "productID=%s" . ($branch ? "&branch=%s" : ''));
        }
    }
    else if($module == 'productplan' || $module == 'release')
    {
        if($method != 'browse' && $method != 'create') $method = 'browse';
        $link = helper::createLink($module, $method, "productID=%s" . ($branch ? "&branch=%s" : ''));
    }
    else if($module == 'tree')
    {
        $link = helper::createLink($module, $method, "productID=%s&type=$extra&currentModuleID=0" . ($branch ? "&branch=%s" : ''));
    }
    else if($module == 'doc')
    {
        $link = helper::createLink('doc', 'objectLibs', "type=product&objectID=%s&from=product");
    }
    //补丁版本产品列表下拉菜单
    else if ($module == 'patchbuild')
    {
        $link = helper::createLink('patchbuild', 'patchbuild', "productID=%s&type=$extra");
    }

    return $link;
}
//**//
}