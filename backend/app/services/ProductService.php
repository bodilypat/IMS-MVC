<?php
	/* app/services/ProductService.  */
	
	namespace App\Services;
	
	use App\Models\Product;
	use PDO;
		
	class ProductService
	{
		private Product $productModel;
		
		public function __construct(PDO $db) 
		{
			$this->productModel = new Product($db);
		}
		
		/* Get all active products (not deleted) */
		public function getAllProducts(): array 
		{
			return $this->productModel->findAll();
		}
		
		/* Get product by ID */
		public function getProductById(int $productId): ?array 
		{
			return $this->productModel->findById($productId);
		}
		
		/* Create a new product. */
		public function createProduct(array $data): bool 
		{
			return $this->productModel->create($data);
		}
		
		/* Update a product by ID */
		public function updateProduct(int $productId, array $data): bool 
		{
			return $this->productModel->update($productId, $data);
		}
		
		/* Soft delete a product */
		public function softDeleteProduct(int $id): bool
		{
			return $this->productModel->seftDelete($productId)
		}
		
		/* Get products by category ID */
		public function getByCategory(int $category(int $categoryId): array 
		{
				return $this->productModel->findByCategory($categoryId);
		}
		
		/* Get all product below to certain stock threshold */
		public function getLowStockProducts(int $threshold = 10): array
		{
			return $this->productModel->findLowStock($threshold);
		}
		
		/* Search products by keyword (name or SKU) */
		public function search(string $keyword): array
		{
			return $this->productModel->search($keyword);
		}
	}
	
					
						
				
			