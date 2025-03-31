<?php

    include('../includes/dbconnect.php');

    if ($_SERVER['REQUEST_METHOD'] =='POST'){
        $item_id = $_POST['item_id'];
        $purchase_date = $_POST['purchase_date'];
        $unit_price = $_POST['unit_price'];
        $quantity = $_POST['quantity'];
        $vendor_id = $_POST['vendor_id'];

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
                <label for="item-id">Item ID</label>
                <select name="item_id" class="form-control" reqired>
                    <?php foreach($items as $item): ?>
                        <option value="<?php echo $item['item_id'];?>"><?php echo $item['item_name'];?></option>
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
                <label for="purchase-date">Purchase Date</label>
                <input type="date" name="purchase_date" class="form-control" placeholder="Quantity" required>
            </div>

            <div class="form-group">
                <label for="unit-price">Unit Price</label>
                <input type="number" id="unit_price" name="unit_price"  class="form-control" placeholder="Unit Price" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quajtname="total_cost" class="form-control" placeholder="Total Cost" required>
            </div>
            <button type="submit">Add Purchase</button>
        </form>
        <a href="manage_suppliers.php">Manage Purchase</button>
    </body>
</html>
