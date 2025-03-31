<?php
     include('../includes/dbconnect.php');

     $qItem = "SELECT * FROM items;
     $result = $db_con->query($qItem);

     if ($result->num_rows > 0) {
         /* Output data of each row */
         while ($row = $result->fetch_assoc()) {
              echo "<table border='1'>
                         <tr>
                               <th>Item ID</th>
                               <th>Item Number</th>
                               <th>Product ID</th>
                               <th>Item Name</th>
                               <th>Discount</th>
                               <th>Stock</th>
                               <th>Unit Price</th>
                               <th>Image URL</th>
                               <th>Status</th>
                               <th>Discription</th>
                               <th>Action</th>
                         </tr>";
                    while ($row = $result->fetch_assoc()) {
                    echo "<tr> 
                               <td>" . $row['item_id'] . "</td>
                               <td>" . $row['item_number'] . "</td>
                               <td>" . $row['product_id'] . "</td>
                               <td>" . $row['item_name'] . "</td>
                               <td>" . $row['discount'] . "</td>
                               <td>" . $row['stock'] . "></td>
                               <td>" . $row['unit_price'] . "</td>
                               <td>" . $row['image_url"] . "</td>
                               <td>" . $row['status'] . "</td>
                               <td>" . $row['description'] ."</td>
                               <td><a href='update_item.php?id=" . $row['item_id'] . "'>Edit</a> | <a href="delete_item.php?id=" . $row['item_id'] . "'>Delete</a></td>
                          </tr>";
                     }
                     echo "</table>";
                } else {
                  echo "No items found";
          }
          $db_con->close();
?>

            
