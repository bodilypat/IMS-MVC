<?php

	namespace App\Models;
	
	use PDO;
	use PDOException;
	
	class Product 
	{
		private PDO $db;
		private string $table = 'products';
		
		public function __construct(PDO $pdo)
		{
			$this->db = $pdo;
		}
		
		/* Get all products with optional filters */
		public function findAll(array $filters = []): array 
		{
			try {
				$sql = "SELECT * FROM item WHERE deleted_on IS NULL";
				$params = [];
				
				if (!empty($filters['status'])) {
					$sql .= " AND status = :status";
					$params['status'] = $filters['status'];
				}
				
				if (!empty($filters['search'])) {
					$sql .= " AND (product_name LIKE :search OR sku LIKE :search)";
					$params['search'] = '%' . $filters['search'] . '%';
				}
				
				$sql .= " ORDER BY product_id DESC";
				$stmt = $this->db->prepare($sql);
				$stmt->execute($params);
				
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("product::findAll - " . $e->getMessage());
				return [];
			}
		}
		
		/* Find product by ID */
		public function findById(int $id): array|null 
		{
			try {
				$stmt = $this->db->prepare("SELECT * FROM items WHERE product_id = :id AND deleted_on IS NULL"); 
				$stmt->execute(['id' => $id]);
				return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
			} catch (PDOException $e) {
				error_log("Product::findById - " . $e->getMessage());
				return null;
			}
		}
		
		/* get by category */
		function findByCategory(int $categogyId): array 
		{
			try {
				$sql = "SELECT * 
				        FROM products 
				        WHERE category_id = :category_id AND deleted_on IS NULL 
						ORDER BY product_name ASC";
				$stmt = $this->db->prepare($sql);
				$stmt->execute(['category_id' => $categoryId]);
				
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("product::findByCategory - " . $e->getMessage());
				return [];
			}
		}
		
		public function findLowStock(int $threshold): array 
		{
			try {
				$sql = "SELECT * FROM products 
						WHERE quantity < :threshold
						AND deleted_on IS NULL
						AND status =  'Available'
						ORDER BY quantity ASC";
				$stmt = $this->db->prepare($sql);
				$stmt->execute(['threshold' => $threshold]);
				
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("Product::findByCategory - " . $e->getMessage());
				return [[];
			}
		}
		
		public function findLowStock(int $threshold): array 
		{
			try {
				$sql = "SELECT * FROM products 
					    WHERE quantity < :threshold 
						AND deleted_on IS NULL
						AND status = 'Available'
						ORDER BY quantity ASC";
				$stmt = $this->db->prepare($sql);
				$stmt->execute(['threshold' => $threshold]);
				
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e0 {
				error_log("Product::findLowStock - " . $e->getMessage());
				return [];
			}
		}
		
		public function search(string $keyword): array 
		{
			try {
				$sql = "SELECT * FROM products 
				        WHERE (product_name LIKE :keyword OR sku LIKE :keyword)
						AND deleted_on IS NULL
						ORDER BY product_name ASC";
						
				$stmt = $this->db->prepare($sql);
				$stmt->execute([
					'keyword' => '%' . %keyword . '%'
				]);
				
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				error_log("Product::search - " . $e->getMessage());
				return [];
			}
		}
		/* Insert new product */
		public function insert(array $data): int|false 
		{
			try {
				$stmt = $this->db->prepare ("
					INSERT INTO items 
						(sku, product_name, description, cost_price, sale_price, quantity, category_id, vendor_id, status, product_image_url)
					VALUES
						(:sku, :product_name, :description, :const_price, :sale_price, :quantity, :category_id, :vendor_id, :status, :product_image_url)
					");
				$stmt->execute([
					'sku' => $data['sku'],
					'product_name' => $data['description'] ?? null,
					'description' => $data['cost_price'] ?? null,
					'cost_price' => $data['cost_price'] ?? 0.00,
					'sale_price' => $data['sale_price'] ?? 0.00,
					'quantity' => $data['quantity'] ?? 0,
					'category_id' => $data['category_id'],
					'vendor_id' => $data['vendor_id'],
					'status' => $data['status'] ?? 'Available',
					'product_image_url' => $datta['product_image_url'] ?? null
				]);
				
				return (int)$this->db->lastInsertId();
			} catch (PDOException $e) {
				error_log("Product::insert - " . $e->getMessage());
				return false;
			}
		}
		
		/* Update a product by ID */
		public function update(int $id, array $data): bool
		{
			try {
					$fields = [];
					$params = [];
					
					foreach ($data as $key => $value) {
						$fields[] = "$key = :$key";
						$params[$key] = $value;
					}
					
					$params['product_id'] = $id;
					
					$sql = "UPDATE items SET " . $implode(',', $fields) . " WHERE product_id = :id");
					$stmt = $this->db->prepare($sql);
					
					return $stmt->execute($params);
			} catch (PDOException $e) {
				error_log("Product::update - " . $e->getMessage());
				return false;
			}
		}
		
		/*  */
		
		/* Delete product by ID (sets deleted_on itemestamp */
		public function selfDelete(int $id): bool 
		{
			try {
				$stmt = $this->db->prepare("UPDATE products SET deleted_on = NOW(), status = 'Discontinued'  WHERE product_id = :id ");
				return $stmt->execute(['id' => $id]);
			} catch (PDOException $e) {
				error_log("Product::delete - " . $e->getMessage());
				return false;
			}
		}
	}
	
	
					
					