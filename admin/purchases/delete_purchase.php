<?php

    include('../includes/dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['purchase_id']) {
          $purchase_id = $_POST['purcahse_id'];

          // Purchase and execute the DELETE statement using a prepared statement to prevent SQL injection
          $sql ="DELETE FROM purchases WEHRE purchase_id = :purchase_id" ;
          $stmt = $db_con->query($sql);
          
          // Bind the parameter and execute the statement
          $stmt->bindParam(':purchase_id', $purchase_id, PDO:PARAM_INT);

         // Check if the query was executed successfully
         if($stmt->execute()) {
             // Redirect to manage purchases page with success
             header("Location: manage_purchases.php?staus=success");
             exit();
         } else {
             // Redirect to manage purchase page with error 
             header("Location: manage_purchases.php?status=error");
             exit();
        } 
    } else {
        // If the request method is not POST or 'purchase_id' is not set 
        header("Location:manage_purchases.php");
        exit();
    }
?>
