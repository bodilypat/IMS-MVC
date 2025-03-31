<?php

    include('../includes/dbconnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $supplier_id = $_POST['supplier_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $purchase_date = $_POST['purchase_price'];

        if(updatePurchase($id,$supplier_id, $product_id, $quantity, $purchase_date)){
            echo "Purchase updated Successfull!";
        } else {
            echo "Failed to update purchase.";
        }
    } else {
        $id = $_GET['id'];
        /* Fetch current purchase details */
        $purchase = getPurchase($id);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Purchase</title>
    </head>
    <body>
        <form method="post" name="form-purchase">
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($purchase['id']);?>">
            </div>

            <div class="form-group">
                <label for="supplier">Supplier: </label>
                <select name="supplier_id" required>
                    <option value="">Select Supplier</option>
                    <?php
                        $supplier = getSupplier(); // Assuming you have a function to get suppliers
                        foreach($suppliers as $suppler){
                            $selected = ($supplier['id'] == $purchase['supplier_id']) ? 'selected': '';
                            echo "<option value=\"{$suppler['id']}\" $selected>{$supplier['name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product">Product</label>
                <select name="product_id" required>
                    <option value="">Select Product</option>
                    <?php
                        $products = getProducts(); // Assuming you have a function to get products
                        foreach($products as $product){
                            echo"<option value=\"{$product['id']}\" $selected>{$product['name']}</option>";
                        }
                    ?>
                </section>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" placeholder="quantity" value="<?php htmlspecialchars($purchase['quantity']) ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="purchase_price" placeholder="Purchase Price" value="<?php htmlspecialchars($purchase['purchase_price']) ?>" required>
            </div>
            <button type="submit">Update Purchase</button>
        </form>
        <a href="view_purchases.php">Cancel</a>
    </body>
</html>
