<?php

    include('../includes/functions.php');

    if(!isset($_GET['id'])) {
        header("Location: view_products.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD']){
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $supplier_id = $_POST['supplier_id'];
        $description = $_POST['description'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];

        if(updateProduct($id,$product_name, $category_id, $supplier_id, $description, $stock, $price, $record_level)){
            
            echo "Product update successfull! ";
            header("Location:view_products.php");
            exit();
        } else {
            $error ="Failed to update product. ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Product</title>
    </head>
    <body>
        <h2>Edit Product</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error"; ?>
        <form method="post" name="form-product">

            <div class="form-group">
                <input type="hidden" name="id" value="<?php $product['id'];?>" required>
                <label for="ProductName"> Product Name</label>
                <input type="text" name="product_name" value="<?php echo $product['product_name'];?>" required>
            </div>

            <div class="form-group">
                <label for="Category">Category</label>
                <select name="category_id" value="<?php echo $product['category_id'];?>" required >
                    <option value="">Select Category</option>
                    <?php
                        //Fetch all categories
                        $categories = getCategories();
                        foreach($categories as $category): ?>
                            <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Supplier">Suplier</label>
                <select name="supplier_id" value="<?php echo $product['category_id'];?>"  required>
                    <option value="">Select Supplier</option>
                    <?php 
                        //Fetch all supplier
                        $suppliers = getSuppliers();
                        foreach($suppliers as $supplier): ?>
                            <option value="<?php echo $supplier['supplier_id'];?>"><?php echo $supplier['supplier_name'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" name="description" class="form-group" value="<?php echo $product['description'];?>" requried>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" class="form-control" value="<?php echo $product['stock'];?>" required >
            </div>

            <div class="form-group">
                <label for="Price">Price</label>
                <input type="number" name="price" class="form-control" value="<?phpe echo $product['price'];?>" required>
            </div>

            <div class="form-group">
                <label for="recordLavel">Record Level</label>
                <input type="number" name="record_level" class="form-control" value="<?phpe echo $product['price'];?>" required>
            </div>

            <button type="submit" >Update product</button>
        </form>
        <a href="view_products.php">Cancel</a>
    </body>
</html>

