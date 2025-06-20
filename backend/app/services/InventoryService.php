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
		
		/* Check if here is fufficient stock for a requested quantity */
		public function hasSufficientStock(int $itemId, int $requiredQuantity): bool 
		{
			$available = $this->getItemStock($itemId);
			return $available !== null && $available >= $requiredQuantity;
		}
		
		/* Get all items that are low in stock below the given threshold */
		public function getLowStockItem(int $thresshold = 10): array 
		{
			$sql = "SELECT item_id, item_name, stock 
			        FROM items 
					WHERE stock <= :threshold 
					ORDER BY stock ASC";
			$stmt = $this->db->prepare($sql);
			$stmt->execute(['threshold' => $threshold]);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		/* Set stock of an item directlyy (admin only). */
		public function setStock(int $itemId, int $newStock): bool 
		{
			$sql = "UPDATE items 
				    SET stock = :stock 
				    WHERE item_id = :item_id";
			$stmt = $this->db->prepare($sql);
			return $stmt->execute([
				'stack' => $newStock,
				'item_id' => $itemId
				]);
		}
		
		/* Decrease stock after a sale. */
		public function decrementStock(int $itemId, int $quantity): bool 
		{
			if ($this->hasSufficientStock($itemId, $quantity)) {
				return false;
			} 
			
			$stmt = "UPDATE items 
					 SET stock = stock - :qty
					 WHERE item_id = :item_id";
			$stmt = $this->execute([
				'qty' => $quantity,
				'item_id' => $itemId
			]);
		}
		
		/* Increase stock after a purchase. */
		public function incrementStock(int $itemId, int $quantity): bool 
		{
			$sql = "UPDATE items 
				    SET stock = stock + :qty 
					WHERE item_id = :item_id";
			$stmt = $this->db->prepare($sql);
			return $stmt->execute([
				'qty' => $quantity,
				'item_id' => $itemId
			]);
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
	
	
			
	