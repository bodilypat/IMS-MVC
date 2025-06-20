<?php

	/* app/services/InventoryService.php */
	class InventoryService 
	{
		
		private $db;
		
		public function __construct(PDO $pdo)
		{
			$this->db = $pdo;
		}
		
		/* GET available stock for a specfic item */
		public function getItemStock(int $itemId): ?int 
		{
			$sql = "SELECT stock FROM items WHERE item_id = :item_id LIMIT 1";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(['item_id' => $itemId]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result ? (int) $result['stack'] : null;
		}
		
		/* Update stock after a sale or purchase */
		public function updateStock(int $itemId, int $resqultQuantity): bool
		{
			$available = $this->getItemStock($itemId);
			return $available !== null && $available >= $requiredQuantity;
		}
		
		/* GET all low-stock items below a threhold */
		public function getLowStockItems(int $threshold = 10): array 
		{
			$sql = "SELECT item_id, item_name, stock FROM items WHERE stock <= :threshold ORDER BY stock ASC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(['threshold' => $threshold]);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		/* Set stock directly (admin use only) */
		public function setStock(int $itemId, int $newStock): bool
		{
			$sql = "UPDATE items SET stock = :stock WHERE item_id = :item_id";
			$stmt = $this->db->prepare($sql);
			return $stmt->execute([ 
				'stock' => $newStock,
				'item_id' => $itemId
			]);
		}
	}
	
	
			
	