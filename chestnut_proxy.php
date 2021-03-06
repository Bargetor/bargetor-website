<?php
/**
 * wechat php test
 */

//define your token
define("TOKEN", "bargetor_chestnut");
define("TARGET_URL", "http://chestnut.bargetor.com:8000/api/");

echo chectnut_api_proxy();


function chectnut_api_proxy(){
    if (isset($_GET['echostr'])){
        $params = http_build_query($_GET);
        return http_query_get(TARGET_URL, $params);
    }else{
        $post_data = $GLOBALS["HTTP_RAW_POST_DATA"];
        $url = TARGET_URL . '?' . http_build_query($_GET);
        return http_query_post($url, $post_data);
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

function http_query_post($url, $params, $content_type = 'text/xml'){
    $curlObj = curl_init();
    $options = array(
    CURLOPT_URL => $url,
    CURLOPT_POST => TRUE, //使用post提交
    CURLOPT_RETURNTRANSFER => TRUE, //接收服务端范围的html代码而不是直接浏览器输出
    CURLOPT_TIMEOUT => 4,
    CURLOPT_POSTFIELDS => $params, //post的数据
    CURLINFO_CONTENT_TYPE => $content_type
    );
    curl_setopt_array($curlObj, $options);
    $response = curl_exec($curlObj);
    curl_close($curlObj);
    return $response;
}

?>
