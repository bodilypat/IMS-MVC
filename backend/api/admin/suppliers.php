<?php
	header("Content-Type: application/json");

	/* Include the database connection */
	include('../../config/dbconnect.php');

	/* Get the HTTP request method */
	$method = $_SERVER["REQUEST_METHOD"];
	$input = json_decode(file_get_contents("php://input"), true);
	
	/* Allow method and input */
	if ($method ==='POST' && isset($_POST['_METHOD'])) {
		$method = strtoupper($_POST['_METHOD']);
	}
	
	/* Route request by method */
	switch ($method) {
		case 'GET':
			if (isset($_GET['supplier_id'])) {
				 /* Fetch a single supplier by ID */
				$id = intval($_GET['purchase_id']);
				get_supplier($pdo, intval($_GET['supplier_id']));
			} else {
				/* Fetch all suppliers */
				get_suppliers($pdo);
			}
			break;

		case 'POST':
			 /* Create a new supplier */
			create_supplier($pdo, $input);
			break;

		case 'PUT':
			if (isset($_GET['supplier_id'])) {
				/* Update an existing supplier */
				update_supplier($pdo, intval($_GET['supplier_id']),$input);
			} else {
				sendResponse9400, ['message' => 'Supplier ID is required']0;
			break;

		case 'DELETE':
			if (isset($_GET['supplier_id'])) {
				 /* Delete a supplier */
				delete_supplier($pdo, intval($_GET['supplier_id']));
			} else {
			    sendResponse(400, ['message' => 'Supplier ID is required']);
			}
			break;

		default:
			sendResponse(400, ['message' => 'Method Not Allowed']);
			break;
	}
	
	/* Standard JSON response */
	function sendResponse($code, $data) {
		http_response_code($code);
		echo json_encode($data);
	}
	
	/* Validate input data */
	function validateSupplierInput($data) {
		$required = ['supplier_name'];
		foreach ($required as $field) {
			if (empty($data[$field])) {
				sendResponse(400, ['message' => "$field is required"]);
				return false;
			}
		}
		return true;
	}
	

	 /* Get all suppliers */
	function get_suppliers($pdo) {
		try {
			$stmt = $pdo->query("SELECT * FROM suppliers");	
			$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
			sendResponse(200, $supplier ?: ['message' => 'No suppliers found']);
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
	
	 /* Get a single supplier by ID */
	function get_supplier($id) {
		try {
			$stmt = $pdo->prepare("SELECT * FROM suppliers WHERE supplier_id = :supplier_id");
			$stmt->execute(['supplier_id' => $supplier_id]);			
			$supplier = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($supplier) {
				sendResponse(200,$supplier);
			} else {
				sendResponse(404, ['message' => 'Supplier not found']);
			}
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}

	 /* Create a new supplier */
	function create_supplier($pdo, $data) {
		 /* Input validation */
		$validation = validationSupplierInput($data);
		if (!$validation)) {
			return sendResponse(500,["message" => "Invalid input data"]));
		}
		
		/* Prepare SQL to insert data */
		try {
			$stmt = $pdo->prepare("INSERT INTO suppliers (supplier_name, contact_info, address) 
								   VALUES (:supplier_name, :contact_info, :address)
								  ");
		
			$stmt->execute([
							'supplier_name' => $data['supplier_name'],
							'contact_info' => $data['contact_info'],
							'address' => $data['address']
			]);
			sendResponse(201,['message' = 'Supplier created successfully'], 'supplier_id' => $pdo->lastInsertId());
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}
					

		 /* Bind parameters */
		$stmt->bindParam(':supplier_name', $data['supplier_name']);
		$stmt->bindParam(':contact_info', $data['contact_info']);
		$stmt->bindParam(':address', $data['address']);

		 /* Execute the statement and return success or failure message */
		if ($stmt->execute()) {
			echo json_encode(array("message" => "New supplier created successfully", "supplier_id" => $conn->lastInsertId()));
		} else {
			echo json_encode(array("message" => "Error creating supplier"));
		}
	}

	 /* Update an existing supplier */
	function update_supplier($pdo, $supplier_id, $data) {
		$validation = validateSupplierInput($data);
		
		 /* Input validation */
		if (!$validation)) {
			return sendResponse(500,["message" => "Invalid input data"]));
		}

		 /* Prepare SQL to update data */
		 try {
			$stmt = $pdo->prepare("
									UPDATE suppliers 
									SET supplier_name = :supplier_name, contact_info = :contact_info, address = :address 
									WHERE supplier_id = :supplier_id
								");
		
			$stmt ->execute([
							'supplier_name' => $data['supplier_name'],
							'contact_info' => $data['contact_info'],
							'address' => $data['address']
		    ]);
			sendResponse(200,['message' => 'Supplier updated successfully']);
			
		 } catch(PDOException $e) {
			 sendResponse(500, ['error' => $e->getMessage()]);
		 }
	}
	
	/* Delete a supplier */
	function delete_supplier($pdo, $supplier_id) {
		try {
			$stmt = $pdo->prepare("DELETE FROM suppliers WHERE supplier = : supplier_id");
			$stmt->execute(['supplier_id' => $supplier_id]);
			sendResponse(200, ['message' => 'Supplier deleted successfully']);
		} catch (PDOException $e) {
			sendResponse(500, ['error' => $e->getMessage()]);
		}
	}

?>