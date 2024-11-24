<?php

require(__DIR__ . '/../config/database.php');

$userId = $_COOKIE['userId'];
$taskTitle = $_POST['task'];
$priority = $_POST['priority'];


try {
  $stmt = $pdo->prepare('INSERT INTO tasks (title, priority, user_id) VALUES (:title, :priority, :userId)');
  
  $stmt->bindValue(':title', $taskTitle);
  $stmt->bindValue(':priority', $priority);
  $stmt->bindValue(':userId', $userId);

  $stmt->execute();
  header('location: /index.php');

} catch(PDOException $e) {
  echo $e->getMessage();
}

