<?php
	header("Content-Type: application/json");

	/* Include the database connection */
	include('../../config/dbconnect.php');

	 /* Get the HTTP request method */
	$method = $_SERVER["REQUEST_METHOD"];
	$input = json_decode(file_get_contents("php://input"), true);

	/* Allow method override via POST */
	if ($method === 'POST' && isset($_POST['_METHOD'])) {
		$method = strtoupper($_POST['_METHOD']);
	}

	/* Route request by method */
	switch ($method) {
		case 'GET':
			if (isset($_GET['id'])) {
				
				/* Fetch a single order by ID */
				get_order($ipdo, intval($_GET['order_id']));
			} else {
				/* Fetch all orders */
				get_orders($pdo);
			}
			break;

		case 'POST':
			 /* Create a new order */
			create_order($pdo, $input);
			break;

		case 'PUT':
			if (isset($_GET['order_id'])) {
				 /* Update an existing order */
				update_order($pdo, intval($_GET['order_id'], $input);
			} else {
				sendResponse(400, ['message' => 'Order ID is required']);
			break;

		case 'DELETE':
			if (isset($_GET['order_id'])) {
				/* Delete an order */
				delete_order($$pdo, intval($_GET['order_id']));
			} else {
				sendResponse(400, ['message' => 'Order ID is required']);
			}
			break;

		default:
			sendResponse(405, ['message' => 'Method Not Allowed']);
			break;
	}
	
	/* Standard JSON response */
	function sendResponse($code, $data) {
		http_response_code($code);
		echo json_encode($data);
	}

	/* Validate input data */
	function validateOrderInput($data) {
		$required = ['item_id', 'customer_id', 'order_date', 'quantity', 'unit_price'];
		foreach ($required as $field) {
			if (empty($data[$field])) {
				sendResponse(400, ['message' => '$field is required']);
				return false;
			}
		}
		return true;
	}
	
	 /* Get all orders */
	function get_orders($pdo) {
		try {
			$stmt = $pdo->query("SELECT * FROM orders");
			$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
			sendResponse(200, $orders ?: ['message' => 'No Orders found']);
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
	
	/*  Get a single order by ID */
	function get_order($pdo, $order_id) {
		try {
			$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = :order_id");
			$stmt->execute(['order_id' => $purchase_id]);
			$order = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($order) {
				sendResponse(200, $order);
			} else {
				sendResponse(404, ['message' => 'Order not found']);
			}
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
	

	 /* Create a new order */
	function create_order($pdo, $data) {

		 /* Input validation */
		if (!validateOrderInput($data)) return;

		 /* Prepare SQL to insert data */
		 try {			 
			$stmt = $pdo->prepare("
				         INSERT INTO orders (item_id, customer_id, order_date, discount, quantity, unit_price, status)
						 VALUES (:item_id, :customer_id, :order_date, :discount, :quantity, :unit_price, :status)
						");
			$stmt->execute([
						'item_id' => $data['item_id'],
						'customer_id' => $data['customer_id'],
						'order_date' => $data['order_date'],
						'discount' => $data['discount'] ?? 0,
						'quantity' => $data['quantity'],
						'unit_price' => $data['unit_price'],
						'status' => $data['status'] ?? 'pending'
					]);
					sendResponse(201, [
							'message' => 'Order created successfully',
							'order_id' => $pdo->lastInsertId()
						]);
		 } catch (PDOException $e) {
			 sendResponse(500, ['error' => $e->getMessage()]);
		 }
	}

	 /* Update an existing order */
	function update_order($pdo, $order_id, $data) {
		
		 /* Input validation */
		if (!validateOrderInput($data)) return;
		try {

			/* Prepare SQL to update data */
			$stmt = $pdo->prepare("UPDATE orders 
							   SET item_id = :item_id, customer_id = :customer_id, order_date = :order_date, discount = :discount, 
								   quantity = :quantity, unit_price = :unit_price, status = :status
							   WHERE order_id = :order_id");
			$stmt->execute([
				'item_id' => $data['item_id'],
				'customer_id' => $data['customer_id'],
				'order_date' => $data['order_date'],
				'discount' => $data['discount'] ?? 0,
				'quantity' => $data['quantity'],
				'unit_price' => $data['unit_price'],
				'status' => $data['status'] ?? 'pending',
				'order_id' => $order_id
				]);
				sendResponse(200, ['message' => 'Order updated successfully']);
		} catch (PDOException $e ) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
	
	 /* Delete an order */
	function delete_order($pdo, $order_id) {
		try {
			
			/* Prepare SQL to delete order */
			$stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = :order_id");
			$stmt->execute(['order_id' => $order_id]);
			sendResponse(200, ['message' => 'Order deleted successfully']);
		} catch (PDOException $e0 {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
?>