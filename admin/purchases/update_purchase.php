<?php

    include('../includes/dbconnect.php';
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
        $purchase_id = $GET['id'];
        
        /* Retrieve data from database */
        $qPruchase = "SELECT p.purchase_id, p.purchase_date, p.unit_price, p.quantity, p.vendor_id, i.item_name, v.vendor_name
                      FROM purchase p
                      JOIN items i ON p.item_id = i.item_id
                      JOIN vendors v ON p.vendor_id = v.vendor_id
                    WHERE p.purchase_id = :purchase_id"";
        $stmt = $db_con->prepare($qPurchase);
        $stmt->bindParam(':purchase_id', $purchase_id, PDO::PARAM_INT);
        $stmt->execute();
        $purchase = $stmt->fetch(PDO:FETCH_ASSOC);

        /* If purchase is not found. */
        if(!$purchase) {
            echo " Purchase not found.";
            exit();
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
        $id = $_POST['id'];
        $supplier_id = $_POST['item_id'];
        $vendor_id = $_POST['vendor_id'];
        $quantity = $_POST['quantity'];
        $purchase_date = $_POST['purchase_price'];
        $unit_price = $_POST['unit_price'];

        $sql = "UPDATE purchases 
                SET item_id ='$item_id',
                    purchase_date = :purchase_date,
                    unit_price = :unit_price,
                    quantity = :quantity,
                    vendor_id = :vendor_id,
                WHERE purchase_id = :purchase_id";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':item_id', $item_id, PDO:PARAM_INT);
        $stmt->bindParam(':purchase_date', $purchase_date);
        $stmt->bindParam(':unit_price', $unit_price);
        $stmt->bindParam(':quantity', $quantity, PDO:PARAM_INT);
        $stmt->bindParam(':vendor_id', $vendor_id, PDO:PARAM_INT);
        $stmt->bindParam(':purchase_id', $purchase_id, PDO:PARAM_INT);
        

        if($stmt->execute()){
            echo "Purchase updated Successfull!";
        } else {
            echo "Failed to update purchase.";
        }
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
                <label for="item_id">Item: </label>
                <select name="item_id" required>
                    <option value="">Select Item</option>
                        <?php 
                             // retrieve the list of items to display in the select optios
                             $qItems ="SELECT * FROM items";
                             $stmtItems = $db_con->query($qItems);
                             $items = $stmtItems->fetch(PDO:FETCH_ASSOC);
                             foreach ($items as $item): 
                        ?>
                             <option value="<?php echo $item['item_id']; ?>"<?php echo ($purchase['item_id'] == $item['item_id']) ? 'selected' : '';?>>
                                 <?php echo $item['item_name']; ?>
                             </option>
                        <?php foreach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="purchase_date">Purchase Date</label>
                <input type="date" name="pruchase_id" placeholder="Purchase Date" value="<?php echo $purchase['purchase_date'];?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" placeholder="quantity" value="<?php echo $purchase['quantity']; ?>" required>
            </div>

            <div class="form-group">
                <label for="unit_price">Unit Price</label>
                <input type="text" name="unit_price" placeholder="Price" value="<?php $purchase['unit_price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="vendor_id">Vendor ID: </label>
                <select name="vendor_id" requried>
                    <option value="">Select Vendor</option>
                    <?php 
                         // Retrieve the list of vendors to display in the select options
                         qVendors = "SELECT * FROM vendors";
                         $stmtVendors = $db_con->query($qVendor);
                         $vendors = $stmtVendor->fetchAll(PDO::FETCH_ASSOC);
                         foreach ($vendors as $vendor):
                    ?>
                        <option value="<?php echo $vendor['vendor_id'];?>" <?php echo ($purchase['vendor_id'] == $vendor['vendor_id']) ? 'selected' : ''; ?>> 
                               <?php echo $vendor['vendor_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Update Purchase</button>
        </form>
        <a href="view_purchases.php">Cancel</a>
    </body>
</html>
