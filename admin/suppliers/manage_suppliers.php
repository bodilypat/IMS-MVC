<?php 
    
    require '../includes/dbconnect.php';

   $qSuppier = "SELECT * FROM suppliers ";
   $stmt = $db_con->prepare($qSupplier);
   $stmt->execute();
   $suppliers = $stmt->fetch(PDO::FETCH_ASSOC);

   /* Optional: you can handle errors if any (use try-cath for better error handing */
   if (!suppliers {
        /* Handle error or return empty array */
       $suppilers = [];
       }
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
        <a href="create_supplier.php">Add Supplier</a>
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
                         <a href="update_supplier.php?id=<?php echo $supplier['id']; ?>">Update</a>
                         <a href="delete_supplier.php?id=<?php echo $supplier['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
    </body>
</html>
