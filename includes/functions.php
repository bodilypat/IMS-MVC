<?php

    require 'dbconnect.php';

    function addProduct($name, $description, $quantity,$price,$category_id){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO products (product_name, description, price, quantity, category_id) VALUES (?,?,?,?,?)");
        return $stmt->execute([$product_name, $description, $price, $quantity, $category_id]);
    }

    function getProductById($product_id){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? ");
        $stmt->execute([$product_id]);
        return $stml->fetch(PDO::FETCH_ASSOC);
    }

    function getProducts(){
        global $pdo;
        $stmt = $pdo->prepare("SELECT  * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    