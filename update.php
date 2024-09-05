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

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $newprodName = $_POST['prodName'];
            $newprodDesc = $_POST['prodDesc'];
            $newprodPrice = $_POST['prodPrice'];
            $newprodQty = $_POST['prodQty'];

            $stmt = $conn->prepare('UPDATE products SET name = :name, description = :description, price = :price, quantity = :quantity, updatedAt = current_timestamp WHERE id = :id');
            $stmt->bindParam(':name', $newprodName);
            $stmt->bindParam(':description', $newprodDesc);
            $stmt->bindParam(':price', $newprodPrice);
            $stmt->bindParam(':quantity', $newprodQty);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if($stmt->execute()){
                header("Location: index.php");
                exit();
            } else {
                    echo 'Failed to update product.';
                }
            }
    ?>

    <form action="<?php $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="post">
        <label for="">Name</label>
        <input type="text" name="prodName" value="<?php echo $prodName; ?>">

        <label for="">Description</label>
        <input type="text" name="prodDesc" value="<?php echo $prodDesc; ?>">
        
        <label for="">Price</label>
        <input type="number" name="prodPrice" value="<?php echo $prodPrice; ?>">

        <label for="">Quantity</label>
        <input type="number" name="prodQty" value="<?php echo $prodQty; ?>">

        <input type="submit" value="Update">
    </form>
</body>
</html>