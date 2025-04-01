<?php

    require '../includes/dbconnect.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $status = $_POST['status'];

        $sql_cust = "INSERT INTO customers(full_name, email,mobile, phone, address, city, state, status)
                     VALUES('$full_name','$email','$mobile','$phone','$address','$city','$state','$status')";
        
        if($db_con->qurey($sql-cust) === TRUE) {
            echo "Customer added successfull!";
        } else {
            echo "Error: " . $sql . "<br>" .$db_con->error;
        }
        $db_con->close();
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
                <label for="mobile">Mobile: </label>label>
                <input type="tel"  id="mobile" name="mobile" placeholder="Customer Mobile" required>
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Contact Phone" required>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <textarea name="address" class="form-control" placeholder="Customer Address" required>
            </div>
            <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id ="name" name="city" placeholder="Customer City" required>
            </div>
            <div class="form-group">
                    <label for="state">State: </label>
                    <input type="text" id="state" name="state" placeholder="Customer State" required>
            </div>
            <div class="form-group">
                    <label for="zipcode">Zipcode: </label>
                    <input type="text" id="zipcode" name="zipcode" placeholder="Customer Zipcode" required>
            </div>
            <div class="status">
                  <label for="status">Status: </label>
                  <select name="status">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                  </select>
                </div>
            <button type="submit" name="addCust" value="add customer" >Add Customer</button>
        </form>
        <a href="view_customers.php"></a>
    </head>
</html>
