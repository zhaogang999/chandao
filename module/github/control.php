<?php
class github extends control
{
	private $_apiBaseUrl = 'https://api.github.com';

	private $_rateLimit = 0;
	private $_rateLimitRemaining = 0;

	public function getRateLimit()
	{
		return $this->_rateLimit;
	}

	public function getRateLimitRemaining()
	{
		return $this->_rateLimitRemaining;
	}

	/**
	 * @param string $url
	 */
	public function setApiBaseUrl($url)
	{
		$this->_apiBaseUrl = trim($url, '/');
	}

	/**
	 * @return string
	 */
	public function getApiBaseUrl()
	{
		return $this->_apiBaseUrl;
	}

	/**
	 * do a github request and return array
	 *
	 * @param string $url
	 * @param string $requestType GET POST PUT DELETE etc...
	 * @param array $data
	 * @return array
	 */
	protected function requestInternal($url, $requestType='GET', $data=array(), $header=true)
	{
		$c = curl_init();

		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($c, CURLOPT_USERAGENT, "yiiext.components.github-api (v 0.5dev)");
		curl_setopt($c, CURLOPT_TIMEOUT, 30);

		curl_setopt($c, CURLOPT_HEADER, $header); // returns header in output
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);

		//curl_setopt($c, CURLOPT_HTTPHEADER, array());

		switch($requestType)
		{
			default:
			case 'GET':
				curl_setopt($c, CURLOPT_HTTPGET, true);
			break;
			case 'POST':
				curl_setopt($c, CURLOPT_POST, true);
				curl_setopt($c, CURLOPT_POSTFIELDS, $data);
			break;
			case 'PUT':
				curl_setopt($c, CURLOPT_PUT, true);
//				curl_setopt($c, CURLOPT_INFILE, $file=fopen(...));
//				curl_setopt($c, CURLOPT_INFILESIZE, strlen($data));
			break;
		}

		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);

		$response = curl_exec($c);
		curl_close($c);

		return $response;
	}

	/**
	 * do a github request and return array
	 *
	 * @param string $url
	 * @param string $requestType GET POST PUT DELETE etc...
	 * @param array $data
	 * @return array
	 */
	public function request($url, $requestType='GET', $data=array())
	{
		$url = $this->getApiBaseUrl() . $url;

		$response = $this->requestInternal($url, $requestType, $data);

		// parse response
		$header = true;
		$content = array();
		$status = 200;
		foreach(explode("\r\n", $response) as $line)
		{
			if ($line == '') {
				$header = false;
			}
			else if ($header) {
				$line = explode(': ', $line);
				switch($line[0]) {
//					case 'Content-Type': // application/json; charset=utf-8
//					break;
					case 'Status': $status = substr($line[1], 0, 3); break;
					case 'X-RateLimit-Limit': $this->_rateLimit = intval($line[1]); break;
					case 'X-RateLimit-Remaining': $this->_rateLimitRemaining = intval($line[1]); break;
				}
			} else {
				$content[] = $line;
			}
		}

		return array($status, json_decode(implode("\n", $content)));
	}

	public function getFile($user, $repo, $branch, $file)
	{
		$url = 'https://raw.github.com/' . $user . '/' . $repo . '/' . $branch . '/' . ltrim($file, '/');

		return $this->requestInternal($url, 'GET', array(), false);
	}



    function request1($url,$https=true,$method='get',$data=null){
        //1.初始化url
        $ch = curl_init($url);
        //2.设置相关的参数
        //字符串不直接输出,进行一个变量的存储
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HEADER, 1);
        //判断是否为https请求
        if($https === true){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //判断是否为post请求
        if($method == 'post'){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        //3.发送请求
        $str = curl_exec($ch);
        // $hd = curl_getinfo($ch);
        //4.关闭连接
        curl_close($ch);
        //返回请求到的结果
        // return array('str'=>$str,'hd'=>$hd);
        return $str;
    }

    public function userInfo(){
        //接收传入参数city
        $clientID = 'f435de91f066ea383be2';
        $clientSecret = '7870c9ad93a6439517c8352723ef0212473becbe';
        //$clientSecret = '0723f86538e7f55ed31ca74445611b8fe0eec1ed';
        $user = 'zhaogang999';
        //$url = 'https://api.github.com/zen';
        //$content = $this->request($url);
        //var_dump($content);die;
        //1.url地址
        //$url = 'https://github.com/login/oauth/authorize?client_id='. $clientID . '&state="0723f86538e7f55ed31ca74445611b8fe0eec1ed"';
        //$code = $this->request($url);
        //var_dump($code);die;
        //"http://127.0.0.1/?code=947d971e35065f0f16e9&state=%220723f86538e7f55ed31ca74445611b8fe0eec1ed%22";
        //http://127.0.0.1/?code=aca755ec53e894a1958b&state=%220723f86538e7f55ed31ca74445611b8fe0eec1ed%22
        $code = '947d971e35065f0f16e9';
        $state = '%220723f86538e7f55ed31ca74445611b8fe0eec1ed%22';
        $url = "https://github.com/login/oauth/access_token";
        $data = '{"client_id":' . $clientID . ',"client_secret":'. $clientSecret . ',"code":'. $code . '}';
        $accessToten = $this->request($url, 'post', $data);
        var_dump($accessToten);die;
        $accessToken = '0723f86538e7f55ed31ca74445611b8fe0eec1ed';
        //$url = 'https://api.github.com/user?access_token=' . $accessToken;
        $url = 'https://github.com/';

        $content = $this->request($url);
        //$error = curl_errno();
        var_dump($content);die;
        //$url = 'https://api.github.com/users/zhaogang999';
        //2.判断是否为post
        //3.发送请求
        $content = $this->request($url);
        //4.处理返回值
        var_dump($content);die;
    }

}