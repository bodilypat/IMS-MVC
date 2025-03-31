<?php

    include('../includes/dbconnect.php');

    /* Retrieve data from database */
    $qPurchase = "SELECT p.purchase_id, p.purchase_date, p.unit_price, p.quantity, p.vendor_id, i.item_name, v.vendor_name
                  FROM purchases p 
                  JOIN items i ON p.item_id = i.item_id
                  JOIN vendors v ON p.vendor_id = v.vendor_id";
    $stmt = $db_con->query($qPurchase);
    $purchases = $stmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] =='POST'){
        $item_id = $_POST['item_id'];
        $purchase_date = $_POST['purchase_date'];
        $unit_price = $_POST['unit_price'];
        $quantity = $_POST['quantity'];
        $vendor_id = $_POST['vendor_id'];

        /* Insert the order into the database */
        $sql = "INSERT INTO purchases(item_id, pruchase_date, unit_price, quantity, vendor_id)
                VALUES('$item_id','$purchase_date','$unit_price','$quantity','$vendor_id')";

        if ($db_con->query($sql) === TRUE) {
            echo "Add new order successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $db_con->error";
        }
        $db_con->close();
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
                <label for="item-id">Item Name</label>
                <select name="item_id" class="form-control" reqired>
                    <?php foreach($purchases as $purchase): ?>
                        <option value="<?php echo $purchase['item_id'];?>"><?php echo $purchase['item_name'];?></option>
                    <?php endforeach; ?>
                </select>
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
            <div class="form-group">
                <label for="vendor-id">Vendor Name</label>
                <select id="vendor_id" name="vendor_id" class="form-control" required>
                    <?php foreach($purchases as $purchase) : ?>
                        <option value="<?php $purchase['vendor_id'];?>"><?php $purchase['vendor_name'];?></option>
                </select>
            </div>
            <button type="submit">Add Purchase</button>
        </form>
        <a href="manage_suppliers.php">Manage Purchase</button>
    </body>
</html>
