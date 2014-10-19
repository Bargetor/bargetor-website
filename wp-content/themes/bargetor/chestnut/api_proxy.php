<?php
/**
 * wechat php test
 */

//define your token
define("TOKEN", "bargetor_chestnut");
define("TARGET_URL", "http://localhost:8000/");

echo chectnut_api_proxy();


function chectnut_api_proxy(){
	$methon = $_SERVER['REQUEST_METHOD'];
	if($methon == 'GET'){
		$params = build_query($_GET);
		return http_query_get(TARGET_URL, $params);
	}
	if($methon == 'POST'){
		echo $_POST[HTTP_RAW_POST_DATA];
		//return http_query_post(TARGET_URL, $_POST);
	}
}


function http_query_get($url, $params){
	return file_get_contents($url . '?' . $params);
}

function http_query_post($url, $params){
	$data = http_build_query($params);
	$opts = array (
				'http' => array (
				'method' => 'POST',
				'header'=> "Content-type: application/x-www-form-urlencoded\r\n" .
				"Content-Length: " . strlen($data) . "\r\n",
				'content' => $data
			));
	$context = stream_context_create($opts);
	$result = file_get_contents($url, false, $context);
	return result;
}


?>
