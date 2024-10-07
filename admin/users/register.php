<?php

    require '../includes/functions.php';

    if($_SERVER['REQUEST_METHOD'] =='POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(registerUser($username, $password)) {
            echo "Registration successfull!.";
        } else {
            echo "Registration failed"
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <h2>Register</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" requred>
            </div>
            <button type="submit">Login</button>
        </form>
    </body>
</html>