<?php 
    
    require '../includes/functions.php';

    $suppliers = getSuppilers();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Supplier Management</title>
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <h1>Supplier List</h1>
        <a href="add_supplier.php">Add Supplier</a>
        <table border="1">
               <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact Info</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
               </tr>
               <?php foreach($suppliers as $supplier): ?>
                <tr>
                    <td><?php htmlspecialchars($supplier['id']);?></td>
                    <td><?php htmlspecialchars($supplier['name']);?></td>
                    <td><?php htmlspecialchars($supplier['contactInfo']);?></td>
                    <td><?php htmlspecialchars($supplier['email']);?></td>
                    <td><?php htmlspecialchars($supplier['phone']);?></td>
                    <td><?php htmlspecialchars($supplier['address']);?></td>
                    <td>
                         <a href="edit_supplier.php?id=<?php $supplier['id']?>">Edit</a>
                         <a href="delete_supplier.php?id=<?php $supplier['id']?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
    </body>
</html>