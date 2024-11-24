<?php

require(__DIR__ . '/../config/database.php');

$id = $_GET['id'];

echo $id;

if($id) {
  try {
    $stmt = $pdo->prepare('UPDATE tasks SET completed = true where id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
  
    header('Location: /completed.php');
    exit;
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
}