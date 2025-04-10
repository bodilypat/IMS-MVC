<?php
header("Content-Type: application/json");

// Include the database connection
include('dbconnect.php');

// Get the HTTP request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single order by ID
            $id = intval($_GET['id']);
            get_order($id);
        } else {
            // Fetch all orders
            get_orders();
        }
        break;

    case 'POST':
        // Create a new order
        create_order();
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Update an existing order
            update_order($id);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Delete an order
            delete_order($id);
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Get all orders
function get_orders() {
    global $conn;

    $sql = "SELECT * FROM orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($orders) {
        echo json_encode($orders);
    } else {
        echo json_encode(array("message" => "No orders found"));
    }
}

// Get a single order by ID
function get_order($id) {
    global $conn;

    $sql = "SELECT * FROM orders WHERE order_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        echo json_encode($order);
    } else {
        echo json_encode(array("message" => "Order not found"));
    }
}

// Create a new order
function create_order() {
    global $conn;

    // Get input data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['item_id'], $data['customer_id'], $data['order_date'], $data['quantity'], $data['unit_price'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to insert data
    $sql = "INSERT INTO orders (item_id, customer_id, order_date, discount, quantity, unit_price, status)
            VALUES (:item_id, :customer_id, :order_date, :discount, :quantity, :unit_price, :status)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':item_id', $data['item_id']);
    $stmt->bindParam(':customer_id', $data['customer_id']);
    $stmt->bindParam(':order_date', $data['order_date']);
    $stmt->bindParam(':discount', $data['discount']);
    $stmt->bindParam(':quantity', $data['quantity']);
    $stmt->bindParam(':unit_price', $data['unit_price']);
    $stmt->bindParam(':status', $data['status']);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New order created successfully", "order_id" => $conn->lastInsertId()));
    } else {
        echo json_encode(array("message" => "Error creating order"));
    }
}

// Update an existing order
function update_order($id) {
    global $conn;

    // Get input data from PUT request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['item_id'], $data['customer_id'], $data['order_date'], $data['quantity'], $data['unit_price'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to update data
    $sql = "UPDATE orders 
            SET item_id = :item_id, customer_id = :customer_id, order_date = :order_date, discount = :discount, 
                quantity = :quantity, unit_price = :unit_price, status = :status
            WHERE order_id = :id";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':item_id', $data['item_id']);
    $stmt->bindParam(':customer_id', $data['customer_id']);
    $stmt->bindParam(':order_date', $data['order_date']);
    $stmt->bindParam(':discount', $data['discount']);
    $stmt->bindParam(':quantity', $data['quantity']);
    $stmt->bindParam(':unit_price', $data['unit_price']);
    $stmt->bindParam(':status', $data['status']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Order updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating order"));
    }
}

// Delete an order
function delete_order($id) {
    global $conn;

    // Prepare SQL to delete order
    $sql = "DELETE FROM orders WHERE order_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Order deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting order"));
    }
}
?>