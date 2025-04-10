<?php
header("Content-Type: application/json");

// Include the database connection
include('dbconnect.php');

// Get the HTTP request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single supplier by ID
            $id = intval($_GET['id']);
            get_supplier($id);
        } else {
            // Fetch all suppliers
            get_suppliers();
        }
        break;

    case 'POST':
        // Create a new supplier
        create_supplier();
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Update an existing supplier
            update_supplier($id);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Delete a supplier
            delete_supplier($id);
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Get all suppliers
function get_suppliers() {
    global $conn;

    $sql = "SELECT * FROM suppliers";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($suppliers) {
        echo json_encode($suppliers);
    } else {
        echo json_encode(array("message" => "No suppliers found"));
    }
}

// Get a single supplier by ID
function get_supplier($id) {
    global $conn;

    $sql = "SELECT * FROM suppliers WHERE supplier_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $supplier = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($supplier) {
        echo json_encode($supplier);
    } else {
        echo json_encode(array("message" => "Supplier not found"));
    }
}

// Create a new supplier
function create_supplier() {
    global $conn;

    // Get input data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['supplier_name'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to insert data
    $sql = "INSERT INTO suppliers (supplier_name, contact_info, address) 
            VALUES (:supplier_name, :contact_info, :address)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':supplier_name', $data['supplier_name']);
    $stmt->bindParam(':contact_info', $data['contact_info']);
    $stmt->bindParam(':address', $data['address']);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New supplier created successfully", "supplier_id" => $conn->lastInsertId()));
    } else {
        echo json_encode(array("message" => "Error creating supplier"));
    }
}

// Update an existing supplier
function update_supplier($id) {
    global $conn;

    // Get input data from PUT request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['supplier_name'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to update data
    $sql = "UPDATE suppliers 
            SET supplier_name = :supplier_name, contact_info = :contact_info, address = :address 
            WHERE supplier_id = :id";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':supplier_name', $data['supplier_name']);
    $stmt->bindParam(':contact_info', $data['contact_info']);
    $stmt->bindParam(':address', $data['address']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Supplier updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating supplier"));
    }
}

// Delete a supplier
function delete_supplier($id) {
    global $conn;

    // Prepare SQL to delete supplier
    $sql = "DELETE FROM suppliers WHERE supplier_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Supplier deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting supplier"));
    }
}
?>