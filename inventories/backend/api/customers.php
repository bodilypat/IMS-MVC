<?php
require 'dbconnect.php';

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

switch ($method) {
    case 'GET':
        if (isset($request[0]) && is_numeric($request[0])) {
            getCustomer($request[0]);
        } else {
            getCustomers();
        }
        break;
    case 'POST':
        createCustomer();
        break;
    case 'PUT':
        if (isset($request[0]) && is_numeric($request[0])) {
            updateCustomer($request[0]);
        } else {
            echo json_encode(['error' => 'Invalid Customer ID']);
        }
        break;
    case 'DELETE':
        if (isset($request[0]) && is_numeric($request[0])) {
            deleteCustomer($request[0]);
        } else {
            echo json_encode(['error' => 'Invalid Customer ID']);
        }
        break;
    default:
        echo json_encode(['error' => 'Invalid Request Method']);
}

function getCustomers() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM customers");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($customers);
}

function getCustomer($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE customer_id = ?");
    $stmt->execute([$id]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($customer);
}

function createCustomer() {
    global $pdo;
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("INSERT INTO customers (full_name, email, mobile, phone, address, city, state, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$data['full_name'], $data['email'], $data['mobile'], $data['phone'], $data['address'], $data['city'], $data['state'], $data['status']])) {
        echo json_encode(['message' => 'New customer created successfully']);
    } else {
        echo json_encode(['error' => 'Failed to create customer']);
    }
}

function updateCustomer($id) {
    global $pdo;
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("UPDATE customers SET full_name = ?, email = ?, mobile = ?, phone = ?, address = ?, city = ?, state = ?, status = ? WHERE customer_id = ?");
    if ($stmt->execute([$data['full_name'], $data['email'], $data['mobile'], $data['phone'], $data['address'], $data['city'], $data['state'], $data['status'], $id])) {
        echo json_encode(['message' => 'Customer updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update customer']);
    }
}

function deleteCustomer($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM customers WHERE customer_id = ?");
    if ($stmt->execute([$id])) {
        echo json_encode(['message' => 'Customer deleted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to delete customer']);
    }
}
?>
