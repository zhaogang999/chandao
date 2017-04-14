<?php

class github extends control
{
	//session_start(); //此示例中要使用session
	//require_once('config.php');
	//require_once('github.php');

	 public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);

        /* Load need modules. */
        $this->loadModel('github');

		$github_t = isset($_SESSION['github_t'])?$this->session->github_t:'';
		//var_dump($github_t);die;
		//var_dump($this->session->github_t);
		//检查是否已登录
		if($github_t=='')
		{
			//生成登录链接
			//$github=new githubPHP($github_k, $github_s);
			$login_url=$this->github->login_url($this->config->github->callback_url,'user,repo,public_repo,repo_deployment,repo:status,delete_repo,admin:repo_hook');
			//var_dump($login_url);die;
			echo '<a href="'.$login_url.'">点击进入授权页面</a>';
			//https://github.com/login/oauth/
		}
    }

	public function chuanzhi()
	{
		$a = 5;
		$b = &$a;
		unset($a);
		echo $a;
	}

    public function pic()
    {
    	$content = file_get_contents("https://cloud.githubusercontent.com/assets/23447598/24836202/39317b12-1d48-11e7-8022-bf384b9e1ccd.png");
    	file_put_contents('ffff.png', $content);
    	//echo $content;

    }

    public function sync($bugID)
    {
		$bug = $this->loadModel('bug')->getById($bugID);
		//var_dump($bug);die;
    	$data = array(
				'title'=>$bug->title,
				'body'=>$bug->steps,
				'labels'=>["bug"],
				);
		//$data = array();
		$result=$this->github->api('repos/zhaogang999/shop/issues', $data, 'POST');
		var_dump($result);die;
    }

	public function userInfo()
	{
		$github_t=isset($_SESSION['github_t'])?$this->session->github_t:'';
		//var_dump($github_t);die;
		//var_dump($this->session->github_t);
		//检查是否已登录
		if($github_t!=''){
			//$github=new githubPHP($github_k, $github_s, $github_t);

			//获取登录用户信息
			/*$result=$this->github->me();
			var_dump($result);
*/
			
			//获取登录用户代码仓库
			/*$result=$this->github->repos();
			var_dump($result);*/
			

			
			//获取登录用户代码片段
			/*$result=$this->github->gists();
			var_dump($result);*/
			

			//其他功能请根据官方文档自行添加
			//示例：获取登录用户的issues
			//$result=$this->github->api('repos/zhaogang999/shop/issues/11', array(), 'GET');
			//var_dump($result);
			//die;
			/*$result=$this->github->api('rate_limit', array(), 'GET');
			var_dump($result);*/

			//获取issues列表
			/*$result = $this->github->api('repos/zhaogang999/shop/issues');
			var_dump($result);die;*/

			$data = array(
				'title'=>'# asssaa',
				'body'=>'![Uploading /data/upload/1/201704/0917302801486tq7.png…]()'
				);
			//$data = array();
			$result=$this->github->api('repos/zhaogang999/shop/issues', $data, 'POST');
			var_dump($result);die;


		}else{
			//生成登录链接
			//$github=new githubPHP($github_k, $github_s);
			$login_url=$this->github->login_url($this->config->github->callback_url,'user,repo,public_repo,repo_deployment,repo:status,delete_repo,admin:repo_hook');
			//var_dump($login_url);die;
			echo '<a href="'.$login_url.'">点击进入授权页面</a>';
			//https://github.com/login/oauth/
		}
	}

	public function callback()
	{
		//授权回调页面，即配置文件中的$callback_url
		//session_start(); //此示例中要使用session
		//require_once('config.php');
		//require_once('github.php');

		if(isset($_GET['code']) && $_GET['code']!=''){
			//$github=new githubPHP($github_k, $github_s);
			$result=$this->github->access_token($this->config->github->callback_url, $_GET['code']);
			var_dump($result);
		}
		if(isset($result['access_token']) && $result['access_token']!=''){
			echo '授权完成，请记录<br/>access token：<input size="50" value="',$result['access_token'],'">';

			//保存登录信息，此示例中使用session保存
			//$_SESSION['github_t']=$result['access_token']; //access token
			//$this->startSession();
			$this->session->set('github_t', $result['access_token']);
		}else{
			echo '授权失败';
		}
		$url = $this->createLink('github', 'userInfo');
		echo '<br/><a href="' . $url . '">返回</a>';
	} 
	public function issues()
	{
		//echo "sldfsflsfdddd";
		$issue = $_POST['payload'];
		var_dump(json_decode($issue));
		//file_put_contents('./aaa.text', $_SERVER);
		if ($issue['payload']) 
		{
			file_put_contents('./aaa.text', $issue);
		}
		else
		{
			$data = array(
				'errorCode' => '1',
				'time' 		=> time(),
				);
			echo json_encode($data);
		}	
	}

	public function String () 
	{
		echo "sldfsflsfdddd";
	}
}

