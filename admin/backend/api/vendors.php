<?php
header("Content-Type: application/json");

// Include the database connection
include('dbconnect.php');

// Get the HTTP request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single vendor by ID
            $id = intval($_GET['id']);
            get_vendor($id);
        } else {
            // Fetch all vendors
            get_vendors();
        }
        break;

    case 'POST':
        // Create a new vendor
        create_vendor();
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Update an existing vendor
            update_vendor($id);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Delete a vendor
            delete_vendor($id);
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Get all vendors
function get_vendors() {
    global $conn;

    $sql = "SELECT * FROM vendors";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $vendors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($vendors) {
        echo json_encode($vendors);
    } else {
        echo json_encode(array("message" => "No vendors found"));
    }
}

// Get a single vendor by ID
function get_vendor($id) {
    global $conn;

    $sql = "SELECT * FROM vendors WHERE vendor_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $vendor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vendor) {
        echo json_encode($vendor);
    } else {
        echo json_encode(array("message" => "Vendor not found"));
    }
}

// Create a new vendor
function create_vendor() {
    global $conn;

    // Get input data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['vendor_name']) || !isset($data['mobile']) || !isset($data['address'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to insert data
    $sql = "INSERT INTO vendors (vendor_name, email, mobile, phone, address, city, state, status) 
            VALUES (:vendor_name, :email, :mobile, :phone, :address, :city, :state, :status)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':vendor_name', $data['vendor_name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':mobile', $data['mobile']);
    $stmt->bindParam(':phone', $data['phone']);
    $stmt->bindParam(':address', $data['address']);
    $stmt->bindParam(':city', $data['city']);
    $stmt->bindParam(':state', $data['state']);
    $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New vendor created successfully", "vendor_id" => $conn->lastInsertId()));
    } else {
        echo json_encode(array("message" => "Error creating vendor"));
    }
}

// Update an existing vendor
function update_vendor($id) {
    global $conn;

    // Get input data from PUT request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['vendor_name']) || !isset($data['mobile']) || !isset($data['address'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to update data
    $sql = "UPDATE vendors 
            SET vendor_name = :vendor_name, email = :email, mobile = :mobile, phone = :phone, address = :address, 
            city = :city, state = :state, status = :status 
            WHERE vendor_id = :id";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':vendor_name', $data['vendor_name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':mobile', $data['mobile']);
    $stmt->bindParam(':phone', $data['phone']);
    $stmt->bindParam(':address', $data['address']);
    $stmt->bindParam(':city', $data['city']);
    $stmt->bindParam(':state', $data['state']);
    $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Vendor updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating vendor"));
    }
}

// Delete a vendor
function delete_vendor($id) {
    global $conn;

    // Prepare SQL to delete vendor
    $sql = "DELETE FROM vendors WHERE vendor_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Vendor deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting vendor"));
    }
}
?>