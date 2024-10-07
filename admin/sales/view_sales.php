<?php

    require '../includes/functions.php';
    $sales = gtSales();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Sales<title>
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div class="container">
            <table class="table-sales">
                <thead>
                    <tr>
                         <th>ID</th>
                         <th>Customer</th>
                         <th>Product</th>
                         <th>Quantity</th>
                         <th>Sale Price</th>
                         <th>Sale Date</th>
                         <td>Actions</th>
                    </tr>w
                </thead>
                <tbody>
                    <?php foreach($sales as $sale): ?>
                    <tr>
                         <td><?php htmlspecialchars($sale['id']) ?></td>
                         <td><?php htmlspecialchars($sale['customer_name']) ?></td>
                         <td><?php htmlspecialchars($sale['product_name']) ?></td>
                         <td><?php htmlspecialchars($sale['quantity']) ?></td>
                         <td><?php htmlspecialchars($sale['sale_price']) ?></td>
                         <td><?php htmlspecialchars(date('Y-m-d H:i', strtotime($sale['sale_date']))) ?></td>
                         <td>
                             <a href="edit_sale.php?id=<?php $sale['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                             <a href="delete_sale.php?id=<?php $sale['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ? ')">Delete</a>
                         </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="add_sale.php" class="btn btn-primary">Add new sale</a>
        </div>
    </body>
</html>