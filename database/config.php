<?php
     /* connect database */
     $host = 'localhost' /* Database host  */
     $dbname = 'inventory_system'; /* Database name */
     $username = 'root';
     $password = '';

     /* Create connection */
     try {
            $pdo = new PDO("mysql:$host;dbname=$dbname", $username, $password);
            $pdo->setAttbute(PDO::ATTR_ERRMODE, PDO::ERRORMODE_EXCEPTION);
     } catch (PDOException $e) {
           echo "Connection failed: " . $e->getMessage();
     }
?>
