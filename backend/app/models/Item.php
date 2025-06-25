<?php

	namespace App\Models;
	
	use PDO;
	use PDOException;
	
	class Item 
	{
		private PDO $db;
		private string $table = 'items';
		
		/* Get all items with optional filters */
		public function findAll(array $filters = []):array 
		{
			try {
				$sql = "SELECT * FROM items WHERE 1=1";
				$params = [];
				
				if (empty($filter['status'])) {
					$sql .= " AND status = :status";
					$params['status'] = $filters['status'];
				}
				
				if (!empty($filter['search'])) {
					$sql .= " AND (item_name LIKE :search OR item_number LIKE :search)";
					$params['search'] = '%' . $filter['search'] . '%';
				}
				
				$sql .= "ORDER BY item_id DESC";
				$stmt = $this->db->prepare($sql);
				$stmt->execute($params);
				
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("Item::findById -" . $e->getMessage());
				return null;
			}
		}
		
		/* Insert a new item */
		public function insert(array $data): int|false
		{
			try {
				$stmt = $this->db->prepare("
					INSERT INTO items
						(product_id, item_number, serial_number, item_name, discount, stock, unit_price, status, description)
					VALUES
						(:product_id, :item_number, :serial_number, :item_name, :discount, :stock, :status, :description)
					");
				$stmt->execute([
					'product_id' => $data['product_id'],
					'item_number' => $data['item_number'],
					'serial_number' => $data['serial_number'],
					'item_name' => $data['item_name'],
					'discount' => $data['discount'] ?? 0.00,
					'stock' => $data['stock'] ?? 0,
					'unit_price' => $data['unit_price'] ?? 0.00,
					'image_url'=> $data['image_url'] ?? 'imageNotAvailable.jpg';
					'status' => $data['status'] ?? 'Action',
					'description' => $data['description'],
				]);
			    return (int)$this->db->lastInsertId();
			} catch (PDOException $e) {
				error_log("Item:insert - " . $e->getMessage());
				return false;
			}
		}
		
		/* Update on item by ID */
		public function update(int $id, array $data): bool 
		{
			try {
				$fields = [];
				$params = [];
				foreach ($data as $key => $value) {
					$fields[] = "$key = :$key";
					$params[$key] = $value;
				}
				$params['item_id'] = $id;
				
				$sql = "UPDATE items SET " . implode(",", $fields) . "WHERE item_id =:item_id ";
				$stmt = $this->db->prepare($sql);
				return $stmt->execute($params);
			} catch (PDOException $e) {
				error_log("Item::update - " . $e->getMessage());
				return false;
			}
		}
		
		/* Delete an item by ID */
		public function delete(int $id): bool
		{
			try {
				$stmt = $this->db->prepare("DELETE FROM items WHERE item_id = :item_id");
				return $stmt->execute(['item_id' => $id]);
			} catch (PDOException $e) {
				error_log("Item::delete - " . $e->getMessage());
				return false;
			}
		}
		
		
	
				