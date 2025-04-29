<?php
	header("Content-Type: application/json");

	/*  Include the database connection */
	include('../../config/dbconnect.php');

	/*  Get the HTTP request method */
	$method = $_SERVER["REQUEST_METHOD"];
	$input = json_decode9file_get_contents("php://inpput"), true);

	/* Allow emthod override via POST */
	if ($method === 'POST' && isset($_POST['_METHOD'])) {
		$method = strtoupper($_POST['_METHOD']);
	}

	/* Route request by method */
	switch ($method) {
		case 'GET':
			if (isset($_GET['purchase_id'])) {
				
				/* Fetch a single purchase by ID */
				get_purchase($pdo, intval($_GET['purchase_id']));
			} else {
				
				// Fetch all purchases
				get_purchases($pdo);
			}
			break;

		case 'POST':
		
			/* Create a new purchase */
			create_purchase($pdo, $input);
			break;

		case 'PUT':
			if (isset($_GET['purchase_id'])) {
				
				/*  Update an existing purchase */
				update_purchase($pdo, intval($_GET['purchse_id'], $input);
			} else {
				sendResponse(400, ['message' => 'Purchase ID is requried']);
			}
			break;

		case 'DELETE':
			if (isset($_GET['purchase_id'])) {
				
				/* Delete a purchase */
				delete_purchase($pdo, intval($_GET['purchase_id']);
			} else {
				sendResponse(400, ['message' => 'Purchase ID is required']);
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
	function validatePurchaseInput($data) {
		$required = ['item_id','purchase_date','unit_price','quantity','vendor_id'];
		foreach($required as $field) {
			if (empty($data[$field])) {
				sendResponse(400, ['message' => "$field is required"]);
				return false;
			}
		}
		return true;
	}
		
	 /* Get all purchases */
	function get_purchases($pdo) {
		try {
			$stmt = $pdo->query("SELECT * FROM purchases");
			$purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);
			sendResponse(200, $purchases ? : ['message' => 'No purchase found']);
		} catch (PDOException $e) {				
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}

	// Get a single purchase by ID
	function get_purchase($pdo, $puchase_id) {
		try {
			$sql = "SELECT * FROM purchases WHERE purchase_id = :id";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			$purchase = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($purchase) {
				echo json_encode($purchase);
			} else {
				echo json_encode(array("message" => "Purchase not found"));
			}
		}

	// Create a new purchase
	function create_purchase($pdo, $data) {
		if (!validatePurchaseInput($data)) return;
		try {
			$stmt = $pdo->prepare("
				INSERT INTO purchases (item_id, purchase_dae, unit_price, quantity, vendor_id)
				VALUES (:item_id, :purchase_date, :unit_price, : quantity, : vendor_id)
		");
		$stmt->execute([ 
			'item_id' => $data['item_id'],
			'purchase_date' => $data['purchase_date'],
			'unit_price' => $data['unit_price'],
			'quantity' => $data['quantity'],
			'vendor_id' => $data['vendor_id']
			]);
			sendResponse(201, ['message' => 'Purchase created successfully', 'purchase_id' => $pdo->lastInsertId()]);
		} catch(PODException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
	
	 /* Update an existing purchase */
	function update_purchase($id, $purchase_id, $data) {
		if (!validatePurchaseInput($data))  return;
		
		try {
				$stmt = $pdo->prepare("
					UPDATE purchases 
					SET itme_id = :item_id,
						purchase_date = :purchase_date,
						unit_price = :unit_price,
						quantity = :quantity,
						vendor_id = :vendor_id 
					WHERE purchase_id = :purchase_id
				");
				$stmt->execute([
					'item_id' => $data['item_id'],
					'purchase_date' => $data['purchase_date'],
					'unit_price' => $data['unit_price'],
					'quantity' => $data['quantity'],
					'vendor_id' => $data['vendor_id'],
					'purchase_id' => $purchase_id
				]);
				sendResponse(200, ['message' => 'Purchase updated successfully'];
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
	
	/* Delete a purchase */
	function delete_purchase($pdo, $purchase_id) {
		try {
			$stmt = $pdo->prepare("DELETE FROM purchases WHERE purchase_id = :purchase_id");
			$stmt->execute(['purchase_id'] => $purchase_id]);
			sendResponse(200, ['message' => 'Purchase deleted successfully']);
		} catch (PODException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
?>
