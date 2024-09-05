<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Go back</a>

    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_once 'database.php';

        $prodName = $_POST['prodName'];
        $prodDesc = $_POST['prodDesc'];
        $prodPrice = $_POST['prodPrice'];
        $prodQty = $_POST['prodQty'];

        $stmt = $conn->prepare('INSERT INTO products (name, description, price, quantity) VALUES (:name, :description, :price, :quantity)');
        $stmt->bindParam(':name', $prodName);
        $stmt->bindParam(':description', $prodDesc);
        $stmt->bindParam(':price', $prodPrice);
        $stmt->bindParam(':quantity', $prodQty);

        if($stmt->execute()){
            header("Location: index.php");
        } else {
            echo 'Failed';
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="">name</label>
        <input type="text" name="prodName">

        <label for="">description</label>
        <input type="text" name="prodDesc">
        
        <label for="">price</label>
        <input type="number" name="prodPrice">

        <label for="">quantity</label>
        <input type="number" name="prodQty">

        <input type="submit" value="Add">
    </form>
</body>
</html>