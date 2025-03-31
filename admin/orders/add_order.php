<?php
    include('../include/dbconnect.php');

    if ($_SERVER['REQUEST_METHOD'] =='POST') {
        $customer_id = $_POST['customer_id'];
        $item_id = $_POST['item_id'];
        $order_date = $_POST['order_date'];
        $discount = $_POST['discount'];
        $quanity = $_POST['quantity'];
        $unit_price = $_POST['unit_price'];
        $status = $_POST['status'];

        // Caculate total price 
        $total_price = ($quantity * $unit_price) -  $discount;

      /* Insert the order into the database  */
      $sql = "INSERT INTO orders(customer_id, item_id, order_date, discount, quantity, unit_price, total_price, status)
              VALUES('$customer_id','$item_id','$order_date','$discount','$quantity','$unit_price','$total_price','$status')";
      if ($db_con->query($sql) === TRUE) {
          echo "Add new order successfully.";
      } else {
          echo "Error: " . $sql . "<br>" . $db_con->error;
      }
      $db_con->close();
  }
?>
<form method="POST" action="create_order.php">
    <div class="form-group">
          <label for="customer-id">Customer ID :</label>
          <input type="number" id="customer_id" name="customer_id" required>
    </div>
    <div class="form-group">
          <label for="Item-id">Item ID : </label>
          <input type="number" id="item_id" name="item_id" required>
    </div>
    <div class="form-group">
          <label for="order-date">Order Date: </label>
          <input type="date" id="order_date" name="order_date" required>
    </div>
    <div class="form-group">
         <label for="discount">Discount : </label>
         <input type="number" step="0.01" id="discount" name="discount" value="0.00">
    </div>
    <div class="form-group">
         <label for="quantity">Quantity: </label>
         <input type="number" id="number" name="number" value="1" required>
    </div>
    <div class="form-group">
         <label for="unit-price">Unit Price: </label>
         <input type="number" step="0.01" id="unit_price" name="unit_price" required>
    </div>
    <div class="form-group">
         <label for="status">Status: </label>
         <select name="status">
              <option value="Pending">Pending</option>
              <option value="Completed">Completed</option>
              <option value="Canceled">Cancelled</option>
         </select>
    </div>
    <button type="submit" name="add_order" value="Create Order"></button>
</form>
