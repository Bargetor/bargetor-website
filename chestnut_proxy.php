<?php
/**
 * wechat php test
 */

//define your token
define("TOKEN", "bargetor_chestnut");
define("TARGET_URL", "http://127.0.0.1:8000/api/");

echo chectnut_api_proxy();


function chectnut_api_proxy(){
    echo "chestnut";
    if (isset($_GET['echostr'])){
        echo "token";
        $params = build_query($_GET);
        return http_query_get(TARGET_URL, $params);
    }else{
        $post_data = "HTTP_RAW_POST_DATA=" . $GLOBALS["HTTP_RAW_POST_DATA"];
        return http_query_post(TARGET_URL, $post_data);
    }
}



function http_query_get($url, $params){
    echo "get";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
    echo "get done";
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
