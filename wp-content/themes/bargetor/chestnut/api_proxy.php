<?php
/**
 * wechat php test
 */

//define your token
define("TOKEN", "bargetor_chestnut");
define("TARGET_URL", "http://127.0.0.1:8000/api");

echo chectnut_api_proxy();


function chectnut_api_proxy(){
	$method = $_SERVER['REQUEST_METHOD'];
	if($method == 'GET'){
		$params = build_query($_GET);
		return http_query_get(TARGET_URL, $params);
	}
	if($method == 'POST'){
		return http_query_post(TARGET_URL, $_POST);
	}
}


function http_query_get($url, $params){
	return file_get_contents($url . '?' . $params);
}

function http_query_post($url, $params){
	if (is_array($params)) {
		ksort($params);
		$content = http_build_query($params);
		$content_length = strlen($content);
		$options = array(
            'http' => array(
                'method' => 'POST',
                'header' =>
                "Content-type: application/x-www-form-urlencoded\r\n" .
                "Content-length: $content_length\r\n",
                'content' => $content
		)
		);
		return file_get_contents($url, false, stream_context_create($options));
	}
}

?>
