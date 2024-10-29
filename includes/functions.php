<?php

    require 'dbconnect.php';

    /* function to register a new user  */
    function registerUser($username, $password){
        $pdo = dbconnect();

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users(username, password)VALUES(?, ?) ");
        return $stmt->execute([$username, $hashedPassword]);

    }

    function loginUser($username, $password){
        $pdo = dbconnect();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? ");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['passwprd'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION[username] = $user['username'];

            return true;// login successfull
        }
        return false; //login failed
    }

    /* Function to check if user is logged in */

    function isLogedIn(){
        return isset($_SESSION['user_id']);
    }

    function logoutUser() {
        session_start();
        session_destroy();
        header("Location:login.php")
        exit();
    }
    /* Function to get current user's details */
    function getUser(){
        $pdo = dbconnect();
        if(isLoggedIn())
        {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id =? ");
            $stmt->execute($_SESSION['user_id']);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    // Function to delete a user 
    function deleteUser($id) {
        $pdo = dbconnect();

        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? ");
        return $stmt->execute(['id']);
    }

    /* Function manage products */
    function addProduct($name, $category_id, $supplier_id, $description, $stock,$price,$record_level){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("INSERT INTO products (name,category_id, supplier_id, description, stock, price, record_level) 
                               VALUES (:name :category_id, :supplier_id, :description, :stock, :price, :record_level) ");
        // Bind Parameters
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':supplier_id', $supplier_id, PDO::PARAM_INT);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':price',$price);
        $stmt->bindParam(':record_leval',$record_level);
        
        
        //Execute the statement
        return $stmt->execute() ? "product added successfully!" : "Faile to add product.";
    }

    function getProducts(){
        $pdo = dbconnect();
        $sql = $pdo->query("SELECT product.id,products.name
                                      categories.name as categry_name,
                                      suppliers.name as suppler_name,
                                      products.description,
                                      products.stock,
                                      products.price,
                                      products.record_level
                               FROM products 
                               JOIN categories ON products.category_id = categories.id
                               JOIN suplliers ON products.supplier_id = suppliers.id
                               ORDER BY product.name ASC ");
        $stmt->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProductById($product_id){
        $pdo = dbconnect();
        $sql = $pdo->query("SELECT products.id, products.name ,
                                   categories.name as category_name,
                                   suppliers.name as supplier_name,
                                   products.description,
                                   products.stock,
                                   products.price,
                                   products.record_level
                                   FROM products 
                                   JOIN categories ON products.category_id = categories.id
                                   JOIN suppliers ON products.supplier_id = suppliers.id 
                                   WHERE id = ? ");
        $stmt->execute([$sql]);
        return $stml->fetch(PDO::FETCH_ASSOC);
    }
    
    function updateProduct($id,$name, $category_id, $supplier_id, $description, $stock, $price, $record_level ){
        $pdo = dbconnect();
        $sql = $pdo->prepare("UPDATE products SET name ='$name', 
                                                   category_id = '$category_id',
                                                   supplier_id = '$supplier_id',
                                                   description = '$description', 
                                                   stock = '$stock',
                                                   price = '$price', 
                                                   stock = '$record_level'
                               WHERE id ='$id' ");

        //Bind parameter
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':descript', $description);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $categor_id, PDO::PARAM_INT);
        $stmt->bindParam(':supplier_id', $suplier_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //Execute the statement
        return $stmt->execute() ? "Product updated successfull!" : "Failed to update product.";
    } 

    function deleteProduct($id){
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = '$id' ");
        $stmt->bindParam($id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /* Function Manage Suppliers */
    function addSupplier($name, $contactInfo, $phone, $email, $address){
        $pdo = dbconnect();

        $stmt = $pdo->prepare("INSERT INTO suppliers (name, contactInfo, phone, email, address)
                               VALUE ('$name','$contactInfo','$phone','$email','$address') ");

        $stmt->bindParam($name);
        $stmt->bindParam($contactInfo);
        $stmt->bindParam($phone);
        $stmt->bindParam($email);
        $stmt->bindParam($address);

        return $stmt->execute() ? "Supplier created successfully!" : "Failed to create supplier.";
    }

    function getSuppliers(){
        $pdo = dbconnect();
        $sql = $pdo->query("SELECT * FROM suppliers");
        $stmt->execute() ;
        return $stmt->fetchAll(PDO::FETCH_ASSOC;)
    }

    function updateSupplier($id, $name, $contectInfo, $phone, $email, $address){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("UPDATE suppliers SET name='$name', contactInfo = '$contactInfo', phone = '$phone', email = '$email', address = '$address'
                               WHERE id = '$id' ");
        //Bind Parameters
        $stmt->bindParam($id);
        $stmt->bindParam($name);
        $stmt->bindParam($contactInfo);
        $stmt->bindParam($phone);
        $stmt->bindParam($email);
        $stmt->bindParam($address);

        return $stmt->execute() ? "Supplier updated successfully!" : "Failed to update supplier.";
    }

    function deleteSupplier($id){
        $pdo = dbconnect();
        $pdo = $pdo->prepare("DELETE FROM suppliers WHERE id = '$id '");
        $stmt->bindParam($id);
        return $stmt->execute() ? "Supplier deleted successfull!" : "Failed to delete supplier.";
    }

    /* Function management Categories */
    function addCategory($name, $description){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES('$name','$description') ");
        
        //bind parameters
        $stmt->bindParam( $name);
        $stmt->bindParam($description);

        return $stmt->execute() ? "Category Created Successfull!" : "Failed to create category.";
    }

    function getCategories() {
        $pdo = dbconnect();
        $stmt = $pdo->prepare("SELECT * FROM categories ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateCategory($id, $name, $description){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("UPDATE categories SET name = '$name', description='$description', WHERE id= '$id' ");
        
        //bind paramenters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':descript', $description);

        return $stmt->execute() ? "Category updated successfully!" : "Failed to updated categoryy.";
    }

    function deleteCategory($id){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = '$id' ");
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute() ? "Category deleted successfull!" : "Falled to delete category.";
    }

    /* Function manage Purchase */
    function addPurchase($product_id, $supplier_id, $quantity, $total_cost){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("INSERT INTO purchases(product_id, supplier_id, quantity, purchase_date, total_cost) 
                               VALUES('$product_id','$supplier_id','$quantity','$purchase_date','$total_cost') ");
        
        // bind parameters
        $stmt->bindParam($product_id);
        $stmt->bindParam($supplier_id);
        $stmt->bindParam($quantity);
        $stmt->bindParam($purchase_date);
        $stmt->bindParam($total_cost);

        return $stmt->execute() ? "Purchase ";
    }

    /* Function manage customer */
    function addCustomer($name, $email, $phone){
        $pdo = dbconnect();
        $stmt =$pdo->prepare("INSERT INTO customers(name, email, phone) VALUES(?, ?, ?) ");
        return $stmt->execute([$name, $email, $phone]);
    }

    function getCustomers() {
        $pdo = dbConnect();
        $stmt = $pdo->query("SELECT * FROM customers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getCustomerById($id){
        $pdo = dbconnect();
        $sql = $pdo->query("SELECT customers WHERE id = '$d' ");
        return $stmt->execute([$id]);
    }

    function updateCustomer($id, $name, $email, $phone){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("UPDATE customers SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$id' ");

        return    $stmt->execute([$name, $email, $phone, $id]);
    }

    function deleteCustomer($id) {
        $pdo = dbconnect();
        $stmt = $pdo->prepare("DELETE FORM custoemrs WHERE id = '$id' ");
        return $stmt->execute([$id]);
    }


    //Function manage sales
    function addSales($product_id, $customer_id,  $quanity, $sale_date){
        $pdo = dbconnect();
        // check stock availability
        $stmt = $pdo->query("SELECT stock FROM products WHERE id ='$product_id' ");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if($product_id && $product['stock'] >= $quanity ){
            $stmt = $pdo->prepare("INSERT INTO sales (product_id, customer_id, quantity, sale_date ) 
                                   VALUES('$product_id','$customer_id','$quantity','$sale_date) ");
            $stmt->execute([$product_id, $customer_id, $quantity, $sale_date]);

            //Update product stock
            $new_stock = $product['stock'] - $quantity;
            $updateStmt = $pdo->prepare("UPDATE products SET stock= '$new_stock' WHERE id= '$product_id' ");
            $updateStmt->execute([$new_stock, $product_id]);

            return true;
        }
        return false; // not enough stock;
    }

    //fuction get all sales
    function getSales() {
        $pdo = dbconnect();
        $stmt = $pdo->query(" SELECT sales.id,  
                              products.name AS product_name, 
                              customers.name AS customer_name,
                              sales.quantity,
                              sales.sale_date
                FROM sales
                JOIN customers ON sales.customer_id = customers.id 
                JOIN products ON sales.product_id = products.id 
                ORDER BY sale_date DESC ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getSaleById($sale_id){
        $pdo = dbconnect();

        $sql = $pdo->query("SELECT sales.id, 
                                   products.name AS product_name,
                                   customers.name AS customer_name,
                                   sales.quantity,
                                   sales.sale_date
                            FROM sales 
                            JOIN products ON sales.product_id = products.id
                            JOIN customers ON sales.customer_id = customers.id
                            WHERE BY id = '$sale_id'  ");
        $stmt->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function updateSale($id, $product_id, $customer_id, $quantity, $sale_date) {
        $pdo = dbconnect();

        /* Check stock availability */
        $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = '$product_id' ");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if($product_id && $product['stock'] >= $quantity)  {
            //Update the sale record
            $stmt = $pdo->prepare("UPDATE sales SET product_id = '$product_id', customer_id = '$customer_id', quantity = '$quantity', sale_date = '$sale_date' WHERE id = '$product_id' ");
            $stmt ->execute([$product_id, $customer_id, $quantity, $sale_date, $id]);

            // Adjust the stock according (this is simplified; consider provious stock level)
            // Get previous sale to adjust stock
            $stmt = $pdo->prepare("SELECT quantity FROM sales WHERE id = '$id' ");
            $stmt->execute([$id]);
            $previousSale = $stmt->fetch();
            
            if($previousSale) {
                $new_stock = $product['stock'] + $previousSale['quantity']-$quantity;
                $updateStmt = $pdo->prepare("UPDATE products SET stock = '$new_stock', WHERE id = '$id' ");
                $updateStmt->execute([$new_stock, $id]);
            }
            return ture;
        }
        return false; // Not enough stock
    }

    /* Function manage purchase */
    
    function addPurchase($user_id, $product_id, $quantity){
        $pdo = dbconnect();

        /* Validate input */
        if($quantity <= 0) {
            throw new Exception("Quantity must to greater than zero.");
        }

        /* Fetch product details */
        $stmt = $pdo->prepare("SELECT price, stock FROM products WHERE  id = '$product_id' ");
        $stmt->execute(['product_id' => $product_id]);
        $product =  $stmt->fetch(PDO::FETCH_ASSOC);

        /* Check stock availability */
        if($product['stock'] < $quantuty){
            trow new Exception("Insufficient stock.");
        }

        /* calculate total price */
        $totalPrice = $product['price'] * $quantity;

        /* Insert purchase record */
        $stmt = $pdo->prepare("INSERT INTO purchases(user_id, product-id, quantity, total_price)
                               VALUES ('$user_id','$product_id','$quantity','$totalPrice') ");
        $stmt->execute(['user_id' => $user_id,
                         'product_id' => $product_id,
                         'quantity' => $quantity,
                         'total_price' => $tatalPrice 
                        ]);

        /* Update product stock */
        $new_stock = $product['stock'] - $quantity;
        $stmt = $pdo->prepare("UPDATE products SET stock = '$new_stock' WHERE id = '$product_id' ");
        $stmt->execute(['stock' => $new_stock, 'product_id' => $product_id ]);

        return "Purchase successful! Total price : $" . number_format($totalPrice, 2 );
    }

    function updatePurchase($purchase_id, $user_id, $product_id, $quantity) {
        $pdo = dbconnect();

        // Validate input 
        if($quantity <=0){
            throw new Exception("Quantity must be greater than zero. ");
        }

        // Fetch current purchase details
        $stmt = $pdo->prepare("SELECT product_id, quantity, FROM purchases WHERE id='$purchase_id' AND user_id = '$user_id' ");
        $stmt->execute(['purchase_id' => $purchase_id, 'user_id' => $user_id]);
        $purchase = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$purchase){
            throw new Exception("Purchase not found. ");
        }

        // Fetch product details
        $stmt = $pdo->prepare("SELECT price, stock FROM products WHERE id = '$product_id ' ");
        $stmt->execute(['product_id' => $product_id ]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!product) {
            throw new Exception("Product not found. ");
        }

        // Check stock availability 
        $new_quantity = $quantity;
        $old_quantity = $purchase['quantity'];
        $stock_change = $new_quantity - $old_quantity;

        if($product['stock'] < $stock_change) {
            throw new Exception("Insufficient stock.");
        }

        // Calculate total record
        $stmt = $pdo->prepare("UPDATE purchase SET product_id = '$product_id', quantity = '$quantity', total_price = '$total_price', WHERE id = '$purchase_id' ");
        $stmt->execute([
            'purchase_id' => $purchase_id,
            '$quantity' => $quantity,
            'total_price' => $total_price
        ]);

        // Update product stock
        $new_stock = $product['stock'] - $stock_change;
        $stmt = $pdo->prepare("UPDATE products SET stock = '$new_stock', WHERE id = '$product_id' ");
        $stmt->execute(['stock' => $new_stock, 'product_id' => $product_id]);

        return "Purchase update successfull! New Total price: $ " . number_format($total_price, 2);
    }

    function managePurchase($user_id, $product_id, $quantity) {
        $pdo = dbconnect();

        // Validate input
        if($quantity <= 0 ) {
            throw new Exception("Quantity must be greater than zero.");
        }

        // Fetch product details
        $stmt = $pdo->prepare("SELECT price, stock FROM products WHERE id = '$product_id' ");
        $stmt->execute(['product_id' => $product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$product) {
            throw new Exception("Product not found.");
        }

        // Check stock availability
        if($product['stock'] < $quantity ) {
            throw new Exception("Insufficient stock. ");
        }

        // Calculate total price 
        $total_price = $product['price'] * $quantity;

        // Insert purchase record
        $stmt = $pdo->prepare("INSERT INTO purchases (user_id, product_id, quantity, total_price)
                               VALUES('$user_id','$product_id','$quantity','$total_price') ");
        $stmt->execute([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'total_price' = $total_price
        ]);

        // Update product stock
        $new_stock = $product['stock'] - $quantity;
        $stmt = $pdo->prepare("UPDATE purchases SET stock = '$new_stock' WHERE id = '$product_id' ");
        $stmt->execute(['stock' => $new_stock, 'product_id' => $product_id]);

        return "Purchase successful! Total price: $ " . number_format($total_price, 2);
    }

    function deletePurchase($purchase_id, $user_id) {
        $pod = dbconnect();

        // Check if the purchase exists
        $stmt = $pdo->prepare("SELECT product_id, quantity, FROM purchases WHERE id = '$purchase_id' AND user_id = '$user_id' ");
        $stmt->execute(['purchase_id' => $purchase_id, 'user_id' => $user_id]);
        $purchase = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$purchase){
            throw new Exception("Purchase not found or you do not have permission to delete this purchase.");
        }

        // Fetch product details to update stock
        $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = '$product_id' ");
        $stmt->execute(['product_id' => $purchase['product_id']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$product){
            throw new Exception('Product not found.');
        }

        // Update product stock 
        $new_stock = $product['stock'] + $purchase['quantity'];
        $stmt = $pdo->prepare("UPDATE products SET stock= '$new_stock' WHERE id = '$product_id' ");
        $stmt->execute(['stock' => $new_stock, 'product_id' => $purchase['product_id']]);

        // Delete the purchase record
        $stmt = $pdo->prepare("DELETE purchasen WHERE id ='$purchase_id' ");
        $stmt->execute(['purchase_id' => $purchase_id])

        return "Purchase deleted successfully!";
    }
?>