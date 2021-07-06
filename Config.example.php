<?php

$db_host = 'YOUR_HOST';
$db_name = 'YOUR_DB_NAME';
$db_user = 'YOUR_USER';
$db_pass = 'YOUR_PASSWORD';

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

$array = [
    'error' => '',
    'result' => []
];