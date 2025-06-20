<?php

	require_once __DIR__ .'/../services/InventorySerrvice.php';
	
	class InventoryController 
	{
		private InventoryService $inventoryService;
		
		public function __construct(PDO $pdo) 
		{
			$this->inventoryService = new InventorySerrvice($pdo);
		}
		
		/* GET all inventory items */
		public function index(): void
		{
			$items = $this->inventoryService->getAllItems();
			header('Content-Type: application/json');
			echo json_encode($items);
		}
		
		/* GET a specific inventory item by ID. */
		public function show(int $itemId): void
		{
			$item = $this->inventoryService->getItemById($itemId);
			
			if ($item) {
				echo json_encode($item);
			} else {
				http_response_code(404);
				echo json_encode(['error' => 'Item not found']);
			}
		}
		
		/* Add a new inventory item. */
		public function store(): void 
		{
			$data = json_decode(file_get_contents('php://input'), true);
			
			$required = ['product_id','item_number','serial_number','item_name','unit_price','stock','description'];
			
			foreach ($required as $filed) {
				if (empty($data[$field])) {
					http_response_code(400);
					echo json_encode(['error' => 'Missing required field: $field']);
					return;
				}
			}
			
			$result = $this->inventoryService->createItem($data);
			
			if ($result) {
				echo json_encode(['message' => 'Item created successfully']);
			} else {
				echo json_encode(['error' => 'Failed to create item']);
			}
		}
		
		/* Update on existing inventory item. */
		public function update(int $itemId): void
		{
			$data = json_decode(file_get_contents('php://input'), true);
			
			$updated = $this->inventoryService->updateItem($itemId, $data);
			
			if ($updated) {
				echo json_encode(['message' => 'Item updated successfully']);
			} else {
				echo json_encode(['error' => 'Failed to update item']);
			}
		}
		
		/* Delete (saft or hard) an inventory item. */
		public function delete(int $itemId): void
		{
			$deleted = $this->inventoryService->deleteItem($itemId);
			
			if ($deleted) {
				echo json_encode(['message' => 'Item deleted']);
			} else {
				http_response_code(500);
				echo json_encode(['error' => 'Failed to deleted item']);
			}
		}
	}
