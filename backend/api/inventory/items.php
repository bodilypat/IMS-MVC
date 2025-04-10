<?php
header("Content-Type: application/json");

// Include the database connection
include('dbconnect.php');

// Get the HTTP request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single item by ID
            $id = intval($_GET['id']);
            get_item($id);
        } else {
            // Fetch all items
            get_items();
        }
        break;

    case 'POST':
        // Create a new item
        create_item();
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Update an existing item
            update_item($id);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Delete an item
            delete_item($id);
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Get all items
function get_items() {
    global $conn;

    $sql = "SELECT * FROM items";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($items) {
        echo json_encode($items);
    } else {
        echo json_encode(array("message" => "No items found"));
    }
}

// Get a single item by ID
function get_item($id) {
    global $conn;

    $sql = "SELECT * FROM items WHERE item_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        echo json_encode($item);
    } else {
        echo json_encode(array("message" => "Item not found"));
    }
}

// Create a new item
function create_item() {
    global $conn;

    // Get input data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['item_number'], $data['product_id'], $data['item_name'], $data['description'], $data['unit_price'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to insert data
    $sql = "INSERT INTO items (item_number, product_id, item_name, discount, stock, unit_price, image_url, status, description)
            VALUES (:item_number, :product_id, :item_name, :discount, :stock, :unit_price, :image_url, :status, :description)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':item_number', $data['item_number']);
    $stmt->bindParam(':product_id', $data['product_id']);
    $stmt->bindParam(':item_name', $data['item_name']);
    $stmt->bindParam(':discount', $data['discount']);
    $stmt->bindParam(':stock', $data['stock']);
    $stmt->bindParam(':unit_price', $data['unit_price']);
    $stmt->bindParam(':image_url', $data['image_url']);
    $stmt->bindParam(':status', $data['status']);
    $stmt->bindParam(':description', $data['description']);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New item created successfully", "item_id" => $conn->lastInsertId()));
    } else {
        echo json_encode(array("message" => "Error creating item"));
    }
}

// Update an existing item
function update_item($id) {
    global $conn;

    // Get input data from PUT request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['item_number'], $data['product_id'], $data['item_name'], $data['description'], $data['unit_price'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to update data
    $sql = "UPDATE items 
            SET item_number = :item_number, product_id = :product_id, item_name = :item_name, discount = :discount, 
                stock = :stock, unit_price = :unit_price, image_url = :image_url, status = :status, description = :description
            WHERE item_id = :id";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':item_number', $data['item_number']);
    $stmt->bindParam(':product_id', $data['product_id']);
    $stmt->bindParam(':item_name', $data['item_name']);
    $stmt->bindParam(':discount', $data['discount']);
    $stmt->bindParam(':stock', $data['stock']);
    $stmt->bindParam(':unit_price', $data['unit_price']);
    $stmt->bindParam(':image_url', $data['image_url']);
    $stmt->bindParam(':status', $data['status']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Item updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating item"));
    }
}

// Delete an item
function delete_item($id) {
    global $conn;

    // Prepare SQL to delete item
    $sql = "DELETE FROM items WHERE item_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Item deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting item"));
    }
}
?>
