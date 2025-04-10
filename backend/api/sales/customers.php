<?php
header("Content-Type: application/json");

// Include the database connection
include('dbconnect.php');

// Get the HTTP request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // If an ID is provided, fetch a single customer
            $id = intval($_GET['id']);
            get_customer($id);
        } else {
            // Otherwise, fetch all customers
            get_customers();
        }
        break;

    case 'POST':
        // Create a new customer
        create_customer();
        break;

    case 'PUT':
        // Update an existing customer
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            update_customer($id);
        }
        break;

    case 'DELETE':
        // Delete a customer
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            delete_customer($id);
        }
        break;

    default:
        // Invalid method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Get all customers
function get_customers() {
    global $conn;

    $sql = "SELECT * FROM customers";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($customers) {
        echo json_encode($customers);
    } else {
        echo json_encode(array("message" => "No customers found"));
    }
}

// Get a single customer by ID
function get_customer($id) {
    global $conn;

    $sql = "SELECT * FROM customers WHERE customer_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($customer) {
        echo json_encode($customer);
    } else {
        echo json_encode(array("message" => "Customer not found"));
    }
}

// Create a new customer
function create_customer() {
    global $conn;

    // Get input data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['full_name'], $data['email'], $data['mobile'], $data['address'], $data['state'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to insert data
    $sql = "INSERT INTO customers (full_name, email, mobile, phone, address, city, state, status)
            VALUES (:full_name, :email, :mobile, :phone, :address, :city, :state, :status)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':full_name', $data['full_name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':mobile', $data['mobile']);
    $stmt->bindParam(':phone', $data['phone']);
    $stmt->bindParam(':address', $data['address']);
    $stmt->bindParam(':city', $data['city']);
    $stmt->bindParam(':state', $data['state']);
    $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New customer created successfully", "customer_id" => $conn->lastInsertId()));
    } else {
        echo json_encode(array("message" => "Error creating customer"));
    }
}

// Update an existing customer
function update_customer($id) {
    global $conn;

    // Get input data from PUT request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['full_name'], $data['email'], $data['mobile'], $data['address'], $data['state'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to update data
    $sql = "UPDATE customers 
            SET full_name = :full_name, email = :email, mobile = :mobile, phone = :phone, address = :address, 
                city = :city, state = :state, status = :status
            WHERE customer_id = :id";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':full_name', $data['full_name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':mobile', $data['mobile']);
    $stmt->bindParam(':phone', $data['phone']);
    $stmt->bindParam(':address', $data['address']);
    $stmt->bindParam(':city', $data['city']);
    $stmt->bindParam(':state', $data['state']);
    $stmt->bindParam(':status', $data['status']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Customer updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating customer"));
    }
}

// Delete a customer
function delete_customer($id) {
    global $conn;

    // Prepare SQL to delete customer
    $sql = "DELETE FROM customers WHERE customer_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Customer deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting customer"));
    }
}
?>
