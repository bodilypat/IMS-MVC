<?php

	namespace App\Service;
	
	use App\Models\Purchase;
	use PDO;
	
	class PurchaseService 
	{
		private Purchase $purchaseModel;
		
		public function __construct(PDO $db) 
		{
			$this->purchaseModel = new Purchase($db);
		}
		
		/* Get all purchase with optional filters  */
		public function getById(int $purchaseId): ?array 
		{
			return $this->purchaseModel->findById($purchaseId);
		}
		
		/* Create a new purchase record */
		public function create(array $data): bool
		{
				// Optional: Validate unit_price, quantity >= 0
				if ($data['unit_price'] < 0 || $data['quantity'] <= 0) {
					return false;
				}
				
				return $this->purchaseModel->create($data);
		}
		
		/* Update an existing purchase */
		public function update(int $purchaseId, array $data): bool 
		{
			return $this->purchaseModel->update($purchaseId, $data);
		}
		
		/* Soft delete a purchase */
		public function delete(int $purchaseId): bool 
		{
			return $this->purchaseModel->delete($purchaseId);
		}
		
		/* Gel all purchases for a specific vendor */
		public function getByVendor(int $vendorId): array
		{
			return $this->purchaseModel->findAll(['vendor_id' => $vendor]);
		}
		
		/* Get purchase within a date range */
		public function getByDateRange(string $from, string $to): array
		{
			return $this->purchaseModel->findAll([
				'date_from' => $from,
				'date-to' => $to 
			]);
		}
	}
	