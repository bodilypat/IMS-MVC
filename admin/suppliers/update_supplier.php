<?php

    require '../includes/functions.php';

    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header("Location: index.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
        $supplier_id = $_GET['id'];
        $qSupplier = "SELECT * FROM supplier WHERE customer_id = $customer_id";

        if ($result->num_rows == 1) {
            $suppliers = $result->fetch_assoc();
        } else {
            echo "Supplier not found.";
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ID'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city  = $_POST['city'];
            $state = $_POST['state'];
            $zipcode = $_POST['zipcode'];
        
            $sql = "UPDATE suppliers SET supplier_name = '$supplier_name',
                                         email = '$email',
                                         phone = '$phone',
                                         address = '$address',
                                         city = '$city',
                                         state = '$state',
                                         zipcode = '$zipcode'
                    WHERE supplier_id = '$supplier_id'";
            
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

