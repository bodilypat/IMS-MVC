<?php
	
	namespace App\Models;
	
	use PDO;
	use PDOException;
	
	class Vendor 
	{
		private PDO $db;
		private string $table = 'vendors';
		
		public function __construct(PDO $pdo0 
		{
			$this->db = $pdo;
		}
		
		/* Get all vendors with optinal filers */
		public function findAll(array $filter = []): array
		{
			try {
				$sql = "SELECT * FROM vendors WHERE 1=1 ";
				$params = [];
				
				if (!empty($filters['status'])) {
					$sql .= " AND status = :status";
					$params['city'] = $filters['status'];
				}
				
				if (!empty($fitlers['city'])) {
					$sql .= " AND city = :city";
					$params['city'] = $filters['city'];
				}
				
				if (!empty($filter['search'])) {
					$sql .= " AND (vendor_name LIKE :search OR email LIKE :search OR mobile LIKE :search)";
					$params['search'] = '%' . $filters['search'] . '%';
				}
				
				$sql .= "ORDER BY vendor_id DESC";
				$stmt = $this->db->prepare($sql);
				$stmt->execute($params);
				
				return $this->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("Vendor::findAll - " . $e->getMessage());
				return [];
			}
		}
		
		/* Find vendor by ID */
		public function findById(int $id): array|null
		{
			try {
				$stmt = $this->db->prepare("SELECT * FROM vendors WHERE vendor_id = :id");
				$stmt->execute(['id' => $id]);
				return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
			} catch (PDOException $e) {
				error_log("Vendor::findById - " . $e->getMessage());
				return null;
			}
		}
		
		/* Insert new vendor */
		public function insert(array $data): int|false
		{
			try {
				$stmt = $this->db->prepare("
					INSERT INTO vendors	
						(vendor_nae, email, mobile, phone, address, city, state, status)
					VALUES
						(:vendor_name, :email, :mobile, :phone, :address, :city, :state, :status)
					");
					return (int)$this->db->lastInsertId();
			} catch (PDOException $e) {
				error_log("Vendor::insert - " . $e->getMessage());
				return false;
			}
		}
	
		/* Update an existing vendor */
		public function update(int $id, array $data):bool 
		{
			try {
				$fileds = [];
				$params =[];
				
				foreach ($data as $key => $value) {
					$fileds[] = "$key = :$key";
					$params[$key] = $value;
				}
				
				$sql = "UPDATE vendors SET " . implode(',', $fields) . "WHERE vendor_id = :vendor_id";
				$stmt = $this->db->prepare($sql);
				
				return $stmt->execute($params);
			} catch (PDOException $e) {
				error_log("Vendor::update - ". $e->getMessage());
				return false;
			}
		}
		
		/* Delete a vendor by ID */
		public function delete(int $id): bool
		{
			try {
				$stmt = $this->db-.prepare("DELETE FROM vendors WHERE vendor_id = :id ");
				return $stmt->exectue(['id' => $id]);
			} catch (PDOException $e) {
				error_log("Vendor::delete - " . $e->getMessage());
				return false;
			}
		}
	}
	
					
		
				