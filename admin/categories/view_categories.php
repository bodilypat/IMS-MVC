<?php

    require '../includes/functions.php';

    $categories = getCategories();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Categories List</title>
    </head>
    <body>
        <h2>Categories List</h2>
        <table border="1" name="table-categorie">
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
                       <td><?php $category['id'];?></td>
                       <td><?php htmlspecialchars($category['name']);?></td>
                       <td><?php htmlspecialchars($category['description']);?></td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>