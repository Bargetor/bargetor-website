<?php
	$method = $_SERVER['REQUEST_METHOD'];
    echo $method;
    echo '</br>';
    $params = build_query($_GET);
    echo $params;
    echo '</br>';

    echo $_POST;
    $postStr = build_query($_POST);
    $log_str = 'the request is ' . $method . 'the params is ||'. $params . 'and request body is || ' . $postStr);
    error_log($log_str, 3, '/var/log/web/bargetor-website.log');

?>
