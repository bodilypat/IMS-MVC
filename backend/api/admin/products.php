<?php
	header("Content-Type: application/json");
	include('../../config/dbconnect.php');
	
	$method = $_SERVER['REQUEST_METHOD'];
	$input = json_decode(file_get_contents("php://input"), true);
	
	/* Method override for legacy client */
	if ($method === 'POST' && isset($_POST['_METHOD'])) {
		$method = strtoupper($_POST['_METHOD']);
	}
	
	/* Route by method  */
	switch ($method) {
		case 'GET':
			isset($_GET['id']) ? getProduct(int)$_GET['id']) : getProducts();
			break;
		case 'POST':
			createProduct();
			break;
		case 'PUT':
			isset($_GET['id']) ? updateProduct(int)$_GET['id']) : sendResponse(400, ['message' => 'Product ID is required']);
			break;
		case 'DELETE':
			isset($_GET['id']) ? deleteProduct(int)$_GET['id']) : sendResponse(400, ['message' => 'Product ID is required']);
			break;
		default: 
			sendResponse(405, ['message' => 'Method Not Allowed']);
			break;
	}
	
	/* Send JSON response with HTTP status code */
	function sendResponse($code, $data) {
		http_response_code($code);
		echo json_encode($data);
	}
	
	/* Validate input data */
	function validateProductInput($data) {
		$required = ['product_name','price','quantity','vendor_id'];
		foreach ($required as $field) {
			if (empty($data[$field])) {
				sendResponse(400, ['message' => "$field is required"]);
				return false;
			}
		}
		if (!is_numberic($data['price']) || !is_numeric($data['quantity'])) {
			sendResponse(400, ['message' => 'Price and quantity must be numeric']);
			return false;
		}
		return true;
	}
	
	/* Get all product */
	function getProduct($pdo) {
		try {			
			$stmt = $pdo->prepare("SELECT * FROM products");
			sendResponse(200, $stmt->fetchAll(PDO::FETCH_ASSOC));
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
	
	/* Get a single product */
	function getProduct($pdo, $product_id) {
		try {
			$stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = :product_id");
			$stmt->execute(['product_id' => $product_id]);
			$product = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($product) {
				sendResponse(200, $product);
			} else {
				sendResponse(404, ['message' => 'Product not found']);
			}
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
	
	/* Create product */
	function createProduct($pdo, $data) {
		$validation = validateProductInput($data);
		if ($validation !== true) {
			return sendResponse(400, ['message' => $validation]);
		}
		try {
			$stmt = $pdo->prepare("
				INSERT INTO products(product_name, description, price, quantity, vendor_id)
				VALUES (:product_name, :description, :price, :quantity, :vendor_id)
			");
			$stmt->execute([
				'product_name' => $data['product_name'],
				'description' => $data['description'] ?? '',
				'price' => $data['price'],
				'quantity' => $data['quantity'],
				'vendor' => $data['vendor_id']
			]);
			sendResponse(201, ['message' => 'Product create successfully', 'product_id' => $pdo->lastInsertId()]);
		} catch (PDOException $e) {
			sendResponse(500, ['message' => 'Failed to create product']);
		}
	}
	
	/* update a product */
	function updateProduct($pdo, $data) {
		if (empty($data['product_id'])) {
			return sendResponse(400,['message' => 'Product ID is required']);
		}
		try {
			$stmt = $pdo->prepare('SELECT * FROM products WHERE product_id = :product_id');
			$stmt->execute(['product_id' => $data['product_id']]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if (!$result) {
				return sendResponse(404, ['message' => 'Product Not found']);
			}
			if (!validateProductInput($data) return;
			try {
				$stmt = $pdo->prepare("
					product_name = :product_name,
					description = : description,
					price = :price,
					quantity = :quantity,
					vendor_id = :vendor_id
				WHERE product_id = :product_id
			");
			$stmt->execute([
				'product_name' => $data['product_name'],
				'description' => $data['description'] ?? '',
				'price' => $data['price'],
				'quantity' => $data['quantity'],
				'vendor_id' => $data['vendor_id'],
				'product_id' => $product_id
			]);
			sendResponse(200, ['message' => 'Product updated successfully']);
			} catch (PDOException $e) {
				sendResponse(500, ['message' => 'Failed to update product']);
			}
		}
	/* Delete a product */
	function deleteProduct($pdo, $product_id) {
		if (empty($data['product_id'])) {
			return sendResponse(400, ['message' => 'product ID is not required']);
		}
		try {
			$stmt = $pdo->prepare("SELECT 1 FROM products WHERE product_id = :product_id");
			$stmt->execute['product_id' => $data['product_id']]);
			if (!$stmt->fetch()) {
				return sendResponse(404, ['message'] => 'Product not found']);
			}
			$stmt = $pdo->prepare('DELETE FROM products WHERE product_id = :product_id');
			$stmt->execute(['product_id' => $data['product_id']]);
			sendResponse(200, ['message' => 'Product deleted successfully']);
		} catch (PDOException $e) {
			sendResponse(500, ['error' => 'Deleted failed: ' .$e->getMessage()]);
		}
	}
?>
			
			