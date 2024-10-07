<?php

    include '../includes/functions.php';

    session_start();
    if(!isLoggedIn() || !getUser()['is_admin']){
        header("Location:login.php");
        exit();
    }

    $user = getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="en">
        <title>Amin Dashboard<title>
            <link rel="stylesheer" href="styles.css">
    </head>
    <body>
        <h2>Admin Dashboard</h2>
        <h3>Manage User</h3>
        <table border="1">
                <tr>
                     <th>Id</th>
                     <th>Username</th>
                     <th>Action</th>
                </tr>
                <?php foreach($users as user): ?>
                <tr>
                    <td><?php echo $user['id'];?></td>
                    <td><?php echo $user['username'];?></td>
                    <td>
                         <form method="post" ation="manage_users.php" style="display:inline;">
                               <div class="form-group">
                                    <label for="Username">Username : </label>
                                    <input type="hidden" name="id" value="<?php echo $user['id'];?>">
                                    <input type="submit" name="delete" value="Delete">
                               </div>
                         </form>
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
    </body>
</html>