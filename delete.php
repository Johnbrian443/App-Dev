<?php
require_once 'database.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
     $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
     $stmt->bindParam(':id', $id, PDO::PARAM_INT);

     if ($stmt->execute()) {
         header("Location: index.php");
         exit();
     } else {
         echo 'Failed to delete product';
     }
    
} else {
    echo 'Invalid product ID.';
}