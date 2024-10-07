<?php

    require '../includes/function.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $customer_id = $_POST['customer_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if(addSale($customer_id, $product_id, $quantity, $price)){
            echo "Sale recorded successfully!";
        } else {
            echo "Failed to record sale. Not enought stock.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Sale</title>
    </head>
    <body>
        <h1>Add Sale</h1>
        <form method="POST">

            <div class="form-group">
                <label for="customer">Customer:</label>
                <select name="customer_id" class="form-contrrol" required>
                    <?php
                        $customer = $getCustomer(); 
                        foreach($customers as $cutomer): 
                    ?>
                        <option value="<?php echo $customer['id'];?>"><?php echo htmlspecialchars($customer['customer_name']);?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product">Product:</label>
                <select name="product_id" class="form-control" required>
                    <?php 
                        $product getProducts();
                        foreach($products as $product): 
                    ?>
                        <option value="<?php echo $product['id'];?>"><?php echo htmlspecialchars($product['product_name']);?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity: </lable>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <button type="submit">record sale</button>
        </form>
        <a href="view_sales.php">View Sales</a>
    </body>
</html>