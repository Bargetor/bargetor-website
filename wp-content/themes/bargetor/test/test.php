<?php
	$method = $_SERVER['REQUEST_METHOD'];
    echo $method;
    echo '</br>'
    $params = build_query($_GET);
    echo $params;
    echo '</br>';

    echo $_POST;
?>
