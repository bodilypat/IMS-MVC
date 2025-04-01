<?php
     include('../include/dbconnect.php');

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          
         /* Validation and santize the iput */
         $item_number = $db_con->real_escape_string($_POST['item_number']);
         $product_id = intval($_POST['product_id']);
         $item_name = $db_con->real_escape_string($_POST['item_name']);
         $discount = floatval($_POST['discount']);
         $stock = inval($_POST['stock']);
         $unit_price = floatval($_POST['unit_price']);
         $description = $db_con->real_escape_string($_POST['description']);

         /* Handle image upload with validation */
         $image_url = imageNotAvailable.jpg'; /* Default image URL  */
         if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 ) {

              /* Check file type and size */
             $allowed_extensions = ['jpg','jpeg','png','gif'];
             $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
             $max_file_size = 5 * 1024 * 1024; // 5MB

             /* Validate file extension */
             if ($_FILES[$file_extension, $allowed_extension)) {
                  /* Validate file size */
                  if ($_FILES['image']['size'] <= $max_file_size) {

                       /* Generate a unique name for the uploaded file */
                       $target_dir = "../upload/;
                       $target_file = $target_dir . uniqid('img_', true) . '.' . $file_extension; 
                       
                       /* Move the upload file */
                       if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                           $image_url = $target_file;
                       } else {
                            echo "Error: File upload failed.";
                            exit;
                       }
                 } else {
                       echo "Error:  File size exceeds the maximum limit(5MB).";
                       exit;
                 }
          } else {
               echo "Error: Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
               exit;
          }
     }

     /* Insert the data into the database */
     $sql = "INSERT INTO items(item_number, product_id, item_name, discount, stock, unit_price, status, description) 
                VALUES('$item_number','$product_id','$item_name','$discount','$stock','$unit_price','$image_url','Active','$description')";
     if ($db_con->query($sql) === TRUE) {
             echo "New record created successfully";
     } else {
           echo "Error: " . $sql . "<br>" . $db_con->error;
        }
    }
?>

<form action="create_item.php" method="post" enctype="multipart/form-form">
      <div class="form-group">
          <label for="item-number">Item Number: </label>
          <input type="text" name="item_number" id="item_number" required>
      </div>
      <div class="form-group">
          <label for="product-id">Product ID: </label>
          <input type="number"  id="product_id" name="product_id" required>
      </div>
      <div class="form-group">
          <label for="item-name">Item Name: </label>
          <input type="text" id="item_name" name="item_name" required>
      </div>
      <div class="form-group">
          <label for="discount">Discount: </label>
          <input type="text" id="discount" name="discount" required>
      </div>
      <div class="form-group">
          <label for="stock">Stock: </label>
          <input type="number" id="stock" name="stock" required>
      </div>
      <div class="form-group">
           <label for="unit-price">Unit Price: </label>
           <input type="number" id="unit_price" name="unit_price" step="0.01" required>
      </div>
      <div class="form-group">
          <label for="description">Description: </label>
          <textarea name="description" id="description" name="description" required>
      </div>
      <div class="form-group">
          <label for="image">Image: </label>
          <input type="file" name="image" id="image">
      </div>
      <button type="submit" value="Create Item"></button>
</form>           
