<?php

require(__DIR__ . '/../config/database.php');

class User {
  public $name;
  public $email;
  private $password;

  public function __construct($name, $email, $password)
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = password_hash($password, PASSWORD_BCRYPT);
  }

  public function register()
  {

    try {
      global $pdo;
      $stmt = $pdo->prepare("INSERT INTO users (name, email, password) values (:name, :email, :password)");
  
      $stmt->bindValue(':name', $this->name);
      $stmt->bindValue(':email', $this->email);
      $stmt->bindValue(':password', $this->password);
  
      $stmt->execute();

      $addedUser = $this::getUser($this->email);

      http_response_code(201);
      header('Content-Type: application/json');
      header('Location: /login.php');
      echo json_encode([
        'error' => false,
        'message' => 'New user registered.',
        'user' => $addedUser
      ]);

    } catch (PDOException $error) {
      if ($error->getCode() == 23000) {
        // send http response
        
        http_response_code(409);
        header('Content-Type: application/json');
        echo json_encode([
          'error' => true,
          'message' => 'Email already in use.',
        ]);

      } else {
        http_response_code(500);
        header('Content-Tyoe: application/json');
        echo json_encode([
          'error' => true,
          'message' => 'Error on the server.'
        ]);
      }
    }

  }

  static function getUser($email) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    return $userData;

  }

}