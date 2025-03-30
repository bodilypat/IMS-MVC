<?php
     include('../include/dbconnect.php');

     if (isset($_GET['id'])) {
          $order_id = $_GET['id'];

    $sql = "DELETE FROM orders WHERE order_id = '$order_id";
    if ($db_con->query($sql) === TRUE) {
        echo "Order deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $db_con->error;
    }
    $db_con->close();
}  
?>
