<?php

    include('../includes/functions.php');

    if(!isset($_GET['id'])) {
        header("Location: view_products.php");
        exit();
    }

    // fetch category, suppliers
    $categories = getCategories();
    $suppliers = getSuppliers();

    $products = getProductByJoinID($category_id,$supplier_id);

    if($_SERVER['REQUEST_METHOD']){
        $product_name = $_POST['name'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        if(updateProduct($product_id, $name, $description, $quantity, $price, $category_id, $supplier_id)){
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
                <label for="Description">Description</label>
                <input type="text" name="description" class="form-group" value="<?php echo $product['description'];?>" requried>
            </div>
            <div class="form-group">
                <label for="Quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="<?php echo $product['quantity'];?>" required >
            </div>
            <div class="form-group">
                <label for="Price">Price</label>
                <input type="number" name="price" class="form-control" value="<?phpe echo $product['price'];?>" required>
            </div>
            <div class="form-group">
                <label for="Category">Category</label>
                <select name="category" value="<?php echo $products['category_name'];?>" >
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Supplier">Suplier</label>
                <select name="supplier_id" class="form-control" value="<?php echo $product['category_name'];?>" required>
                    <?php foreach($suppliers as $supplier): ?>
                        <option value="<?php echo $supplier['supplier_id'];?>"><?php echo $supplier['supplier_name'];?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </form>
        <a href="view_products.php">Cancel</a>
    </body>
</html>

