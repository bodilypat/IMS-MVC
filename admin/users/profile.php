<?php

    require '../includes/functions.php';

    session_start();
    if(!isLoggedIn()) {
        header("Location:login.php");
        exit();
    }

    $user = getUser();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Profile</title>
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <h2>Welcome, <?php echo $user['username']; ?>!</h2>
        <p><strong>User ID:</strong><?php echo $user['id']; ?></p>
        <a href="logout.php">Logout</a>
        <?php if ($user['is_admin']); ?>
            <a href="admin.php">Admin Dashboard</a>
        <?php endif; ?>
    </body>
</html>