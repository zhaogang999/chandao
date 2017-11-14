<?php
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
