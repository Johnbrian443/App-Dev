<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="create.php">Create product</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once 'database.php';

                $stmt = $conn->prepare('SELECT id, name, description, price, quantity FROM products');
                $stmt->execute();
                
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($products as $prods){
                    echo '
                        <tr>
                            <td>'.$prods['name'].'</td>
                            <td>'.$prods['description'].'</td>
                            <td>'.$prods['price'].'</td>
                            <td>'.$prods['quantity'].'</td>
                            <td>
                                <a href="view.php?id='.$prods['id'].'">View</a>
                                <a href="update.php?id='.$prods['id'].'">Update</a>
                                <a href="delete.php?id='.$prods['id'].'">Delete</a>
                            </td>
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</body>
</html>