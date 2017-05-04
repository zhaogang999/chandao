<?php
class githubModel extends model
{
	//public $api_url='https://api.github.com/';

	//public $client_id = $this->config->github->github_k;
	//public $client_secret = $this->config->github->client_secret;
	//public $callback_url = $this->config->github->callback_url;
	//public function __construct($client_id, $client_secret, $access_token=NULL){
	//$this->client_id=$client_id;
	//$this->client_secret=$client_secret;
	//$this->access_token=$access_token;
	//}
	//生成授权网址
	public function login_url($callback_url, $scope=''){
		$params=array(
			'client_id'=>$this->config->github->github_k,
			'redirect_uri'=>$callback_url,
			'scope'=>$scope
		);
		//var_dump(http_build_query($params));die;
		return 'https://github.com/login/oauth/authorize?'.http_build_query($params);
	}

	//获取access token
	public function access_token($callback_url, $code){
		//var_dump($this->config->github->github_s);die;
		$params=array(
			'code'=>$code,
			'client_id'=>$this->config->github->github_k,
			'client_secret'=>$this->config->github->github_s,
			'redirect_uri'=>$callback_url
		);
		$url='https://github.com/login/oauth/access_token';
		$result_str=$this->http($url, http_build_query($params), 'POST');
		$json_r=array();
		if($result_str!='')parse_str($result_str, $json_r);
		return $json_r;
	}

	public function saveToken($token)
	{
		$this->dao->update(TABLE_USER)->set('token')->eq($token)->where('account')->eq($this->session->user->account)->exec();
	}

	/**
	//使用refresh token获取新的access token，GitHub暂时不支持
	public function access_token_refresh($refresh_token){
	}
	**/

	//获取登录用户信息
	public function me(){
		$params=array();
		return $this->api('user', $params);
	}

	//获取登录用户代码仓库
	public function repos(){
		$params=array();
		return $this->api('user/repos', $params);
	}

	//获取登录用户代码片段
	public function gists(){
		$params=array();
		return $this->api('gists', $params);
	}

	public function rate_limit()
	{
		$params=array();
		return $this->api('rate_limit', $params);
	}

        //$url = 'https://api.github.com/rate_limit';
		//鑾峰緱issues
        //$url = 'https://api.github.com/repos/zhaogang999/shop/issues?state=closed';
		//鑾峰緱鐢ㄦ埛淇℃伅
        //$url = 'https://api.github.com/users/zhaogang999';
		//鑾峰緱浠撳簱鍐呭
        //$url = 'https://api.github.com/repos/zhaogang999/chandao/contents/';
        //$url = 'https://api.github.com/user';
        //3.鍙戦€佽姹?
        //$content = $this->requestInternal($url);
        //4.澶勭悊杩斿洖鍊?
        //var_dump($content);die;


	//调用接口
	/**
	//示例：获取登录用户的issues
	$result=$github->api('user/issues', array(), 'GET');
	**/
	public function api($url, $params=array(), $method='GET'){
		$api_url='https://api.github.com/';
		$url=$api_url.$url;
		//$params['access_token']=$this->access_token;
		//$params['access_token']=$this->session->github_t;
		//var_dump(http_build_query($params));die;
		if($method=='GET'){
			//$params['access_token']=$this->session->github_t;
			$result_str=$this->http($url.'?'.http_build_query($params));
		}else{
			//$headers = array('Authorization' => $this->session->github_t);
			//$result_str=$this->http($url, http_build_query($params), 'POST');
			$result_str=$this->http($url, json_encode($params), 'POST');
		}
		$result = new stdClass();
		if($result_str!='') $result=json_decode($result_str);
		return $result;
	}

	//提交请求
	private function http($url, $postfields='', $method='GET', $headers=array()){
		//var_dump($postfields);DIE;
		$ci=curl_init();

		curl_setopt($ci, CURLOPT_VERBOSE, TRUE);
		curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ci, CURLOPT_TIMEOUT, 30);
		if($method=='POST'){
			curl_setopt($ci, CURLOPT_POST, TRUE);
			if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
		}
		curl_setopt($ci, CURLOPT_USERAGENT, "zhaogang999.github-api");
		//$headers[]='User-Agent: GitHub.PHP(zhaogang999.com)';
		//$headers[]='{'.'"Authorization":  token '.$this->session->github_t.'}';
		curl_setopt($ci, CURLOPT_HTTPHEADER, array(
                 'Authorization: token '. $this->session->user->token,
            ));
		//curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ci, CURLOPT_URL, $url);
		$response=curl_exec($ci);
		curl_close($ci);
		return $response;
	}

	public function linkBug($issue)
	{
		$githubID = $issue->issue->number;
		$bugID = $issue->issue->title;
		$this->dao->update(TABLE_BUG)->SET('github')->eq($githubID)->where('title')->eq($bugID)->limit(1)->exec();
	}

	public function edit($old, $bug, $type)
	{
		$ip = 'http://' . $_SERVER['HTTP_HOST'];//或https
		$upliadPath = 'data/upload/1/';
		$bug->steps = str_replace($upliadPath, $ip . '/' . $upliadPath, $bug->steps);
		//var_dump($this->session->user->account);die;
		$issueID = $old->github;
		
		$state = $bug->status=='active'?'open':'closed';
		$data = array(
			'title'=>$bug->title,
			'body'=>$bug->steps,
			'assignee'=>"zhaogang999",
			'state' => $state,
			'labels'=>["bug"],
		);
		//$data = array();
		$result = $this->api('repos/zhaogang999/shop/issues/'. $issueID, $data, 'POST');
		var_dump($result);die;
	}
}
