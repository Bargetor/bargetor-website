<?php
	$method = $_SERVER['REQUEST_METHOD'];
    $params = build_query($_GET);
    $postStr = build_query($_POST);
    $log_str = "the request is " . $method . "the params is ||". $params . "and request body is || " . $postStr);
    error_log('something', 3, "/var/log/web/bargetor-website.log");

?>
