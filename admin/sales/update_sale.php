<?php

    require '../includes/functions.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $customer_id = $_POST['customer_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if(updateSale($id, $customer_id, $product_id, $quantity)){
            echo "Sale updated successfully!";
        } else {
            echo "Failed to update sale. Not enough stock.";
        }
    } else {
        $id = $_GET['id'];
        //Fetch current sale details
        $stmt = $pdo->prepare("SELECT * FROM sales WHERE id = ?");
        $stmt->execute([$id]);
        $sale = $stmt->fetch();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Sale</title>
    </head>
    <body>
        <h1>Edit Sale</h1>
        <form method="POST">
            <div class="form-group">
                <label for="sale">Sale ID</label>
                <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
            </div>
            <div class="form-group">
                <select name="customer_id" required>
                    <option value="">Select Customer</option>
                    <?php
                        $customers = getCustomers();
                        foreach($customers as $customer){
                            $selected = ($customer['id'] == $sale['customer_id'])? 'selected' : '';
                            echo "<option value=\"{$customer['id']}\" $selected>{$customer['name']}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="product">Product name</label>
                <select name="product_id" required>
                    <option value="">Select Product</option>
                    <?php 
                         $products = getProducts();
                         foreach($products as $product) {
                            $selected = ($product['id'] == $sale['product_id']) ? 'selected' : '';
                            echo "<option value=\"{$product['id']}\" $selected>{$product['name']} (stock: {$product['stock']})</option>";
                         }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity: </label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <button type="submit">Update Sale</button>
        </form>
        <a href="view_sales.php"></a>
    </body>
</html>