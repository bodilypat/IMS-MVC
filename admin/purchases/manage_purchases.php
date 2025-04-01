<?php

    require '../includes/dbconnect.php';

    /* Fetch items and vendors for the dropdown options */
    $qPurchase = " SELECT p.purchase_id, p.purchase_date, p.unit_price, p.quantity, p.vendor_id, item_name, v.vendor_name
                   FROM purchase p
                   JOIN items i ON p.item_id = i.item_id
                   JOIN vendors v ON p.vendor_id = v.vendor_id ";
    $stmt = $pdo->prepare($qPurchase);
    $stmt->execute();
    $purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Manage Purchases</title>
    </head>
    <body>
        <h2>Manage Purchases</h2>
        <!-- Add Purchase -->
         <h3>Add Purchase</h3>
         <form method="post" action="">
             <div class="form-group">
                <label for="ProductName">Product Name: </label>
                <input type="text" name="product_id" class="form-control" required>
             </div>
             <div class="form-group">
                <label for="SupplierName">Supplier Name</label>
                <input type="text" name="supplier_id" class="form-control" required>
             </div>
             <div class="form-group">
                <label for="Quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
             </div>
             <div class="form-group">
                <label for="TotalCost">Total Cost:</label>
                <input type="number" name="total_cost" class="form-control" required>
             </div>
             <div class="form-group">
                <label for="SupplierDate">Supplier Date</label>
                <input type="text" name="supplier_date" class="form-control" required>
             </div>
             <button type="submit" name="add" value="add Purchase"></button>
         </form>

         <!-- Display Existing Purchases -->
          <h3>Existing Purchase</h3>
          <table bordor="1">
                <tr>
                      <th>ID</th>
                      <th>Product ID</th>
                      <th>Supplier ID</th>
                      <th>Purchase Date</th>
                      <th>Quantity</th>
                      <th>Total Cost</th>
                      <th>Actions</th>
                </tr>
                <?php foreach($purchases as $purchase): ?>
                <tr>
                     <td><?php echo $purchase['id'];?></td>
                     <td><?php echo $purchase['product_id'];?></td>
                     <td><?php echo $purchase['supplier_id'];?></td>
                     <td><?php echo $purchase['purchase_date'];?></td>
                     <td><?php echo $purchase['quantity'];?></td>
                     <td><?php echo $purchase['total_cost'];?></td>
                     <td>
                         <!-- Update Purchase link -->
                        <a href="update_purchase.php?id=<?php echo $purchase['id'];?>">Update</a>
                        <!-- Delete Purchase form -->
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $purchase['id'];?>">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                     </td>
                </tr>
                <?php endforeach; ?>
          </table>
          <!-- Display Result Mesage -->
           <?php if(isset($result)) echo "<p>$result</p>"; ?>
    </body>
</html>
