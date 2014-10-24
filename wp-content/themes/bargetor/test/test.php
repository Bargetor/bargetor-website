<?php
	$method = $_SERVER['REQUEST_METHOD'];
    echo $method;
    echo empty($_GET["signature"]);
    $params = build_query($_GET);
    echo TARGET_URL . "?" . $params;
    echo $_GET["echostr"];

    if($method == 'POST' && !empty($_GET["signature"])){
        echo $_GET["nonce"];
    }
?>
