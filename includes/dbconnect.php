<?php

    /* dbconnect.php */
    $host = 'localhost';
    $db = 'db_inventory';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db",$user, $pass);
        $pdo->setAttribute(POD::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException) {
        die("Connection failed: ", .$e->getMessage());
    }