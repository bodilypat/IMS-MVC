<?php

    require '../includes/functions.php';

    if(!isset($_GET['id'])){
        header("Location:view_suppliers.php");
        exit();
    }

    $suppliers = getSupplier($_GET['id']);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $name = $_POST['name'];
        $contactInfo = $_POST['contactInfo'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if(updateSupplier($id, $name, $contactInfo, $email, $phone, $address)){
            header("Location:manage_suppliers.php");
            exit();
        } else {
            $error = "Failed to update Supplier.";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Supplier</title>
        <link ref="styelsheet" href="../assets/css/styles.css">
    </head>
    <body>
        <h2>Edit Supplier</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error"; ?>
            <form method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="form-control" value="<?php echo $supplier['name'];?>" required>
                </div>
                <div class="form-group">
                    <label for="ContactInfo">Contact Info</label>
                    <input type="text" name="contactInfo" class="form-control" value="<?php $supplier['contactInfo'];?>" required >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php $supplier['email'];?>" required>
                </div>
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $supplier['phone'];?>" required >
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <textarea name="address" class="form-control" value="<?php echo $supplier['address'];?>"></textarea>
                </div>
            </form>
            <a href="manage_suppliers.php">Back to suppier List</a>
    </body>
</html>

