<?php
	$method = $_SERVER['REQUEST_METHOD'];
    echo $method;
    echo empty($_GET["signature"]);
    $params = build_query($_GET);
    echo TARGET_URL . "?" . $params;
    echo $_GET["echostr"];

    if($method == 'POST' && !is_null($_GET["signature"])){
        $params = build_query($_GET);
        $url = TARGET_URL . "?" . $params;
        return $_GET["echostr"];
        //return http_query_post($url, '');
    }
?>
