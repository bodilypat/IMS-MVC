<?php
	require_once __DIR__ .'/../services/InventoryService.php';
	
	class OrderController 
	{
		private PDO $db;
		
		private InventoryService $inventoryService;
		
		public function __construct(PDO $pdo) 
		{
			$this->db = $pdo;
			$this->inventoryService = new InventoryService($pdo);
		}
		
		/* List all orders. */
		public function index(): void 
		{
			$stmt = $this->db->query("SELECT * FROM orders ORDER BY created_on DESC");
			$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
			header('Content-Type: application/json');
			echo json_encode($orders);
		}
		
		/* Get a single order by ID. */
		public function show(int $orderId): void
		{
			$stmt = $this->db->prepare("SELECT * FROM orders WHERE order_id = :id");
			$stmt->execute(['id' => $orderId]);
			$order = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($order) {
				echo json_encode($order);;
			} else {
				http_response_code(404);
				echo json_encode(['error' => 'Order not found']);
			}
		}
		
		/* Create a new order. */
		public function store(): void 
		{
			$data = json_decode(file_get_contents("php://input"), true);
			
			if (!isset($data['item_id'], $data['customer_id'], $data['quantity'], $data['unit_price']))
			{
				htp_response_code(400);
				echo json_encode(['error' => 'Missing required fields']);
				return;
			}
			
			$itemId = (int) $data['item_id'];
			$quantity = (int) $data['quantity']);
			
			/* Check stock */
			if (!this->inventoryService->hasSufficientStock($itemId, $quantity)) {
				http_response_code(409);
				echo json_encode(['error' => 'Insufficient stock']);
				return;
			}
			
			/* Insert order */
			$sql = "INSERT INTO orders (item_id, customer_id, order_date, discount, quantity, unit_price, status)
				    VALUES (:item_id, :customer_id, CRUDATE(), :discount, :quantity, :unit_price, 'Pending')";
			
			$stmt = $this->db->prepare($sql);
			$success = $this->execute([
				'item_id' => $itemId,
				'customer_id' => (int) $data['customer_id'],
				'discount' => $data['discount'] ?? 0.00,
				'quantity' => $quantity,
				'unit_price' => $data['unit_price']
			]);
			
			if ($success) {
				$this->inventoryService->updateStock($itemId, -$quantity); // reduce stock
				echo  json_encode(['message' => 'Order created successfully']);
			} else {
				http_response_code(5000;
				echo json_encode(['error' => 'Failed to create order']);
			}
		}
		
		/* Update order status */
		public function updateStatus(int $orderId): void 
		{
			$data = json_decode(file_get_content("php://inpu"), true);
			$allowedStatus = ['Pending','Completed','Cancelled'];
			
			if (!isset($data['status']) || !in_array($data['status'], $allowedStatus)) {
				http_response_code(400);
				echo json_encode(['error' => 'Invalid status']);
				return;
			}
			
			$sql = "UPDATE orders SET status = :status WHERE order_id = :id";
			$stmt = $this->db->prepare($sql);
			$updated = $stmt->execute([
				'status' => $data['status'],
				'id' => $orderId
			]);
			
			if ($updated) {
				echo json_encode(['message' => 'Order status updated']);
			} else {
				http_response_code(500);
				echo json_encode(['error' => 'Failed to update order']);
			}
		}
	}
	