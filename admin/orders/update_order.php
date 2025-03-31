<?php
     include('../include/dbconnect.php');

     if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
         $order_id = $_GET['id'];

         /* Fetch order details from database  */
         $qOrder = "SELECT o.order_id, o.order_date, o.discount, o.qunaity, o.unit_price, o.total_price, ,o.status, i.item_name, c.customer_name
                         FROM orders o 
                         JOIN items i ON o.item_id = i.item_id
                         JOIN customers c ON o.customer_id = c.customer_id";
                    WHERE order_id = '$order_id' ";
          
          $stmt = $db_con->query($qOrder);
          $orders = $stmt->fetchAll();
         
     }
     if ($_SERVER['REQUEST_MOTHOD'] == 'POST' && isset($_POST['id'])) {
         $order_id = $_POST['id'];
         $customer_id = $_POST['customer_id'];
         $item_id = $_POST['item_id'];
         $order_date = $_POST['order_date'];
         $discount = $_POST['discount'];
         $quantity = $_POST['quantity'];
         $unit_price = $_POST['unit_price'];
         $total_price = $_POST['total_price'];
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
         <select name="customer_id" required>
              <?php foreach($orders as $order): ?>
                  <option value="<?php echo $order['customer_id'];?>"><?php echo $order['customer_name'];?></option>
               <?php endforeach;  ?>
         </select>
     </div>
     <div class="form-group">
         <label for="item-id">Item ID: </label>
         <select name="item_id" requried>
              <?php foreach($orders as $order): ?>
                  <option value="<?php echo $orders['item_id'];?>"><?php echo $order['item_name'];?></option>
              <?php foreach; ?>
         </select>
          
     </div>
     <div class="form-group">
         <label for="order-date">Order Date: </label>
         <input type="date" name="order_date" value="<?php echo $orders['order_date'];?>" required>
     </div>
     <div class="form-group">
         <label for="discount">Discount: </label>
         <input type="number" step="0.01" name="discount" value="<?php echo $orders['quantity'];?>" required>
     </div>
     <div class="form-group">
         <label for="quantity">Quantity: </label>
         <input type="number" name="quantity" value="<?php echo $orders['quantity'];?>" required>
      </div>
      <div class="form-group">
          <label for="unit-price">Unit Price: </label>
          <input type="number" step="0.01" name="unit_price" value="<?phpe echo $orders['unit_price'];?>" required>
      </div>
      <div class="form-group">
           <label for="status">Status: </label>
           <select name="status">
                <option value="Pending" <?php if ($orders['status'] == 'Pending') echo 'selected';? >>Pending</option>
                <option value="Completed" <?php if ($orders['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                <option value="Cancelled" <?php if ($orders['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
           </select>
      </div>
      <button type="submit" name="update_order" value="update Order">Update Order</button>
</form>
       
       
         
    
