<?php

require(__DIR__ . '/../config/database.php');

$title = $_POST['title'];
$priority = $_POST['priority'];
$id = $_POST['id'];


if($title && $id && $priority) {
  $stmt = $pdo->prepare('UPDATE tasks SET title = :title, priority = :priority where id = :id');
  $stmt->bindValue(':title', $title);
  $stmt->bindValue(':priority', $priority);
  $stmt->bindValue(':id', $id);
  $stmt->execute();

  header('Location: /index.php');
  exit;

} else {
  header('Location: /index.php');
}
