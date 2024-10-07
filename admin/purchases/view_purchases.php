<?php

    include '../includes/functions.php';
    $purchases = getPurchase();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Purchase</title>
        <link rel="styleshee" href="../assets/css/styles.css">
    </head>
    <body>
        <div class="container">
            <h1>Purchase Record</h1>
            <table  class="table table-purchases" >
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($purchases as $purchase) : ?>
                    <tr>
                         <td><?php htmlspecialchars($purchase['id']);?></td>
                         <td><?php htmlspecialchars($purchase['supplier_name']);?></td>
                         <td><?php htmlspecialchars($purchase['product_name']);?></td>
                         <td><?php htmlspecialchars($purchase['quantity']);?></td>
                         <td><?php htmlspecialchars($purchase['purchase_price']);?></td>
                         <td><?php htmlspecialchars(date('y-m-d H:i', strtotime($purchase['purchase_date']))) ?></td>
                         <td>
                             <a href="edit_purchase.php?id=<?php $purchase['id'];?>" class="btn btn-warning btn-sm">Edit</a>
                             <a href="delete_purchase.php?id=<?php $purchase['id'];?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure? ')">Delete</a>
                         </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="add_purchase.php" class="btn btn-primary">Add New Purchase</a>
        </div>
    </body>
</html>