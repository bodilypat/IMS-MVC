<?php

    require '../includes/dbconnect.php';


    if($_SERVER['REQUEST_METHOD'] =='POST'){
        
        /* Sanitize and validate inputs */
        $name = trim($_POST['supplier_name']);
        $email = trim($_POST['email']);
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_EMAIL);
        $address = trim($_POST['address']);
        $city = trim($_POST['city']);
        $state = trim($_POST['state']);
        $zipcode = trim($_POST['zipcode']);

        /* Validate the input field */
        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($city) || empty($state) || empty($zipcode)) {
            $error = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
               try {
                    $sql = "INSERT INTO suppliers(supplier_name, email, phone, address, city, state, zipcode)
                            VALUES(:supplier_name, :email, :phone, :address, :city, :state, :zipcode)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':supplier_name', $supplier_name, PDO::PARAM_INT);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
                    $stmt->bindParam(':state', $state, PDO::PARAM_STR);
                    $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);

                    if($stmt->execute()) {
                        header("Location: manage_suppliers.php?status=success");
                        exit();
                    } else {
                        $error = "Error: Could not insert supplier.";
                    }
                } catch (Exception $e) {
                    $error = "Error: " . $e->getMessage();
                }
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
            <div class="form-group">
                <label for="city">City: </label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="state">State: </label>
                <input type="text" id="state" name="state" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="zipcode">Zipcode: </label>
                <input type="text" id="zipcode" name="zipcode" class="form-control" required>
            </div>
            <button type="submit">Add Supplier</button>
        </form>
        <a href="manage_supplier.php">Back to Supplier List</a>
    </body>
</html>
