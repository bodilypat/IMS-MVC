<?php

    include '../includes/functions.php';

    $products = getProducts();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Product</title>
        <link rel="stylesheet" href="../assets/css/styels.css">
    </head>
    <body>
        <div class="container">
            <h1 class="mt-5">Product Record</h1>
            <table class="table table-product">
                <thead>
                      <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Description</th>
                           <th>Price</th>
                           <th>Stock</th>
                           <th>Actions</th>
                      </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product): ?>
                      <tr>
                           <td><?php htmlspecialchars($product['id']);?></td>
                           <td><?php htmlspecialchars($product['name']);?></td>
                           <td><?php htmlspecialchars($product['description']);?></td>
                           <td><?php htmlspecialchars(number_format($product['price'], 2)); ?></td>
                           <td><?php htmlspecialchars($product['stock']); ?></td>
                           <td>
                                <a href="edit_product.php?id=<?php $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_product.php?id=<?php $product['id']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?')">Delete</a> 
                           </td>
                      </tr>
                      <?php endforeach; ?>
                </tbody>
            </table>
            <a href="add_product.php" class="btn btn-primary">Add New Product</a>
        </div>
    </body>
</html>