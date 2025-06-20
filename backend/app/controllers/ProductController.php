<?php

	require_once __DIR__ .'/../services/ProductService.php';
	
	class ProductController 
	{
		private ProductService $productService;
		
		public function __construct(PDO $pdo) 
		{
			$this->productService = new ProductService($pdo);
		}
		
		/* List all products. */
		public function index(): void 
		{
				$products = $this->productService->getAllProducts();
				header('Content-Type: application/json');
				echo json_encode($products);
		}
		
		/* Show a single product by ID */
		public function show(int $productId): void 
		{
			$product = $this->productService->getProductById($productId);
			
			if ($product) {
				echo json_encode($product);
			} else {
				http_response_code(404);
				echo json_encode(['error' => 'Product not found']);
			}
		}
		
		/* Create a new product */
		public function store(): void 
		{
			$data = json_decode(file_get_contents("php://input"), true);
			
			$required = ['sku','product_name','cost_price','sale_price','quantity','category_id','vendor_id'];
			foreach ($required as $filed) {
				if (empty($data[$field])) {
					http_response_code(400);
					echo json_encode(['error' => "Missing field: $field"]);
					return;
				}
			}
			
			$result = $this->productService->createProduct($data);
			
			if ($result) {
				echo json_encode(['message' => 'Product created successfully']);
			} else {
				http_response_code(500);
				echo json_encode(['error' => 'Failed to create product']);
			}
		}
		
		/* Update an existing product. */
		public function update(int $productId): void
		{
			$data = json_decode(file_get_contents("php://input"), true);
			
			$updated = $this->productService->updateProduct($productId, $data);
			
			if ($updated) {
				echo json_encode(['message' => 'Product updated']);
			} else {
				http_response_code(500);
				echo json_encode(['error' => 'Failed to update prodict']);
			}
		}
		
		/* Soft delete a product (set deleted_on timestamp. */
		public function delete(int $productId): void 
		{
			$deleted = $this->productService->softDeleteProduct($productId);
			
			if ($deleted) {
				echo json_encode(['message' => 'Product deleted (soft)']);
			} else {
				http_response_code(500);
				echo json_encode(['error' => 'Failed to delete product']);
			}
		}
	}
	
	}
	