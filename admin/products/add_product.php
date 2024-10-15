<?php

    include('../includes/functions.php');
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $product_name = $_POST['product_name'];
        $category_id = $_POST['category_id'];
        $supplier_id = $_POST['supplier_id'];
        $description = $_POST['description'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $record_level = $_POST['record_level'];
        
        

        if(addProduct($product_id, $category_id, $supplier_id, $description, $stock, $price, $record_level)){
            
            echo "product add successfully!"
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
            <input type="text" name="product_name" class="form-control" placeholder="Product Name" requried>
        </div>

        <div class="form-group">
            <label for="Category">Category Name</label>
            <select name="category_id" class="form-control">
                <?php 
                    /* Fetch categires */
                    $categories = getCategories();
                    foreach($categories as $category): ?>
                    <option value="<?php echo $category['id'];?>"><?php echo $category['category_name'];?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="Supplier">Supplier</label>
            <select name="supplier_id" class="form-control">
                <?php 
                    /* Fetch suppliers */
                    $suppliers = getSuppliers();
                    foreach($suppliers as $supplier): ?>
                    <option value="<?php echo $supplier['id'];?>"><?php echo $supplier['supplier_name'];?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="description" class="form-control" placeholder="Description" required>
        </div>
        <div class="form-group">
            <label for="Stock">Stock:</label>
            <input type="number" name="stock" class="form-control" placeholder="Stock" required>
        </div>
        
        <div class="form-group">
            <label for="Price">Price</label>
            <input type="number" name="price" class="form-control" placeholder="Price" require>
        </div>
        <div class="form-group">
            <label for="RecordLevel">Record Level</label>
            <input type="number" name="record_level" class="form-control" placeholder="Price" require>
        </div>
        <button type="submit" name="add" value="add product" >Add Product</buttom>
    </form>
</html>