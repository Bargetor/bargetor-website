<?php
    $method = $_SERVER['REQUEST_METHOD'];

    $params = concat_params($_GET);

    $post_str = concat_params($_POST);

    $log_str = "the request is " . $method . " and params is ||". $params . " and request body is || " . $post_str . '\r\n';

    error_log($log_str, 3, '/var/log/web/bargetor-website.log');

    echo "{'message': 'ok'}"


    function concat_params($params) {
        ksort($params);
        $pairs = array();
        foreach($params as $key=>$val) {
            array_push($pairs, $key . '=' . urlencode($val));
        }
        return join('&', $pairs);
    }

?>
