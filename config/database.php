<?php

$env = parse_ini_file(__DIR__ . '/../.env');

$hostname = $env['HOSTNAME'];
$db_name = $env['DB_NAME'];
$db_user = $env['DB_USER'];
$db_password = $env['DB_PASSWORD']; 

try {
  $pdo = new PDO("mysql:host=$hostname;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
  echo $e->getMessage();
}