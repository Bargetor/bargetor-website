<?php
    define('LOG_FILE', '/var/log/web/bargetor-website.log')

	$method = $_SERVER['REQUEST_METHOD'];
    echo $method;
    echo '</br>';
    $params = build_query($_GET);
    echo $params;
    echo '</br>';

    echo $_POST;
    echo 'the request is ' . $method . 'the params is ||'. $params . 'and request body is || ' . $_POST, 3
    error_log('the request is ', 3, LOG_FILE);
?>
