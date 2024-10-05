<?php

    require '../includes/functions.php';

    $suppliers = getSupplier();

    if($_SERVER['REQUEST_METHOD'] =='POST'){
        $name =$_POST['name'];
        $contactInfo = $_POST['contactInfo'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if(addSupplier($name, $contactInfo, $email, $phone, $address)) {
            header("Location:view_suppliers.php");
            exit();
        } else {
            $error = "Failed to add Supplier.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Supplier</title>
    </head>
    <body>
        <h2>Add Supplier</h2>
        <?php if($isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post" name="form-supplier">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ContactInfo">Contact info</label>
                <input type="text" name="contactInfo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <button type="submit">Add Supplier</button>
        </form>
        <a href="manage_supplier.php">Back to Supplier List</a>
    </body>
</html>