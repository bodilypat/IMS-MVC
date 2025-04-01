<?php

    require '../includes/functions.php';

    /* Ensure the user is logged in and has 'admin' role */
    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header("Location: index.php");
        exit();
    }

    /* Get the supplier's information when 'GET' method is used and 'id' is set */
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
        $supplier_id = $_GET['id'];
        
        /* Prepared statement to fetch the supplier */
        $qSupplier = "SELECT * FROM supplier WHERE supplier_id = ? ";
        
        if ($stmt = $db_con->prepare($sql)) {
            $stmt->bind_param("i", $supplier_id);  // 'i' indicates on integer parameter
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1 ) {
                $supplier = $result->fetch_assoc();
            } else {
                echo "Supplier not found.";
                exit();
            } 
            $stmt->close();
        }
    }
    
    /* Update the supplier when the form is submitted with 'POST' method */
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supplier_id'])) {
        
            /* Collect from data */
            $supplier_id = $_POST['supplier_id'];
            $name = $_POST['supplier_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city  = $_POST['city'];
            $state = $_POST['state'];
            $zipcode = $_POST['zipcode'];

            /* Prepare the SQL query to update the supplier details */
            $sql = "UPDATE suppliers SET supplier_name = ?, email = ?, phone = ?, address = ?, city = ?, state = ?, zipcode = ?'
                    WHERE supplier_id = ?";

        if ($stmt = $db_con->prepare($sql)) {
            $stmt->bind_param("sssssssi", $supplier_name, $email, $phone, $address, $city, $state, $zipcode, $supplier_id);

            if ($stmt->execute()) {
                 
                /* Redirect to the manage suppliers page after successful update */
                header("Location: manage_suppliers.php");
                exit();
            } else {
                $error = "Failed to update supplier.";
            }
                $stmt->close();
            } else {
                $error ="Database query failed: " . $db_con->error;
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
            <form method="post" action="edit_supplier.php?id=<?php echo $supplier['supplier_id']; ?>" >
                <input type="hidden" name="supplier_id" value="<?php echo $supplier['supplier_id']; ?>" >
                <div class="form-group" action="" >
                    <label for="name">Name</label>
                    <input type="text" name="supplier_name" value="form-control" value="<?php echo $supplier['supplier_name'];?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $supplier['email'];?>" required>
                </div>
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $supplier['phone'];?>" required >
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <textarea name="address" class="form-control" value="<?php echo $supplier['address'];?>"></textarea>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" value="<?php echo $supplier['city']; ?>" >
                </div>
                <div class="form-group">
                    <label for="state">State:</label>
                    <input type="text" name="state" class="form-control" value="<?php echo $supplier['state']; ?>" >
                </div>
                <div class="form-group">
                    <label for="zipcode">Zipcode: </label>
                    <input type="text" name="zipcode" class="form-control" value="<?php echo $supplier['zipcode']; ?>">
                </div>
            </form>
            <a href="manage_suppliers.php">Back to suppier List</a>
    </body>
</html>

