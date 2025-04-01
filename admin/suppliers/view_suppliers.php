<?php
     include('../includes/dbconnect.php');

     /* SQL to fetch all suppliers */
     $sql ="SELECT * FROM suppliers";
     $result = $db_con->query($sql);

     if ($result->num_rows > 0 ) {
          echo "<table border='1' >
                       <tr>
                            <th>Supplier ID</th>
                            <th>Supplier Name</th>
                            <th>Contact Info</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                       </tr>";
          while ($row = $result->fetch_assoc()) {
                 echo "<tr>
                            <td>" . $row['supplier_id'] . "</td>
                            <td>" . $row['supplier_name'] . "</td>
                            <td>" . $row['contact_info'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>" . $row['created_at'] . "</td>
                            <td>" . $row['updated_at'] . "</td>
                            <td>
                                 <a href='update_supplier.php?id=" . $row['supplier_id'] . "'>Edit</a> | <a href='delete_supplier.php?id=" . $row['supplier_id'] ."'>Delete</a>
                            </td>
                       </tr>";
          }
          echo "</table>";
     } else {
       echo "No suppliers found. ";
  }
  $db_con->close();
?>
