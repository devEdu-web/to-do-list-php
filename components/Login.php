<?php

require(__DIR__ . '/User.php');
require(__DIR__ . '/Auth.php');

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST') {
  $rawData = file_get_contents("php://input");
  $postBody = json_decode($rawData, true);

  $user = User::getUser($postBody['email']);

  if(!$user) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode([
      'error' => true,
      'message' => 'Inexisting user.',
      'user' => null
    ]);
  } else {

    $hashedPassword = $user['password'];
    $inputPassword = $postBody['password'];

    if(password_verify($inputPassword, $hashedPassword)) {
      
      $jwt = signJwt($user);
      setAuthorizationCookies($jwt, $user['id']);
      
      http_response_code(302);

    } else {
      http_response_code(400);
      header('Content-Type: application/json');
      echo json_encode([
        'error' => true,
        'message' => 'Invalid user or password.',
        'user' => null
      ]);
    }
  }


}