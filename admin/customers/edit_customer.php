<?php

    require '../includes/functions.php';

    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header("Location: index.php");
        exit();
    }

    $customer_id = $_GET['id'];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if(updateCustomer($id, $name, $email, $phone, $address )) {
            echo "Customer updated successfull!.";
        } else {
            echo "Failed to updated Customer.";
        }
    } else {
        $id = $_GET['ID'];
        /* Fetch current Customer details */
        $customer = getCustomer($id);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Customer</title>
    </head>
    <body>
        <form method="post" name="form-customer">
            <div class="form-control">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['id']); ?>">
            </div>
            <div class="form-control">
                <label for="Name">Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($customer['name']);?>" required>
            </div>
            <div class="form-control">
                <label for="Phone">Phone</label>
                <input type="email" name="name" value="<?php echo htmlspecialchars($customer['phone']);?>" required>
            </div>
            <div class="form-control">
                <label for="Address">Address</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($customer['addresss']);?>" required>
            </div>
            <button type="submit" name="addCust" value="add customer">Add Customer</button>
        </form>
        <a href="view_customers.php">
    </body>
</html>