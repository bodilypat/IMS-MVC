<?php
header("Content-Type: application/json");

// Include the database connection
include('dbconnect.php');

// Get the HTTP request method
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch a single user by ID
            $id = intval($_GET['id']);
            get_user($id);
        } else {
            // Fetch all users
            get_users();
        }
        break;

    case 'POST':
        // Create a new user
        create_user();
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Update an existing user
            update_user($id);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            // Delete a user
            delete_user($id);
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Get all users
function get_users() {
    global $conn;

    $sql = "SELECT * FROM `user`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($users) {
        echo json_encode($users);
    } else {
        echo json_encode(array("message" => "No users found"));
    }
}

// Get a single user by ID
function get_user($id) {
    global $conn;

    $sql = "SELECT * FROM `user` WHERE `user_id` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(array("message" => "User not found"));
    }
}

// Create a new user
function create_user() {
    global $conn;

    // Get input data from POST request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['fullName']) || !isset($data['username']) || !isset($data['password'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // Prepare SQL to insert data
    $sql = "INSERT INTO `user` (`fullName`, `username`, `password`, `status`) 
            VALUES (:fullName, :username, :password, :status)";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':fullName', $data['fullName']);
    $stmt->bindParam(':username', $data['username']);
    $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT)); // Hash the password
    $stmt->bindParam(':status', $data['status']);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "New user created successfully", "user_id" => $conn->lastInsertId()));
    } else {
        echo json_encode(array("message" => "Error creating user"));
    }
}

// Update an existing user
function update_user($id) {
    global $conn;

    // Get input data from PUT request
    $data = json_decode(file_get_contents("php://input"), true);

    // Input validation
    if (!isset($data['fullName']) || !isset($data['username'])) {
        echo json_encode(array("message" => "Invalid input data"));
        return;
    }

    // If password is provided, hash it before updating
    $password_sql = "";
    if (isset($data['password']) && !empty($data['password'])) {
        $password_sql = ", `password` = :password";
    }

    // Prepare SQL to update data
    $sql = "UPDATE `user` 
            SET `fullName` = :fullName, `username` = :username $password_sql, `status` = :status
            WHERE `user_id` = :id";
    
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':fullName', $data['fullName']);
    $stmt->bindParam(':username', $data['username']);
    if (isset($data['password']) && !empty($data['password'])) {
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));
    }
    $stmt->bindParam(':status', $data['status']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "User updated successfully"));
    } else {
        echo json_encode(array("message" => "Error updating user"));
    }
}

// Delete a user
function delete_user($id) {
    global $conn;

    // Prepare SQL to delete user
    $sql = "DELETE FROM `user` WHERE `user_id` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement and return success or failure message
    if ($stmt->execute()) {
        echo json_encode(array("message" => "User deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error deleting user"));
    }
}
?>