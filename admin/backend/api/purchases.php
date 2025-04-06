<?php
header("Content-Type: application/json");

// Include the database connection
include('dbconnect.php');

// Get the HTTP request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single purchase by ID
            $id = intval($_GET['id']);
            get_purchase($id);
        } else {
            // Fetch all purchases
            get_purchases();
        }
        break;

    case 'POST':
        // Create a new purchase
        create_purchase();
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Update an existing purchase
            update_purchase($id);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Delete a purchase
            delete_purchase($id);
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Get all purchases
function get_purchases() {
    global $conn;

    $sql = "SELECT * FROM purchases";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($purchases) {
        echo json_encode($purchases);
    } else {
        echo json_encode(array("message" => "No purchases found"));
    }
}

// Get a single purchase by ID
function get_purchase($id) {
    global $conn;

    $sql = "SELECT * FROM purchases WHERE purchase_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $purchase = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($purchase) {
        echo json_encode($purchase);
    } else {
        echo json_encode(array("message" => "Purchase not found"));
    }
}

// Create a new purchase
function create_purchase() {
    global $conn;

    // Get input data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['item_id'], $data['purchase_date'], $data['unit_price'], $data['quantity'], $data['vendor_id'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to insert data
    $sql = "INSERT INTO purchases (item_id, purchase_date, unit_price, quantity, vendor_id)
            VALUES (:item_id, :purchase_date, :unit_price, :quantity, :vendor_id)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':item_id', $data['item_id']);
    $stmt->bindParam(':purchase_date', $data['purchase_date']);
    $stmt->bindParam(':unit_price', $data['unit_price']);
    $stmt->bindParam(':quantity', $data['quantity']);
    $stmt->bindParam(':vendor_id', $data['vendor_id']);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New purchase created successfully", "purchase_id" => $conn->lastInsertId()));
    } else {
        echo json_encode(array("message" => "Error creating purchase"));
    }
}

// Update an existing purchase
function update_purchase($id) {
    global $conn;

    // Get input data from PUT request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['item_id'], $data['purchase_date'], $data['unit_price'], $data['quantity'], $data['vendor_id'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to update data
    $sql = "UPDATE purchases 
            SET item_id = :item_id, purchase_date = :purchase_date, unit_price = :unit_price, 
                quantity = :quantity, vendor_id = :vendor_id
            WHERE purchase_id = :id";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':item_id', $data['item_id']);
    $stmt->bindParam(':purchase_date', $data['purchase_date']);
    $stmt->bindParam(':unit_price', $data['unit_price']);
    $stmt->bindParam(':quantity', $data['quantity']);
    $stmt->bindParam(':vendor_id', $data['vendor_id']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Purchase updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating purchase"));
    }
}

// Delete a purchase
function delete_purchase($id) {
    global $conn;

    // Prepare SQL to delete purchase
    $sql = "DELETE FROM purchases WHERE purchase_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Purchase deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting purchase"));
    }
}
?>