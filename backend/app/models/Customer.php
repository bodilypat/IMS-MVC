<?php

	namespace App\Models;
	
	use PDO;
	use PDOException;
	
	class Customer 
	{
		private PDO $db;
		private string $table = 'customers';
		
		public function __construct(PDO $pdo) 
		{
			$this->db = $pdo;
		}
		
		/* Get all customers with optional filters */
		public function findAll(array $filters = []):array 
		{
			try {
				 $sql = "SELECT * FROM customers WHERE 1=1";
				 $params = [];
				 
				 // Optional filter: status 
				 if (!empty($filters['search'])) {
					 $sql .= "AND status = :status";
					 $params['status'] = $filters['status'];
				 }
				 
				 // Optional filter: search by name or mobile 
				 if (!empty($filters['search'])) {
					 $sql .= "AND (full_name LIKE :search OR mobile like :search)";
					 $params['search'] = '%' . $filters['search'] . '%';
				 }
				 
				 $sql .= "ORDER BY created_at DESC";
				 $stmt = $this->db->prepare($sql);
				 $stmt->execute($params);
				 
				 return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch  (PDOException $e) {
				error_log("Customer::findAll - " . $e->getMessage());
				return [];
			}
		}
		
		/* find customer by ID */
		public function findById(int $id): ?array
		{
			try {
				$stmt = $this->db->prepare("SELECT * FROM customer WHERE customer_id = ?");
				$stmt->execute([$id]);
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result ?: null;
			} catch (PDOException $e) {
				error_log("Customer::findById - " . $e->getMessage());
				return null;
			}
		}
		
		/* Insert new customer */
		public function insert(array $data): int|false 
		{
			try {
				$stmt = $this->db->prepare("
					INSERT INTO customers 
						(full_name, email, mobile, phone, address, city, static, status)
					VALUES
						(:full_name, :email, :mobile, :phone, :address, :city, :status, :status)
					");
					
					$stmt->execute([
						'full_name' => $data['full_name'],
						'emil' => $data['email'] ?? null,
						'mobile' => $data['mobile'],
						'phone' => $data['phone'] ?? null,
						'city' => $data['city'] ?? null,
						'state' => $data['city'] ?? null,
						'state' => $data['state'],
						'status' => $data['status'] ?? 'Active',
					]);
					
					return (int)$this->db->lastInsertId();
			} catch (Exception $e) {
				error_log("Customer::insert - " . $e->getMessage());
				return false;
			}
		}
		
		/* Update customer by ID */
		public function update(int $id, array $data): bool 
		{
			try {
				$fields = [];
				$params = [];
				
				foreach ($data as $key => $value) {
					$fields[] = "$key = :$key";
					$param[$key] = $value;
				}
				$sql = "UPDATE customers SET " . implode(", ", $fields) . " WHERE customer_id = :customer_id";
				
				$stm = $this->db->prepare($sql);
				return $stmt->execute($params);
			} catch (PDOException $e) {
				error_log("Customer::update - " . $e->getMessage());
				return false;
			}
		}
		
		/* Deletee customer by ID */
		public function delete(int $id): bool 
		{
			try {
				$stmt->db->prepare("DELETE FROM customers WHERE customer_id = ?");
				return  $stmt->execute([$id]);
			} catch (PDOException $e) {
				error_log("Customer::delete - " . $e->getMessage());
				return false;
			}
		}
	}
	
						
					 