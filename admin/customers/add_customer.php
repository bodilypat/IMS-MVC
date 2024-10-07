<?php

    require '../includes/functions.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if(addCustomer($name, $email, $phone, $address)) {
            echo "Customer added successfull!";
        } else {
            echo "Failed to add customer.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Customer</title>
        <form method="post" name="form-customer">
            <dic class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control"  placeholder="Customer Name" required>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="email" class="form-group" placeholder="Customer Email" required>
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Contact Number" required>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <textarea name="address" class="form-control" placeholder="Customer Address" required>
            </div>
            <button type="submit" name="addCust" value="add customer" >Add Customer</button>
        </form>
        <a href="view_customers.php"></a>
    </head>
</html>