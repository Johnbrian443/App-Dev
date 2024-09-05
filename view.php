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
        require_once 'database.php';

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $stmt = $conn->prepare('SELECT name, description, price, quantity FROM products WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $prodName = $product['name'];
            $prodDesc = $product['description'];
            $prodPrice = $product['price'];
            $prodQty = $product['quantity'];
        } else {
            echo 'Product not found.';
        }

    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="">Name</label>
        <input type="text" name="prodName" value="<?php echo $prodName; ?>" disabled>

        <label for="">Description</label>
        <input type="text" name="prodDesc" value="<?php echo $prodDesc; ?>" disabled>
        
        <label for="">Price</label>
        <input type="number" name="prodPrice" value="<?php echo $prodPrice; ?>" disabled>

        <label for="">Quantity</label>
        <input type="number" name="prodQty" value="<?php echo $prodQty; ?>" disabled>
    </form>
</body>
</html>