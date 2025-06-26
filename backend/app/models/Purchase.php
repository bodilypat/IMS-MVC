<?php

	namespace App\Models;
	
	use PDO;
	use PDOException;
	
	class Purchase 
	{
		private PDO $DB;
		private string $table ='purchases';
		
		public function __construct(PDO $pdo)
		{
			$this->db = $pdo;
		}
		
		/* Get all purchases with optioal filters */
		public function findAll(array $filters = []): array
		{
			try {
				$sql = "SELECT * FROM purchases WHERE deleted_at IS NULL";
				$params = [];
			
				if (!empty($filters['vendor_id'])) {
					$sql .= " AND vendor_id = :vendor_id";
					$params['vendor_id'] = $filters['vendor'];
				}
			
				if (!empty($fitlers['item_id'])) {
					$sql .= " AND item_id = :item_id";
					$params['item_id'] = $filters['item_id'];
				}
			
				if (!empty($filters['date_form'])) {
					$sql .= " AND purchase_date >= :date_form";
					$params['date_from'] = $filters['date_from'];
				}
			
				if (!empty($filters['date_to'])) {
					$sql .= " AND purchases_date <= :date_to";
					$params['date_to'] = $filters['date_to'];
				}
			
				$sql .= " ORDER BY purchase_date DESC";
			
				$stmt = $this->db->prepare($sql);
				$stmt->execute($params);
			
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("Purchase::findAll - " . $e->getMessage());
				return [];
			}
		}
		
		public function findById(int $id): ?array 
		{
				try {
					$sql = "SELECT * FROM purchases 
					        WHERE purchase_id = :id 
							AND deleted_at IS NULL ";
							
					$stmt = $this->db->prepare($sql);
					$stmt->execute(['id' => $id]);
					
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					return $result ?: null;
				} catch (\PDOException $e) {
					error_log("Purchase::findById - " . $e->getMessage());
					return null;
				}
		}
		
		public function create(array $data): bool
		{
			try {
				$sql = "INSERT INTO purchases 
							(item_id, vendor_id, purchase_reference, purchase_date, unit_price, quantity, description)
						VALUES 
							(:item_id, :vendor_id, :purchase_reference, purchase_date, unit_price, :quantity, :description)
						";
				$stmt = $this->db->prepare($sql);
				
				return $stmt->execute([ 
					'item_id' => $data['item_id'],
					'vendor_id' => $data['vendor_id'],
					'purchase_reference' => $data['purchase_reference'] ?? null,
					'purchase_date' => $data['purchase_date'],
					'unit_price' => $data['unit_price'],
					'quantity' => $data['quantity'],
					'description' => $data['description'] ??  null,
				]);
			} catch (\PDOException $e) {
				error_log("Purchase::create - " . $e->getMessage());
				return false;
			}
		}
		
		public function update(int $id, array $data): bool 
		{
			try {
				$sql = "UPDATE purchases 
				        SET item_id = :item_id,
							vendor_id = : :vendor_id,
							purchase_reference = :purchase_reference,
							purchase = :purchase_date,
							unit_price = :unit_price,
							quantity = :quantity,
							description = :description,
							updated_at = NOW()
						WHERE purchase_id = :id AND deleted_at IS NULL
					";
						
					$stmt = $this->db->prepare($sql);
					return $this->execute([
						'item_id' => $data['item_id'],
						'vendor_id' => $data['vendor_id'],
						'purchase_reference' => $data['purchase_reference'] ?? null,
						'purchase_date' = $data['purchase_date'],
						'unit_price' = :$data['unit_price'],
						'quantity' = $data['quantity'] ?? null,
						'id' = $id 
					]);
			} catch (\PDOException $e) {
				error_log("Purchase::update - " . $e->getMessage());
				return false;
			}
		}
		
		/* soft delete a purchase by ID */
		public function delete(int $id): bool
		{
			try {
				$sql = "UPDATE purchases SET delete_at = NOW() WHERE purchase_id = :id AND deleted_at IS NULL";
				$stmt = $this->db->prepare($sql);
				return $stmt->execute(['id' => $id]);
			} catch (\PDOException $e) {
				error_log("Purchase::delete - " . $e->getMessage());
				return false;
			}
		}
	}
	
	
		
		
		
		