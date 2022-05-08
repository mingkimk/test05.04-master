<?php
$host = "http://127.0.0.1/TEST/interface/";

function getJson($host, $path, $params)
{

    $params = '?' . $params;
    $options = array(
        'http' => array(
            'method' => 'POST'
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($host . $path . $params, false, $context);

    return $result;
}
