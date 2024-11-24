<?php

require(__DIR__ . '/../config/database.php');

$id = $_GET['id'];

echo $id;

if($id) {
  try {
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
  
    header('Location: /index.php');
    exit;
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
}