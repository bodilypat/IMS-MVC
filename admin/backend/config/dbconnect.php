<?php
// Database connection settings
$host = 'psmedical.com'; // Database host (e.g., localhost, 127.0.0.1, etc.)
$dbname = 'dbmedical'; // The name of your database
$username = 'medical'; // The username for your database
$password = ''; // The password for your database

try {
    // Create a PDO instance
    $dsn = "mysql:host=$host;dbname=$dbname"; // Data Source Name
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Set error mode to exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Default fetch mode as associative array
        PDO::ATTR_EMULATE_PREPARES => false, // Disable emulated prepared statements
    ];
    
    // Create PDO instance
    $pdo = new PDO($dsn, $username, $password, $options);
    
    // If the connection is successful, you'll reach here
    echo "Connected successfully!";
} catch (PDOException $e) {
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
}
?>
