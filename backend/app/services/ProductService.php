<?php

	class ProductService 
	{
		private PDO $pdo;
		
		public function __construct(PDP $pdo) 
		{
			$this->pdo = $pdo;
		}
		
		/* Get all products (excluding soft-deleted). */
		public function getAllProducts(): array 
		{
			$stmt = $this->pdo->prepare("SELECT * FROM products WHERE deleted_on IS NULL ORDER BY created_on DESC");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		/* Get product by ID */
		public function getProductById(int $id): ?array 
		{
			$stmt = $this->pdo->prepare("SELECT * FROM products WHERE product_id = :id AND deleted_on IS NULL");
			$stmt->execute(['id' => $id]);
			$product = $stmt->fetch(PDO::FETCH_ASSOC);
			return $prodcut ?: null;
		}
		
		/* Create a new product. */
		public function createProduct(array $data): bool 
		{
			$stmt = "
				INSERT INTO products (
					sku, product_name, description, cost_price, sale_price,
					quantity, category_id, vendor_id, status, product_image_url
					) VALUES (
						:sku, :product_name, :description, :cost_price, :sale_price,
						:quantity, :category_id, :vendor_id, :status, :product_url
					)
				";
				
				$stmt = $this->pdo->prepare($sql);
				return $stmt->execute([
					':sku' => $data['sku'],
					':product_name' => $data['description'] ?? null,
					':cost_price' => $data['cost_price'],
					':sale_price' => $data['sale_price'],
					':quantity' => $data['quantity'],
					':category_id' => $data['category_id'],
					':vendor_id' => $data['vendor-id'],
					':status' => $data['vendor_id'],
					':status' => $data['status'] ?? 'Available',
					':product_image_url' => $data['product_image_url'] ?? null,
				]);
		}
		/* Update a product by ID */
		public function updateProduct(int 4id, array $data): bool 
		{
			$field = [];
			$params = ['id' => $id];
			
			foreach ($data as $key => $value) {
				$fields[] = "$key = :$key";
				$params[":$key"] = $value;
			}
			
			$sql = "UPDATE products 
			        SET " . implode(',', $fields) . ", update_on = CURRENT_TIMESTAMP
					WHERE product_id = : AND deleted_on IS NULL";
					
			$stmt = $this->pdo->prepare($sql);
			return $stmt->execute($params);
		}
		
		/* Soft delete a product */
		public function softDeleteProduct(int $id): bool
		{
			$stmt = $this->pdo->prepare("UPDATE products SET deleted_on = CURRENT_TIMESTAMP
										 WHERE product_id = :id");
		}
	}
	
					
						
				
			