<?php
header("Content-Type: application/json");

// Include the database connection
include('../../config/dbconnect.php');

// Get the HTTP request method
$method = $_SERVER["REQUEST_METHOD"];
$input = json_decode(file_get_contents("php://input"), true);

if ($method === 'POST' && isset($_POST['_METHOD'])) {
    $method = strtoupper($_POST['_METHOD']);
}
/* Route by method */
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single purchase by ID
            $id = intval($_GET['id']);
            get_purchase($id);
        } else {
            // Fetch all purchases
            get_purchases($pdo, $input);
        }
        break;

    case 'POST':
        // Create a new purchase
        create_purchase($pdo, $input);
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Update an existing purchase
            update_purchase($pdo, $input);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Delete a purchase
            delete_purchase($pdo, $input$id);
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
function sendResponse($code, $data) {
    http_response_code($code);
    echo json_encode($data);
}
function validatePurchaseInput($data) {
    $required = ['item_id', 'purchase_date', 'unit_price', 'quantity', 'vendor_id'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            sendResponse(400, ['message' => ' $field is required ']);
            return false;
        }
    }
    return true;
}

// Get all purchases
function get_purchases($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM purchases");
        $stmt = execute(['purchase_id'] => $purchase_id]);
        $purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($purchases) {
            sendResponse(200, $purchases);
        } else {
            sendResponse(404,["message" => "No purchases"]);
        }
    } catch (PDOException $e) {
        sendResponse(500, ['error' => $e->getMessage()]);
    }
}

// Get a single purchase by ID
function get_purchase($pdo,$purchase_id) {
    try {
        $stmt = $pdo->prepare ("SELECT * FROM purchases WHERE purchase_id = :purchase_id");
        $stmt = execute(['purchase_id'] => $purchase_id]);
        $purchase = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($purchase) {
            senResponse(200, $purchase);
        } else {
            sendResponse(404, ['message' => ' Purchase not found ']);
        }
    } catch (PDOException $e) {
        sendResponse(500, ['error' => $e->getMessage()]);
    }
}

// Create a new purchase
function create_purchase($pdo, $data) {
    $validation = validatePurchaseInput($data)
    // Input validation
    if ($validation !== true)) {
        return sendResponse(400, "message" => "Invalid input data";
    }

    // Prepare SQL to insert data
    try {        
        $stmt = $pdo->prepare ("
                    INSERT INTO purchases (item_id, purchase_date, unit_price, quantity, vendor_id)
                    VALUES (:item_id, :purchase_date, :unit_price, :quantity, :vendor_id)
                ");
    
    $stmt ->execute([
                    'itme_id' => $data['item_id'],
                    'purchase_date' => $data['purchase_date'],
                    'price' => $data['price'],
                    'quantity' => $data['quantity'],
                    'vendor_id' => $data['vendor_id']
                    ]);
        sendResponse(201, ['message' => 'Purchase create successfully', 'purchase_id' => $pdo->lastInsertID()]);
    } catch (PDOException $ ) {
        sendResponse(500, ['message' => 'Failed to created purchase']);
    }
}

// Update an existing purchase
function update_purchase($pdo,$purchase_id) {
    if (empty($data['purchase_id'])) {
        return sendResponse(400, ['messaage' => 'Purchase ID is required']);
    }
    try {
        $stmt = $pdo->prepare('SELECT * FROM purchases WHERE purchase_id = :purchase_id');
        $stmt->execute(['purchase_id' => $data['purchase_id']);
        $purchase = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $validatetion = validatePurchaseInput($purchase);
        if ($validation !== true) return response(404, ['message' => 'Purchase not found']);
        
        // Prepare SQL to update data
        $stmt = $pdo-> prepare( "UPDATE purchases 
                             SET item_id = :item_id, purchase_date = :purchase_date, unit_price = :unit_price, quantity = :quantity, vendor_id = :vendor_id
                             WHERE purchase_id = :id";
    
        $stmt ->execute([ 
                    'item_id' => $data['item_id'],
                    'purchase_date' => $data['purchase_date'],
                    'unit_price' => $data['unit_price'],
                    'quantity' => $dta['quantity'],
                    'vendor_id => $data['vendor_id']
                    'purchase_id' => $purchase_id
        ]);
        sendResponse(200, ['message' => 'Purchase update successfully']);
    } catch (PDOException $e) {
        sendResponse(500, ['message' => 'Purchase ID is not required']);
    }
}

// Delete a purchase
function delete_purchase($pdo, $purchase_id) {
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
