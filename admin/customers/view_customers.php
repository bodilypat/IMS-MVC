<?php
    require '../incldues/dbconnect.php';
    $qCust = "SELECT * FROM customers;
    $result = $db_con->query($qCust);
    $customers = $db_con->fetch_assoc($result)
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
                  <th>Mobile</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>City></th>
                  <th>State</th>
                  <th>Zipcode</th>
                  <th>Status</th>
                  <th>Create On</th>
            </tr>
            <?php foreach($customers as $customer): ?>
            <tr>
                  <td><?php $customer['id'];?></td>
                  <td><?php $customer['name'];?></td>
                  <td><?php $customer['email'];?></td>
                  <td><?php $customer['mobile'];?></td>
                  <td><?php $customer['phone'];?></td>
                  <td><?php $customer['address'];?></td>
                  <td><?php $custoemr['city'];?></td>
                  <td><?php $customer['state'];?></td>
                  <td><?php $customer['zipcode'];?></td>
                  <td><?php $customer['createdOn'];?</td>
                  <td><a href='update_customer.php?id=" . $customer['customer_id'] . "'>Edit</a> |
                      <a href='delete_customer.php?id=" . $customer['customer_id'] . "'>Delete</a>
                  </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a href="add_customer.php">Add New Customer</a>
    </body>
</html>
