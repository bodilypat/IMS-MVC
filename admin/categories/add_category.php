<?php

    require '../includes/functions.php';

    $categories = getCategories();

    if($_SERVER['REQUEST_METHOD'] ==='POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];

        if(addCategory($name, $description)){
            header("Location:view_categories.php");
            exit();
        } else {
            $error = "Failed to add categories.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Category</title>
    </head>
    <body>
        <h2>Add Category</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post" name="form-category">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="type" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="description" class="form-control" ></textarea>
            </div>
            <button type="submit">Add Category</button>
        </form>
        <a href="view_categories.php">View Categories</a>
    </body>
</html>