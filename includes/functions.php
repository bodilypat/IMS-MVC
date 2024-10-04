<?php

    require 'dbconnect.php';

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

    function getProductByForeignID($category_id,$supplier_id){
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
