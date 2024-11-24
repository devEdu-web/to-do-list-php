<?php

require __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function signJwt($payload) {
  $key = 'ff2d98d76db2f3a4c3e4691f15720c80a7a29df9181d64e9a2cb52052ebc67f4';
  $payload['exp'] = time() + (60 * 60);

  $jwt = JWT::encode($payload, $key, 'HS256', null, null);

  return $jwt;
}

function verifyJwt($jwt) {
  $key = 'ff2d98d76db2f3a4c3e4691f15720c80a7a29df9181d64e9a2cb52052ebc67f4';

  try {
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    return [
      'data' => $decoded,
      'expired' => false,
    ];
  } catch (\Firebase\JWT\ExpiredException $exception) {
     return [ 
      'data' => null,
      'expired' => true,
     ];
  }

}

function setAuthorizationCookies($jwt, $userId) {
  setcookie('jwtToken', $jwt, time() + 3600, '/', '', false, true);
  setcookie('userId', $userId, time() + 3600, '/', '', false, true);
}