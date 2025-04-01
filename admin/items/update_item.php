<?php
     include('../includes/dbconnect.php');

     if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
            $item_id = intval($_GET['id']); /* Ensure item_id is treated as an integer */

            /* Fetch order details from database */
            $sql = "SELECT * FROM items WHERE item_id = $item_id";
            $stmt = $db_con->prepare($sql);
            $stmt->bindparam("i", $item_id);
            $stmt->execute();
            $result = $db_con->get_result();

            if ($result->num_rows == 1 ) {
                  $row = $result->fetch_assoc();
            } else {
                  echo "Order not found";
                  exit;
            }
     }
     if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['item_id'])) {
          
            /* Sanitize and validate user inpts */
            $item_id = intval($_POST['item_id']);
            $item_number = $db_con->real_escape_string(trim($_POST['item_number']));
            $product_id = intval($_POST['product_id']);
            $item_name = $db_con->real_escape_string(trim($_POST['item_name']));
            $discount = floatval($_POST['discount']);
            $stock = intval($_POST['stock']);
            $unit_price = floatval($_POST['unit_price']);
            $status = $db_con->real_escape_string(trim( $_POST['status']);
            $description = $db_con->real_escape_string($_POST['description']);

            /* Handle image URL(file upload) */
            $image_url = ''; // Default value
            if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
                 $target_dir = "../upload/";
                 $target_file = $target_dir . basename($_FIELS['image_url']['name']);
                 $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                 $allowed_type = ['jpg','jpeg','png','gif'];

                 /* Check if the file is an allowed image type */
                 if (in_array(($image_file_type, $allowed_types)) {

                      /* Move the uploaded file */
                      if (move_uploaded_file($_FILES['image_url'], $target_file)) {
                           $image_url = $target_file; // Set image URL to the uploaded file path
                      } else {
                           echo "Error: File upload failed.";
                           exit;
                      }
                 } else {
                      echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
                      exit;
                 }
            }
            /* Prepare SQL statement to update the record */
            $sql = "UPDATE items SET 
                                   
                                    product_id = '$product_id',
                                    item_name = '$item_name',
                                    discount = '$discount',
                                    stock = '$stock',
                                    unit_price = '$unit_price',
                                    image_url = '$image_url',
                                    status = '$status',
                                    description = '$discription'
                  WHERE item_id = $item_id";
          $stmt = $db_con->prepare($sql);
          $stmt->bind_param(
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
         <input type="number" id="item_id" name="item_id" value="<?php echo isset($row['item_id']) ? $row['item_id'] : ''; ?>" required>
     </div>
     <div class="form-group">
         <label for="item-number">Item Number</label>
         <input type="text" id="item_number" name="item_number" value="<?php echo isset($row['item_number']) ? $row['item_number'] : ; ?>" required>
     </div>
     <div class="form-group">
         <label for="product-id">Product ID</label>
         <input type="number" id="product_id" name="product_id" value="<?php echo isset($row['product_id']) ? $row['product_id'] : ?>" required>
     </div>
     <div class="form-group">
         <label for="item-name">Item Name</label>
         <input type="text" id="item_name" name="item_name"  value="<?php echo isset['item_name']) ? $row['item_number'] : ''; ?>" required>
     </div>
     <div class="form-group">
         <label for="discount">Discount: </label>
         <input type="number" id="discount"name="discount" step="0.01" value="<?php echo isset($row['discount']) ? $row['discount'] : ''; ?>" required>
     </div>
     <div class="form-group">
         <label for="stock">Stock: </label>
         <input type="number" id="stock" name="stock" value="<?php echo isset($row['stock']) ? $row['stock'] : ''; ?>" required>
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
              <option value="Pending" <?php if (isset($row['status']) && $row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
              <option calue="Completed" <?php if (isset($row['status']) && $row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
              <option value="Cancelled" <?php if (isset($row['status']) && $row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
         </select>
     </div>
     <div class="form-group">
         <label for="description">Discription:</label>
         <textarea id="description" name="description" value="<?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea>
     </div>
     <button type="submit" name="update_item" value="update_item">Update Item</button>
</form>
