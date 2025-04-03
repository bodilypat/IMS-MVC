<?php
include 'dbconnect.php';  // Include the database connection file

// Get JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if all required data is provided
if (isset($data['full_name']) && isset($data['mobile']) && isset($data['address']) && isset($data['state'])) {
    $full_name = $data['full_name'];
    $email = $data['email'] ?? null;
    $mobile = $data['mobile'];
    $phone = $data['phone'] ?? null;
    $address = $data['address'];
    $city = $data['city'] ?? null;
    $state = $data['state'];
    $status = $data['status'] ?? 'Active';

    // SQL Query to insert customer into the database
    $query = "INSERT INTO customers (full_name, email, mobile, phone, address, city, state, status) 
              VALUES (:full_name, :email, :mobile, :phone, :address, :city, :state, :status)";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add customer']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
// SQL Query to fetch all customers
$query = "SELECT * FROM customers";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Fetch all customers
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the customer data in JSON format
echo json_encode($customers);
// Get JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if required fields are provided
if (isset($data['customer_id']) && isset($data['full_name']) && isset($data['mobile']) && isset($data['address']) && isset($data['state'])) {
    $customer_id = $data['customer_id'];
    $full_name = $data['full_name'];
    $email = $data['email'] ?? null;
    $mobile = $data['mobile'];
    $phone = $data['phone'] ?? null;
    $address = $data['address'];
    $city = $data['city'] ?? null;
    $state = $data['state'];
    $status = $data['status'] ?? 'Active';

    // SQL Query to update customer
    $query = "UPDATE customers SET full_name = :full_name, email = :email, mobile = :mobile, phone = :phone, 
              address = :address, city = :city, state = :state, status = :status 
              WHERE customer_id = :customer_id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update customer']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
// Get JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if customer_id is provided
if (isset($data['customer_id'])) {
    $customer_id = $data['customer_id'];

    // SQL Query to delete customer
    $query = "DELETE FROM customers WHERE customer_id = :customer_id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':customer_id', $customer_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete customer']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Customer ID is required']);
}

?>
