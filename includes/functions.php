<?php

    require 'dbconnect.php';

    /* function register and new user */

    /* function to register a new user  */
    function registerUser($username, $password){
        global $pdo;

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users(username, password)VALUES(?, ?) ");
        return $stmt->execute([$username, $hashedPassword]);

    }

    function loginUser($username, $password){
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? ");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['passwprd'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION[username] = $user['username'];

            return true;
        }
        return false;
    }

    /* Function to check if user is logged in */

    function isLogedIn(){
        return isset($_SESSION['user_id']);
    }

    /* Function to get current user's details */
    function getUser(){
        global $pdo;
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
        global $pdo;

        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? ");
        return $stmt->execute(['id']);
    }
    /* Function manage products */
    function addProduct($name, $description, $quantity,$price,$category_id){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO products (product_name, description, price, quantity, category_id,supplier_id) 
                               VALUES ('$name','$description','$price','$quantity','$category_id','$supplier_id') ");
        // Bind Parameters
        $stmt->bindParam($name);
        $stmt->bindParam($description);
        $stmt->bindParam($price);
        $stmt->bindParam($quantity);
        $stmt->bindParam($category_id, PDO::PARAM_INT);
        $stmt->bindParam($supplier_id, PDO::PARAM_INT);
        
        //Execute the statement
        return $stmt->execute([$product_name, $description, $price, $quantity, $category_id,$supplier_id]);
    }

    function getProducts(){
        global $pdo;
        $stmt = $pdo->prepare("SELECT  * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProductById($product_id){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? ");
        $stmt->execute([$product_id]);
        return $stml->fetch(PDO::FETCH_ASSOC);
    }
    
    function getProductByCID($category_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * 
                               FROM products p
                               JOIN categories c ON p.category_id = c.id 
                               WHERE c.id = ? ");
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getProductBySID($supplier_id){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * 
                               FROM product p
                               JOIN suppliers s ON p.supplier_id = s.id 
                               WHERE s.id = ? ");
        $stmt->execute([$supplier_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProductByJoinID($category_id,$supplier_id){
        global $pdo;
        $stmt = $pdo->prepare("SELECT p.*, c.name AS category_name, s.name AS supplier_name
                               FROM products p
                               JOIN caregories c ON p.category_id = c.id
                               JOIN suppliers s ON p.supplier_id = s.id 
                               WHERE c.id = ? and s.id = ?  ");
        //bind parameters
        $stmt->bindParam(1, $category_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $supplier_id, PDO::PARAM_INT);

        //execute parameters
        $stmt->execute();
        //fetch all results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function updateProduct($id,$name, $description, $price, $quantity, $category_id, $supplier_id){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE products
                               SET name ='$name', description = '$description', price = '$price', quantity = '$quantity', category_id = '$category_id', supplier_id = '$supplier_id'
                               WHERE id ='$id' ");

        //Bind parameter
        $stmt->bindParam($name);
        $stmt->bindParam($description);
        $stmt->bindParam($price);
        $stmt->bindParam($quantity);
        $stmt->bindParam($categor_id, PDO::PARAM_INT);
        $stmt->bindParam($suplier_id, PDO::PARAM_INT);
        $stmt->bindParam($id, PDO::PARAM_INT);

        //Execute the statement
        return $stmt->execute();
    }

    function deleteProduct($id){
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = '$id' ");
        $stmt->bindParam($id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /* Function Manage Suppliers */
    function addSupplier($name, $contactInfo, $phone, $email, $address){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO suppliers (name, contactInfo, phone, email, address)
                               VALUE ('$name','$contactInfo','$phone','$email','$address') ");

        $stmt->bindParam($name);
        $stmt->bindParam($contactInfo);
        $stmt->bindParam($phone);
        $stmt->bindParam($email);
        $stmt->bindParam($address);

        return $stmt->execute();
    }

    function updateSupplier($id, $name, $contectInfo,$phone,$email, $address){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE suppliers SET name='$name', contactInfo = '$contactInfo', phone = '$phone', email = '$email', address = '$address'
                               WHERE id = '$id' ");
        //Bind Parameters
        $stmt->bindParam($name);
        $stmt->bindParam($contactInfo);
        $stmt->bindParam($phone);
        $stmt->bindParam($email);
        $stmt->bindParam($address);
        $stmt->bindParam($id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    function getSuppliers(){
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM suppliers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC;)
    }

    function deleteSupplier($id){
        global $pdo;
        $stmt->prepare("DELETE FORM suppliers WHERE id = '$id '");
        $stmt->bindParam($id, PDO::PARAM_INT);
    }

    /* Function management Categories */
    function addCategory($name, $description){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES('$name','$description') ");
        
        //bind parameters
        $stmt->bindParam($name);
        $stmt->bindParam($description);

        return $stmt->execute();
    }

    function updateCategory($id, $name, $description){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE categories SET name = '$name', description='$description', WHERE id= '$id' ");
        
        //bind paramenters
        $stmt->bindParam($name);
        $stmt->bindParam($description);
        $stmt->bindParam($id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    function deleteCategories($id){
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = '$id' ");
        $stmt->bindParam($id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    function getCategories() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM categories ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Function manage Purchase */
    function addPurchase($product_id, $supplier_id, $quantity, $totalCost){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO purchases(product_id, supplier_id, quantity, purchase_date, total_cost) 
                               VALUES(?, ?, ?, ?) ");
        $stmt = $pdo->execute([$product_id, $supplier_id, $quantity, $purchase_date, $total_cost]);
        return $pdo->lastInsertId();
    }

    function getPurchases(){
        global $pdo;
        $stmt = $pdo->query("SELECT purchase.id , suppliers.name as supplier_name, products.name As product_name, quantity, purchase_price, purchase_date
                             FROM purchases
                             JOIN suppliers ON purchases.supplier_id = supplier.id 
                             JOIN product ON purchases.product_id = priducts.id 
                             ORDER BY purchase_date DESC");;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPurchaseById($id){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM purchases WHERE id = ? ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updatePurchases($id, $product_id, $supplier_id, $quantity, $purchase_date, $total_cost ){
        global  $pdo;
        $stmt = $pdo->prepare("UPDATE purchases SET product_id = ?, supplier_id = ?, quantity = ?, purchase_date = ?, total_cost = ? ");
        return $stmt->execute([$product_id, $supplier_id, $quantity,$purchase_date, $total_cost]);
    }

    function deletePurchases($id){
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM purchases WHERE id = ? ");
        $stmt->execute(['id']);
    }

    /* Function manage customer */
    function addCustomer($name, $email){
        global $pdo;
        $stmt =$pdo->prepare("INSERT INTO customers(name, email) VALUES(?, ?) ");
        return $stmt->execute([$name, $email]);
    }

    // function get all customer
    function getCustomers() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM customers");
        return $stmt->fetchAll();
    }

    //Function to add a sale
    function addSale($customer_id, $product_id, $quanity){
        global $pdo;
        // check stock availability
        $stmt = $pdo->prepare("SELECT stock FROM products WHERE id =? ");
        $stmt->execute(['product_id']);
        $product = $stmt->fetch();

        if($product && $product['stock'] >= $quanity ){
            $stmt = $pdo->prepare("INSERT INTO sales (customer_id, product_id, quantity) VALUES(?,?,?) ");
            $stmt->execute([$customer_id, $product_id, $quantity]);

            //Update product stock
            $new_stock = $product['stock'] - $quantity;
            $updateStmt = $pdo->prepare("UPDATE prducts SET stock=? WHERE id= ? ");
            $updateStmt->execute([$new_stock, $product_id]);

            return true;
        }
        return false; // not enough stock;
    }

    //fuction get all sales
    function getSales() {
        global $pdo;
        $stmt = $pdo->query("
                SELECT sale.id, customers.name AS customer_name, products.name AS product_name, sales.quantity, sales.sale_date
                FROM sales
                JOIN customers ON sales.customer_id = customers.id 
                JOIN products ON sales.product_id = products.id 
                ORDER BY sale_date DESC ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to update a sale
    function updateSale($id, $customer_id, $product_id, $quantity) {
        global $pdo;

        /* Check stock availability */
        $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = ? ");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if($product && $product['stock'] >= $quantity)  {
            //Update the sale record
            $stmt = $pdo->prepare("UPDATE sales SET customer_id = ? , product_id = ? , quantity = ?, WHERE id = ? ");
            $stmt ->execute([$customer_id, $product_id, $quantity, $id]);

            // Adjust the stock according (this is simplified; consider provious stock level)
            // Get previous sale to adjust stock
            $stmt = $pdo->prepare("SELECT quantity FROM sales WHERE id = ?");
            $stmt->execute([id]);
            $previousSale = $stmt->fetch();
            
            if($previoussSale) {
                $new_stock = $product['stock'] + $previoussSale['quantity']-$quantity;
                $updateStmt = $pdo->prepare("UPDATE products SET stock = ?, WHERE id = ? ");
                $updateStmt->execute([$new_stock, $product_id]);
            }
            return ture;
        }
        return false; // Not enough stock
    }
?>