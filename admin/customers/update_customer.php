<?php

    require '../includes/dbconect.php';

    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header("Location: index.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
        $customer_id = $_GET['id'];

        $qCust = "SELECT * FROM customers WHERE customer_id = $customer_id";
        $result = $db_con->query($qCust);

        if ( $result->num_rows == 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "Customer not found.";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $customer_id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $status = $_POST['status'];

        $sql = "UPDATE customers SET full_name = '$full_name',
                                                 '$email',
                                                 '$mobile',
                                                 '$phone',
                                                 '$city',
                                                 '$state',
                                                 '$zipcode',
                                                 '$status'
              WHERE customer_id = $customer_id";
        if($db_con->query($sql) === TRUE {
            echo "Customer updated successfully. ";
        } else {
            echo "Error: " . $sql . "<br>" . $db_con->error;
        }
        $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Customer</title>
    </head>
    <body>
        <form method="post" name="update_customer.php">
            <div class="form-control">
                <input type="hidden" name="id" value="<?php echo $row['customer_id']); ?>">
            </div>
            <div class="form-control">
                <label for="full-name">Full Name: </label>
                <input type="text" name="name" value="<?php echo $row['full_name']);?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" value="<?php $row['email'];?>" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile: </label>
                <input type="text" id="mobile" name="mobile" value="<?php $row['mobile'];?>" required>
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" id="phone" name="phone" value="<?php $row['phone'];?>" required>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text"  id ="address" name="address" value="<?php echo $row['addresss'];?>" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php $row['city'];?>" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" value="<?php echo $row['state'];?>" required>
            </div>
            <div class="form-group">
                <label for="zipcode">Zipcode</label>
                <input type="text" id="zipcode" name="zipcode" value="<?php echo $row['zipcode'];?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="Active" <?php if($row['status'] == 'Active') echo 'selected'; ?>>Active</option>
                    <option value="Inactive" <?php if($row['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" name="addCust" value="add customer">Update Customer</button>
        </form>
        <a href="view_customers.php">
    </body>
</html>
