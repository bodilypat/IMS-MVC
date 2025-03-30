<?php
     /* Include your database connection */
     include('../includes/dbconnect.php');

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           /* Input sanitization */
           $item_number = $db_con->real_escape_string($_POST['item_number']);
           $product_id = intval($_POST['product_id']);
           $item_name = $db_con->real_escape_string($_POST['item_name']);
           $discount = floatval($_POST['discount']);
           $stock = intval($_POST['stock']);
           $unit_price = floatval($_POST['unit_price']);
           $description = $db_con->real_escape_string($_POST['description']);

           /* Handle image upload */
           $image_url = 'imageNotAvailable.jpg'; /* Default image URL */

           if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 ) {
                $target_dir = "uploads/";  /* Ensure this folder exists on the server  */    
                $target_File = $target_dir . basename($_FILES['image']['name']);

                /* Validate image file extension (option) */
                $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $valid_image_types = array("jpg","jpeg","png","gif");

                if (in_array($image_file_type, $valid_image_types)) {
                     if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                         $image_url = $target_file;
                     } else { 
                         echo "Error uploading image.";
                     }
                } else {
                     echo "Invalid image format.";
                }
           }
           /* Prepared statement to insert into the the items table */
           $stmt = $db_con->prepare("INSERT INTO items(item_number, product_id, item_name, discount, stock, unit_price, status, description)
                                     VALUES('$item_number','$product_id','$item_name','$discount','$stock','$unit_price','$image_url','Active','$description')";
           if ($db_con->query($sql) === TRUE) {
                echo " New record created successfully";
           } else {
                echo "Error: " . $sql . "<br>" . $db_con->error;
           }
     }
?>
       
       
