<?php
     include('../includes/dbconnect.php');

     if (isset($_GET['item_id'])) {
          $item_id = $_GET['item_id'];
          $sql = "DELETE FROM items WHERE item_id = $item_id";

          if ($db_con->query($sql) === TRUE) {
                echo "Customer deleted successfully";
          } else {
                echo "Error: " . $sql . "<br>" . $db_con->error";
          }
          $db_con->close();
  ?>
