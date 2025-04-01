<?php
     include('../includes/dbconnect.php');

     /* Fetch data from the items table */
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
                               <td>" . htmlspecialchars($row['item_id']) . "</td>
                               <td>" . htmlspecialchars($row['item_number']) . "</td>
                               <td>" . htmlspecialchars($row['product_id']) . "</td>
                               <td>" . htmlspecialchars($row['item_name']) . "</td>
                               <td>" . htmlspecialchars($row['discount']) . "</td>
                               <td>" . htmlspecialchars($row['stock']) . "></td>
                               <td>" . htmlspecialchars($row['unit_price']) . "</td>
                               <td>" . htmlspecialchars($row['image_url"]) . "</td>
                               <td>" . htmlspecialchars($row['status']) . "</td>
                               <td>" . htmlspecialchars($row['description']) ."</td>
                               <td><a href='update_item.php?id=" . htmlspecialchars($row['item_id']) . "'>Edit</a> | <a href="delete_item.php?id=" . htmlspecialchars($row['item_id']) . "'>Delete</a></td>
                          </tr>";
                     }
                     echo "</table>";
                } else {
                  echo "No items found";
          }
          $db_con->close();
?>

            
