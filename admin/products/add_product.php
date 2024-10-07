<?php

    include('../includes/dbconnect.php');
    include('../includes/functions.php');

    $suppliers = getSuppliers();
    $categories = getCategories();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];
        $supplier_id = $_POST['supplier_id'];

        if(addProduct($name, $description, $price, $stock, $category_id, $supplier_id)){
            header("Location: view_products.php");
            exit();
        } else {
            $error = "Failed to add product";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Product</title>
    </head>
    <h2>Add Product</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" name="form-product">
        <div class="form-group">
            <label for="Name">Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="Product Name" required>
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="description" class="form-control" placeholder="Desccription" required>
        </div>
        <div class="form-group">
            <label for="Price">Price</label>
            <input type="number" name="price" class="form-control" placeholder="Price" require>
        </div>
        <div class="form-group">
            <label for="Stock">Quantity</label>
            <input type="number" name="stock" class="form-control" placeholder="Quantity" required>
        </div>
        <div class="form-group">
            <label for="Category">Category Name</label>
            <select name="category_id" class="form-control">
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['id'];?>"><?php echo $category['category_name'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="Supplier">Supplier</label>
            <select name="supplier_id" class="form-control">
                <?php foreach($suppliers as $supplier): ?>
                    <option value="<?php echo $supplier['id'];?>"><?php echo $supplier['supplier_name'];?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">Add Product</buttom>
    </form>
</html>