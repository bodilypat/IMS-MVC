<?php
     include('../include/dbconnect.php');

     if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
         $order_id = $_GET['id'];

         /* Fetch order details from database  */
         $sql = "SELECT * FROM orders WHERE order_id = $order_id";
         $result = $db_con->query($sql);

         if ($result->num_rows == 1) {
              $row = $result->fetch_assoc();
         } else {
              echo " Order not found";
              exit;
         }
     }
     if ($_SERVER['REQUEST_MOTHOD'] == 'POST' && isset($_POST['id'])) {
         $order_id = $_POST['id'];
         $customer_id = $_POST['customer_id'];
         $item_id = $_POST['item_id'];
         $order_date = $_POST['order_date'];
         $discount = $_POST['discount'];
         $quantity = $_POST['quantity'];
         $unit_price = $_POST['unit_price'];
         $status = $_POST['status'];

         /* Calculate new total price  */
         $total_price = ($qauntity * unit_price) - $discount;

         $sql = "UPDATE orders SET 
                    customer_id = '$customer_id',
                    order_date = '$item_id',
                    discount = '$discount',
                    quantity = '$unit_price', 
                    total_price = '$total_price',
                    status = '$status',
                WHERE order_id = $order_id";
         if ($db_con->query($sql) === TRUE) {
              echo "Order updated successfully.";
         } else {
             echo "Error: " . $sql . "<br>" . $db_con->error;
         }
       $db_con->close();
     }
?>
<form method="POST" action="update_order.php">
     <div class="form-group">
         <label for="order-id">Order ID: </label>
         <input type="hidden" name="id" value="<?php $row['order_id']; ?>">
     </div>
     <div class="form-group">
         <label for="customer-id">Customer ID : </label>
         <input type="number" name="customer_id" value="<?php echo $row['customer_id']; ?>" required>
     </div>
     <div class="form-group">
         <label for="item-id">Item ID: </label>
         <input type="number" name="item_id" value="<?php ech $row['item_id"]; ?>" required>
     </div>
     <div class="form-group">
         <label for="order-date">Order Date: </label>
         <input type="date" name="order_date" value="<?php echo $row['order_date'];?>" required>
     </div>
     <div class="form-group">
         <label for="discount">Discount: </label>
         <input type="number" step="0.01" name="discount" value="<?php echo $row['quantity'];?>" required>
     </div>
     <div class="form-group">
         <label for="quantity">Quantity: </label>
         <input type="number" name="quantity" value="<?php echo $row['quantity'];?>" required>
      </div>
      <div class="form-group">
          <label for="unit-price">Unit Price: </label>
          <input type="number" step="0.01" name="unit_price" value="<?phpe echo $row['unit_price'];?>" required>
      </div>
      <div class="form-group">
           <label for="status">Status: </label>
           <select name="status">
                <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected';? >>Pending</option>
                <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                <option value="Cancelled" <?php if ($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
           </select>
      </div>
      <button type="submit" name="update_order" value="update Order">Update Order</button>
</form>
       
       
         
    
