<?php

    require '../includes/functions.php';

    /* Handle form submission */
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['add'])){
            addCategory($_POST['name'], $_POST['description']);
        } elseif (isset($_POST['update'])){
            updateCategory($_POST['id'], $_POST['name'], $_POST['description']);
        } elseif (isset(_POST['delete'])){
            deleteCategory($_POST['id']);
        }
    }

    $categories = getCategories();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Category Management</title>
    </head>
    <body>
        <h1>Category Management</h1>
        <!-- Create Category form -->
         <form method="POST">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Descritption">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" name="create">Add Category</button>
         </form>
         <!-- Categories List -->
          <h2>Categories</h2>
          <table border="1">
                <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category): ?>
                       <tr>
                            <td><?php echo $category['id']; ?></td>
                            <td><?php echo $category['name'];?></td>
                            <td><?php echo $category['description'];?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $category['id'];?>" >
                                    <button onClick="editCategory(<?php echo $category['id'];?>,
                                            '<?php echo addslashes($category['name']);?>',
                                            '<?php echo addslashes($category['descript']); ?>')">Edit 
                                    </button>
                                </form>
                            </td>
                       </tr>
                    <?php endforeach; ?>
                </tbody>
          </table>
          <script>
                function editCategory(id, name, description){
                    document.querySelector('[name="id"]').value = id;
                    document.querySelector('[name="name"]').value = name;
                    document.quertSelector('[name="description"]').value = desscription;
                    document.querySelector('[name="update"]').style.display = 'inline';
                    document.querySelector('[name="create"]').style.display = 'none';
                }
          </script>
    </body>
</html>