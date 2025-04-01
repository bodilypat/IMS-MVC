<?php
     include('../includes/dbconnect.php');

     if (isset($_GET['item_id'])) {

          /* Validate and sanitize the item_id (ensure it's a valid integer */
          $item_id = intval($_GET['item_id']);

          /* Check if item_id is a valid positive integer */
          if ($item_id > 0) {

               /* Use prepared statements to prevent SQL injection */
               $sql = "DELETE FROM items WHERE item_id = ? ";

               if ($stmt = $db_con->prepare($sql)) {

                    /* Bind the item_id as a parameter to the prepared statement */
                    $stmt->bind_param("i", $item_id);

                    /* Execute the statement */
                    if ($stmt->execute()) {
                         echo "Item deleted successfully.";
                    } else {
                         echo "Error: " . $stmt->error;
                    }

                    /* Close the prepared statement */
                    $stmt->close();
               } else {
                    echo "Error preparing the query: " . $db_con->error;
               }
          } else {
               echo "Invalid item ID.";
          }

          /* Close the database connection */
          $db_con->close();
     } else {
          echo "No item ID provided.";
}
?>
