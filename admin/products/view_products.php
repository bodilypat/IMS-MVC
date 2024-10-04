<?php

    require '../includes/functions.php';
    $products = getProducts();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Product Lists</title>
    </head>
    <body>
        <table border="1" name="form-product">
            <tr>
                 <th>ID</th>
                 <th>Product Name</th>
                 <th>Description</th>
                 <th>Quantity</th>
                 <th>Price</th>
                 <th>Actionts</th>
            </tr>
            <tbody>
                <?php foreach($products as $product): ?>
                <tr>
                     <td><?php echo $product['id'];?></td>
                     <td><?php echo htmlspecialchars($product['name']);?></td>
                     <td><?php echo htmlspecialchars($product['desccription']);?></td>
                     <td><?php echo htmlspecialchars($products['quantity']);?></td>
                     <td><?php echo htmlspecialchars($product['price']);?></td>
                     <td>
                        <a href="edit_product.php?id=<?php echo $product['id'];?>">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['id'];?>" onclick="Return confirm('Are you want to delete this product?');">Delete</a>
                     </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_product.php">Add New Product</a>
    </body>
</html>