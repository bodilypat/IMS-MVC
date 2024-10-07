<?php

    include('../includes/functions.php');

    if(!isset($_GET['id'])) {
        header("Location: view_products.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD']){
        $product_name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $supplier_id = $_POST['supplier_id'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        if(updateProduct($product_id,$category_id, $supplier_id, $name, $description, $quantity, $price)){
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
                <label for="ProductName">Product Name</label>
                <input type="text" name="name" class="form-control"  value="<?php echo $product['name'];?>" required>
            </div>

            <div class="form-group">
                <label for="Category">Category</label>
                <select name="category_id" required >
                    <option value="">Select Category</option>
                    <?php
                        //Fetch all categories
                        $categories = getCategories();
                        foreach($categories as $category){
                            $selected = ($category['id'] == $product['product_id']) ? 'selected' : '';
                            echo "<option value=\"{category['id']}\" $selected>{$category['name']}</option>";
                        }
                        ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Supplier">Suplier</label>
                <select name="supplier_id" required>
                    <option value="">Select Supplier</option>
                    <?php 
                        //Fetch all supplier
                        $suppliers = getSuppliers();
                        foreach($suppliers as $supplier){
                            $selected = ($customer['id'] == $sale['customer_id']) ? 'selected' : '';
                            echo "<option value=\"{$customer['id']}\" $selected> {$customer['name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" name="description" class="form-group" value="<?php echo $product['description'];?>" requried>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" name="stock" class="form-control" value="<?php echo $product['stock'];?>" required >
            </div>

            <div class="form-group">
                <label for="Price">Price</label>
                <input type="text" name="price" class="form-control" value="<?phpe echo $product['price'];?>" required>
            </div>

            <button type="submit" >Update product</button>
        </form>
        <a href="view_products.php">Cancel</a>
    </body>
</html>

