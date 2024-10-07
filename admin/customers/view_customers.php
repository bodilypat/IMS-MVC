<?php
    require '../incldues/functions.php';

    $customers = getCustomers();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Customer List</title>
    </head>
    <body>
        <h1>Customer List</h1>
        <table border="1">
            <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
            </tr>
            <?php foreach($customers as $customer): ?>
            <tr>
                  <td><?php $customer['id'];?></td>
                  <td><?php $customer['name'];?></td>
                  <td><?php $customer['email'];?></td>
                  <td><?php $customer['phone'];?></td>
                  <td><?php $customer['address'];?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a href="add_customer.php">Add New Customer</a>
    </body>
</html>