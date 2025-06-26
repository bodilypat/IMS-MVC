<?php

	namespace App\Service;
	
	use App\Models\Order;
	use PDO;
	
	class OrderService 
	{
		private Order $orderModel;
		
		public function __construct(PDO $db)
		{
			$this->orderModel = new Order($db);
		}
		
		/* Get all orders with optional filter (status, date range, customer_id) */
		public function getAll(array $filters = []): array 
		{
			return $this->db->findAll($filters);
		}
		
		/* Get a single order by ID */
		public function getById(int $orderId): ?array 
		{
			return $this->orderModel->findById($orderId);
		}
		
		/* Create a new order */
		public function insert(array $data): bool 
		{
			if ($data['quantity']  < 0 || $data['unit_price'] < 0) {
				return false; // optional basic validation 
			}
			
			return $this->orderModel->insert($data);
		}
		
		/* Update an existing order */
		public function edit(int $orderId, array $data): bool 
		{
			return $this->orderModel->update($orderId, $data);
		}
		
		/* Delete an existing order  */
		public function delete(int $orderId): bool 
		{
			return $this->orderModel->destroy($orderId);
		}
		
		/* Get all orders by customer */
		public function getByCustomer(int $customerId): array 
		{
			return $this->orderMode->findAll(['customer_id' => $customerId]);
		}
		
		/* Get all orders in a date range */
		public function getByDateRange(string $from, string $to): array
		{
			return $this->orderModel->findAll([
				'date_from' => $from,
				'date_to' => $to,
			]);
		}

		/* GEt all orders by status (Pending, Completed, cancelled) */
		public function getByStatus(string, $status): array 
		{
			return $this->orderModel->findAll(['status' => $status]);
		}
	}
	