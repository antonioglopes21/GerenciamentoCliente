<?php

$url = 'http://localhost/CustomerManagerApi/public_html/api';

$class = '/cliente';
$param = '';

$response = file_get_contents($url . $class . $param);