<?php

    require '../includes/functions.php';

    $products = getProducts();
    $suppliers = getSuppliers();

    if($_SERVER['REQUEST_METHOD'] =='POST'){
        $product_id = $_POST['product_id'];
        $supplier_id = $_POST['supplier_id'];
        $quantity = $_POST['quantity'];
        $supplier_date = $_POST['supplier_date'];
        $total_cost = $_POST['total_cost'];

        if(addPurchase($product_id, $supplier_id, $quantity, $supplier_date, $total_cost)) {
            header("Location: magement_suppliers.php");
            exit();
        } else {
            $error = "Failed to add supplier.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Purchase</title>
    </head>
    <body>
        <h2>Add Purchase</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post" name="form-purchase">

            <div class="form-group">
                <label for="ProductName">Product Name</label>
                <select name="product_id" class="form-control" reqired>
                    <?php foreach($products as $product): ?>
                        <option value="<?php echo $product['product_id'];?>"><?php echo $product['product_name'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="SupplierName">Supplier Name</label>
                <seelct name="supplier_id" class="form-control" required>
                    <?php foreach($suppliers as $supplier): ?>
                        <option value="<?php echo $supplier['supplier_id'];?>"><?php echo $supplier['supplier_name'];?></option>
                    <?php endforeach; ?>
                </section>
            </div>

            <div class="form-group">
                <label for="Quantity">Quantity</label>
                <input type="number" name="Quantity" class="form-control" placeholder="Quantity" required>
            </div>

            <div class="form-group">
                <label for="PurchaseDate">Purchase Date</label>
                <input type="date" name="purchase_date" class="form-control" placeholder="Purchase Date" required>
            </div>

            <div class="form-group">
                <label for="TotalCost">Total Cost</label>
                <input type="number" name="total_cost" class="form-control" placeholder="Total Cost" required>
            </div>
            <button type="submit">Add Purchase</button>
        </form>
        <a href="manage_suppliers.php">Manage Purchase</button>
    </body>
</html>