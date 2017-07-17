<?php
global $app;
helper::cd($app->getBasePath());
helper::import('.\module\common\model.php');
helper::cd();
class extcommonModel extends commonModel 
{
/**
     * Check the user has permission to access this method, if not, locate to the login page or deny page.
     * 
     * @access public
     * @return void
     */
    public function checkPriv()
    {
        $module = $this->app->getModuleName();
        $method = $this->app->getMethodName();


        //$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'] ;
        $signature = '' ;
        $secret = "123456";
        $account = 'admin';

        if ($signature) 
        {
            
            $hash = "sha1=" . hash_hmac('sha1', file_get_contents('php://input'), $secret);
            //$sss = strcmp($signature, $hash);
            //echo $sss;die;
            if (strcmp($signature, $hash) == 0) 
            {
                //echo "dddddd";
                $user = $this->dao->select('*')->from(TABLE_USER)
                    ->where('account')->eq($account)
                    ->andWhere('deleted')->eq(0)
                    ->fetch();
                //echo $user;
                $this->loadModel('user');
                $user->rights = $this->user->authorize($account);
                //var_dump($user->rights);die;
                $user->groups = $this->user->getGroups($account);
                $this->app->user = $user;
                //return true;
            }
        }

        if(isset($this->app->user->modifyPassword) and $this->app->user->modifyPassword and $module != 'my' and $method != 'changepassword') die(js::locate(helper::createLink('my', 'changepassword')));
        if($this->isOpenMethod($module, $method)) return true;
        if(!$this->loadModel('user')->isLogon() and $this->server->php_auth_user) $this->user->identifyByPhpAuth();
        if(!$this->loadModel('user')->isLogon() and $this->cookie->za) $this->user->identifyByCookie();

        if(isset($this->app->user))
        {
            if(!commonModel::hasPriv($module, $method)) $this->deny($module, $method);
        }
        else
        {
            $referer  = helper::safe64Encode($this->app->getURI(true));
            die(js::locate(helper::createLink('user', 'login', "referer=$referer")));
        }
    }
//**//
}