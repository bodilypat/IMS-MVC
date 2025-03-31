<?php

    include('../includes/dbconnect.php');

    /* Fetch items and vendors for the dropdown options */
    $qPurchase = "SELECT p.purchase_id, p.purchase_date, p.unit_price, p.quantity, p.vendor_id, i.item_name, v.vendor_name
                  FROM purchases p 
                  JOIN items i ON p.item_id = i.item_id
                  JOIN vendors v ON p.vendor_id = v.vendor_id";
    $stmt = $pdo->prepare($qPurchase);
    $stmt->execute();

    /* Fetch the results using a more memory-efficient method */
    $purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] =='POST'){
        // Get form data and sanitize input
        $item_id = $_POST['item_id'];
        $purchase_date = $_POST['purchase_date'];
        $unit_price = $_POST['unit_price'];
        $quantity = $_POST['quantity'];
        $vendor_id = $_POST['vendor_id'];

        /* Check for errors in the input data (for example, numeric fields should numbers */
        if (!is_numeric($unit_price) || !is_numeric($quantity)) {
            $error = "Unit Price and Quantity should be numeric values.";
        } else {
               try {
                
                  /* Prepare the SQL insert statement using a prepared to prevent SQL injection */
                  $sql = "INSERT INTO purchases(item_id, pruchase_date, unit_price, quantity, vendor_id)
                          VALUES(:item_id, :purchase_date, :unit_price, :quantity, :vendor_id)";
                  $stmt = $pdo->prepare($sql);
                  $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
                  $stmt->bindParam(':purchase_date', $purchase_date, PDO::PARAM_STR);
                  $stmt->bindParam(':unit_price', $unit_price, PDO::PARAM_STR);
                  $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                  $stmt->bindParam(':vendor_id', $vendor_id, PDO::PARAM_INT);

                  /* Execute the query */
                  if ($stmt->execute()) {
                      header("Location: manage_purchases.php?status=success");
                      exit();
                  } else {
                      $error ="Error: Unable to add the purchase.";
                  }
               } catch (PDOException $e) {
                   $error = "Error: " . $e->getMessage();
               }
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
        <!-- Form to add purchase -->
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
                <input type="date" name="purchase_date" class="form-control" placeholder="Purchase Date" required>
            </div>

            <div class="form-group">
                <label for="unit-price">Unit Price</label>
                <input type="number" id="unit_price" name="unit_price"  class="form-control" placeholder="Unit Price" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" class="form-control" placeholder="Quantity" required>
            </div>
            <div class="form-group">
                <label for="vendor-id">Vendor Name</label>
                <select id="vendor_id" name="vendor_id" class="form-control" required>
                    <?php foreach($purchases as $purchase) : ?>
                        <option value="<?php echo htmlspecialchars($purchase['vendor_id']); ?>"><?php echo htmlspecialchars($purchase['vendor_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Add Purchase</button>
        </form>
        
        <!-- Button to manage purchase  -->
        <a href="manage_suppliers.php">Manage Purchase</button>
    </body>
</html>
