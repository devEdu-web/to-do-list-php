<?php

require(__DIR__ . '/User.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {

  $rawData = file_get_contents("php://input");
  $postBody = json_decode($rawData, true);

  $user = new User($postBody['name'], $postBody['email'], $postBody['password']);
  $user->register();

} else {
  http_response_code(400);
  header('Content-Type: application/json');
  echo json_encode([
    'error' => true,
    'message' => 'Method must be POST'
  ]);
}