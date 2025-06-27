<?php

	namespace App\Models;
	
	use PDO;
	use PDOException;
	
	class Order 
	{
		private PDO $db;
		private string $table = 'orders';
		
		public function __contruct(PDO $pdo) 
		{
			$this->db = $pdo;
		}
		
		/* Get all orders with optional filters */
		public function findAll(array $filters = []): array 
		{
			try {
				$sql = "SELECT * FROM orders WHERE 1=1 ";
				$params = [];
				
				if (!empty($filters['customer_id'])) {
					$sql .= " AND customer_id = :customer_id";
					$params['customer_id'] = $filters['customer_id'];
				}
				
				if (!empty($filters['item_id'])) {
					$sql .= " AND item_id = :item_id";
					$params['item_id'] = $filters['item_id'];
				}
				
				if (!empty($filters['status'])) {
					$sql .= " AND item_id = :item_id";
					$params['status'] = $filters['status'];
				}
				if (!empty($filters['date_from'])) {
					$sql .= " AND order_date >= :date_from";
					$params['date_from'] = $filters['date_from'];
				}
				
				if (!empty($filters['date_to'])) {
					$sql .= " AND order_date <= :date_to";
					$params['date_to'] = $filters['date_to'];
				}
				
				$sql .= " ORDER BY order_date DESC";
				
				$stmt = $this->db->prepare($sql);
				$stmt->execute($params);
				
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("Order::findAll - " . $e->getMessage());
				return [];
			}
		}
		
		/* Get one order by ID */
		public function findById(int $id): ?array 
		{
			try {
				$sql = "SELECT * FROM orders WHERE order_id = :id";
				$stmt = $this->db->prepare($sql);
				$stmt->execute(['id' => $id]);
				
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result ?: null;
			} catch (PDOException $e) {
				error_log("Order::findById - " . $e->getMessage());
				return null;
			}
		}
		
		/* Create a new order */
		public function create(array $data): bool 
		{
			try {
				$sql = " INSERT INTO orders
							(item_id, customer_id, order_date, discount, quantity, unit_price, status)
						 VALUES 
							(:item_id, :customer_id, :order_date, :discount, :quantity, :unit_price, :status)
						";
						
				$stmt = $this->db->prepare($sql);
				
				return $stmt->execute([
					'item_id' => $data['item_id'],
					'customer_id' => $data['customer_id'],
					'order_date' => $data['order_date'],
					'discount' => $data['discount'] ?? 0.00,
					'quantity' => $data['quantity'],
					'unit_price' => $data['unit_price'],
					'status' => $data['status'] ?? 'Pending',
				]);
			} catch (PDOException $e) {
				error_log("Order::create - " . $e->getMessage());
				return false;
			}
		}
		
		/* Update an order */
		public function update (int $id, array $data): bool 
		{
			try {
				$sql = "UPDATE orders SET  
							item_id = :item_id,
							customer_id = :customer_id,
							order_date = :order_date,
							discount = :discount,
							quantity = :quantity,
							unit_price = :unit_price,
							status = :status,
							updated_on = NOW() 
						WHERE order_id = :id";
				
				$stmt = $this->db->prepare($sql);
				
				return = $this->execute([
					'item_id' => $data['item_id'],
					'customer_id' => $data['customer_id'],
					'order_date' => $data['order_date'],
					'discount' => $data['discount'],
					'quantity' => $data['quantity'],
					'unit_price' => $data['unit_price'],
					'status' => $data['status'],
					'id' => $id
				]);
			} catch (PDOException $e) {
				error_log("Order::update - " . $e->getMessage());
				return false;
			}
		}
		
		/* Delete an order (hard delete) */
		public function delete(int $id): bool 
		{
			try {
				$sql = "DELETE FROM orders WHERE order_id = :id";
				$stmt = $this->db->prepare($sql);
				return $stmt->execute(['id' => $id]);
			} catch (PDOException $e) {
				error_log("Order::delete - " . $e->getMessage());
				return false;
			}
		}
	}
	
					
					