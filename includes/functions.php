<?php

    require 'dbconnect.php';

    function addProduct($name, $description, $quantity,$price){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO products (product_name, description, price, quantity, categoryId) VALUES (?,?,?,?,?)");
        return $stmt->execute([$product_name, $description, $price, $quantity, $category_id]);
    }

    function getProducts() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * 
                               FROM products p
                               JOIN categories c ON p.category_id = c.id 
                               WHERE c.id = ? ");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProductById($product_id){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? ");
        $stmt->execute([$product_id]);
        return $stml->fetch(PDO::FETCH_ASSOC);
    }
