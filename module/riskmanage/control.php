<?php

/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/3/1
 * Time: 15:16
 */
class riksmanage extends control
{
    public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);
        /* Load need modules. */
        $this->loadModel('riksmanage');
    }
    
}