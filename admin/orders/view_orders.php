<?php
     include('../include/dbconnect.php');

     $sql = "SELECT * FROM orders";
     $result = $db_con->query($sql);

     if ($result->num_rows > 0) {
          echo "<table border='1'> 
                     <tr>
                         <th>Order ID<th>
                         <th>Customer ID</th>
                         <th>Item ID</th>
                         <th>Order Date</th>
                         <th>Discount</th>
                         <th>Quantity</th>
                         <th>Unit Price</th>
                         <th>Total Price</th>
                         <th>Created On</th>
                         <th>Updated On</th>
                         <th>Actions</th>
                     </tr>";
          while($row = $result->fetch_assoc()) {
            echo "<tr>
                        <td>" . $row['order_id'] ."</td>
                        <td>" . $row['customer_id'] ."</td>
                        <td>" . $row['item_id'] ."</td>
                        <td>" . $row['order_date'] ."</td>
                        <td>" . $row['quantity'] ."</td>
                        <td>" . $row['unit_price'] ."</td>
                        <td>" . $row['total_price'] ."</td>
                        <td>" . $row['status'] ."</td>
                        <td>" . $row['created_on"] ."</td>
                        <td>" . $row['updated_on'] ."</td>
                        <td><a href='update_order.php?id=" . $row['order_id'] . "'>Edit</a> | <a href='delete_order.php?id=" . $row['order_id'] . "'>Delete</a></td>
                  </tr>";
          }
         echo "</table>";
     } else {
         echo "No orders found";
     }
  $db_con->close();
?>
