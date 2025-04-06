<?php
header("Content-Type: application/json");

// Include the database connection
include('dbconnect.php');

// Get the HTTP request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single product by ID
            $id = intval($_GET['id']);
            get_product($id);
        } else {
            // Fetch all products
            get_products();
        }
        break;

    case 'POST':
        // Create a new product
        create_product();
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Update an existing product
            update_product($id);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Delete a product
            delete_product($id);
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Get all products
function get_products() {
    global $conn;

    $sql = "SELECT * FROM products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        echo json_encode($products);
    } else {
        echo json_encode(array("message" => "No products found"));
    }
}

// Get a single product by ID
function get_product($id) {
    global $conn;

    $sql = "SELECT * FROM products WHERE product_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(array("message" => "Product not found"));
    }
}

// Create a new product
function create_product() {
    global $conn;

    // Get input data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['product_name']) || !isset($data['price']) || !isset($data['quantity']) || !isset($data['vendor_id'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to insert data
    $sql = "INSERT INTO products (product_name, description, price, quantity, vendor_id) 
            VALUES (:product_name, :description, :price, :quantity, :vendor_id)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':product_name', $data['product_name']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':price', $data['price']);
    $stmt->bindParam(':quantity', $data['quantity']);
    $stmt->bindParam(':vendor_id', $data['vendor_id'], PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New product created successfully", "product_id" => $conn->lastInsertId()));
    } else {
        echo json_encode(array("message" => "Error creating product"));
    }
}

// Update an existing product
function update_product($id) {
    global $conn;

    // Get input data from PUT request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['product_name']) || !isset($data['price']) || !isset($data['quantity']) || !isset($data['vendor_id'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to update data
    $sql = "UPDATE products 
            SET product_name = :product_name, description = :description, price = :price, quantity = :quantity, vendor_id = :vendor_id 
            WHERE product_id = :id";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':product_name', $data['product_name']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':price', $data['price']);
    $stmt->bindParam(':quantity', $data['quantity']);
    $stmt->bindParam(':vendor_id', $data['vendor_id'], PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Product updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating product"));
    }
}

// Delete a product
function delete_product($id) {
    global $conn;

    // Prepare SQL to delete product
    $sql = "DELETE FROM products WHERE product_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Product deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting product"));
    }
}
?>