<?php
/**
 * wechat php test
 */

//define your token
define("TOKEN", "bargetor_chestnut");
define("TARGET_URL", "http://127.0.0.1:8000/api/");

chectnut_api_proxy();


function chectnut_api_proxy(){
    if (isset($_GET['echostr'])) {
        $params = build_query($_GET);
        echo http_query_get(TARGET_URL, $params);
    }else{
        responseMsg();
        // $post_data = "HTTP_RAW_POST_DATA=" . $GLOBALS["HTTP_RAW_POST_DATA"];
        // return http_query_post(TARGET_URL, $post_data);
    }
}

 public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            if($keyword == "?" || $keyword == "？")
            {
                $msgType = "text";
                $contentStr = date("Y-m-d H:i:s",time());
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
        }else{
            echo "";
            exit;
        }
    }


function http_query_get($url, $params){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;

	//return file_get_contents($url . '?' . $params);
}

function http_query_post($url, $params){
	$curlObj = curl_init();
	$options = array(
	CURLOPT_URL => $url,
	CURLOPT_POST => TRUE, //使用post提交
	CURLOPT_RETURNTRANSFER => TRUE, //接收服务端范围的html代码而不是直接浏览器输出
	CURLOPT_TIMEOUT => 4,
	CURLOPT_POSTFIELDS => $params, //post的数据
	);
	curl_setopt_array($curlObj, $options);
	$response = curl_exec($curlObj);
	curl_close($curlObj);
	return $response;
}


?>
