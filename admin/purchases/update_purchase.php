<?php

    include('../includes/dbconnect.php';
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
        $purchase_id = $GET['id'];
        
        /* Retrieve data from database */
        $qPruchase = "SELECT p.purchase_id, p.purchase_date, p.unit_price, p.quantity, p.vendor_id, i.item_name, v.vendor_name
                  FROM purchase p
                  JOIN items i ON p.item_id = i.item_id
                  JOIN vendors v ON p.vendor_id = v.vendor_id";
        $stmt = $db_con->query($qPurchase);
        $purchases = $stmt->fetchAll();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $supplier_id = $_POST['supplier_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $purchase_date = $_POST['purchase_price'];

        $sql = "UPDATE purchases 
                SET item_id ='$item_id',
                    purchase_date = '$purchase_date',
                    unit_price = '$unit_price',
                    quantity = '$quantity',
                    vendor_id = '$vendor_id'
                WHERE purchase_id = $purchase_id";
        

        if($db_con->query($sql) === TRUE ){
            echo "Purchase updated Successfull!";
        } else {
            echo "Failed to update purchase.";
        }
        $db_con->close();
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
                <select name="item_id" required>
                    <option value="">Item ID</option>
                    <?php foreach($purchases as $purchase): ?> 
                         <option value="<?php echo $purchase['item_id'];?>"><?php $purchase['item_name'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="purchase-date">Purchase Date</label>
                <input type="date" name="pruchase_id" placeholder="Purchase Date" value="<?php echo $purchase['purchase_date'];?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" placeholder="quantity" value="<?php echo $purchase['quantity']; ?>" required>
            </div>

            <div class="form-group">
                <label for="unit-price">Unit Price</label>
                <input type="text" name="unit_price" placeholder="Price" value="<?php $purchase['unit_price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="vendor-id">Vendor ID: </label>
                <select name="vendor_id" requried>
                    <?php foreach($purchases as $purchase): ?>
                        <option value="<?php echo $purchase['vendor_id'];?>"><?php $purchase['vendor_name'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Update Purchase</button>
        </form>
        <a href="view_purchases.php">Cancel</a>
    </body>
</html>
