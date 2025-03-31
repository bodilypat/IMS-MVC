<?php
     include('../includes/dbconnect.php');

     if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
       $item_id = $_GET['id'];

       /* Fetch order details from database */
       $sql = "SELECT * FROM items WHERE item_id = $item_id";
       $result = $db_con->query($sql0;

       if ($result->num_rows == 1 ) {
             $row = $result->fetch_assoc();
       } else {
             echo "Order not found";
             exit;
         }
     }
     if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['item_id'])) {
           $item_id = $_POST['item_id'];
           $item_number = $_POST['item_number'];
           $product_id = $_POST['product_id'];
           $item_name = $_POST['item_name'];
           $discount = $_POST['discount'];
           $stock = $_POST['stock'];
           $unit_price = $_POST['unit_price'];
           $image_url = $_POST['image_url'];
           $status = $_POST['status'];
           $description = $_POST['description'];

           $sql = "UPDATE items SET item_number = '$item_number',
                                    product_id = '$product_id',
                                    item_name = '$item_name',
                                    discount = '$discount',
                                    stock = '$stock',
                                    unit_price = '$unit_price',
                                    image_url = '$image_url',
                                    status = '$status',
                                    description = '$discription'
                  WHERE item_id = $item_id";
          if ($db_con->query($sql) === TRUE) {
               echo "Order update successfull.";
          } else {
               echo "Error: " . $sql . "<br>" . $db_con->error;
          }
       $db_con->close();
     }
?>
<form method="POST" action="update_order.php">
     <div class="form-group">
         <label for="item-id">Item ID</label>
         <input type="number" id="item_id" name="item_id" required>
     </div>
     <div class="form-group">
         <label for="item-number">Item Number</label>
         <input type="text" id="item_number" name="item_number" required>
     </div>
     <div class="form-group">
         <label for="product-id">Product ID</label>
         <input type="number" id="product_id" name="product_id" required>
     </div>
     <div class="form-group">
         <label for="item-name">Item Name</label>
         <input type="text" id="item_name" name="item_name" required>
     </div>
     <div class="form-group">
         <label for="discount">Discount: </label>
         <input type="number" id="discount"name="discount" step="0.01" required>
     </div>
     <div class="form-group">
         <label for="stock">Stock: </label>
         <input type="number" id="stock" name="stock" required>
     </div>
     <div class="form-group">
         <label for="unit-price">Unit price: </label>
         <input type="number" id="unit_price" name="unit_price" step="0.01" required>
     </div>
     <div class="form-group">
         <label for="image">Image URL: </label>
         <input type="file" id="image_url" name="image_url" required>
     </div>
     <div class="form-group">
         <label for="status">Status: </label>
         <select name="status">
              <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
              <option calue="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
              <option value="Cancelled" <?php if ($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
         </select>
     </div>
     <div class="form-group">
         <label for="description">Discription:</label>
         <textarea id="description" name="description" required>
     </div>
     <button type="submit" name="update_item" value="update_item">Update Item</button>
</form>
