<?php

    require '../includes/functions.php';

    if(!isset($_GET['id'])) {
        header("Location:view_appointments.php");
        exit();
    }

    $category = getCategory($_GET['id']);

    if($_SERVER['REQUEST_METHOD'] =='POST'){
        $name = $_POST['name'];
        $description = $_POST['description'];

        if(updateCategory($category_id, $name, $description)){
            header("Location: view_categories.php");
            exit();
        } else {
            $error = "Failed to update category.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Category</title>
    </head>
    <body>
        <h2>Edit Category</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error"; ?>
        <form method="post" name="form-category">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $category['name'];?>" required>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="descript" value="<?php echo $category['description'];?>" class="form-control" ></textarea>
            </div>
        </form>
        <a href="view_categories.php"></a>
    </body>
</html>
