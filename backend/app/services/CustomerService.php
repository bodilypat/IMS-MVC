<?php
	
	namespace App\Service;
	
	use App\Models\Customers;
	use Exception;
	
	class CustomerService 
	{
		protected Customer $customerModel;
		
		public function __construct() 
		{
			$this->customerModel = new Customers();
		}	
		/* GEt all customer with optional filtering, pagination, or string.*/
		
		public function getAll(array $filters = []): array 
		{
			/* implement filtering inside model or here */
			return $this->customerModel->findAll($filters);
		}
		
		/* Get a single customer by ID */
		public function getById(int $customerId) : ?array 
		{
			return $this->customerModel->findById($customerId);
		}
		
		/* create a new customer */
		public functtion create(array $data):int 
		{
			/* Basic validaton */
			if (empty($data['full_name']) || empty($data['mobile']) || empty($data['address']) || empty($data['state'])) {
				throw new Exception('Missing required fields for customer creation');
			}
			
			/* Check for email/mobile handle/db layer ideally */
			$newId = $this->customerModel->insert($data);
			
			if (!$newId) {
				throw new Exception('Failed to create customer');
			}
			return $newId;
		}
		
		/* Update an existing customer  */
		public function update(int $customerId, array $data): bool
		{
			/* Cheack if customer exists */
			$existing = $this->customerModel->findById($customerId);
			if(!$existing) {
				throw new Exception('Customer not found']);
			}
			
			/* Validate data */
			if (isset($data['email']) && !filter($data['email'], FILTER_VALIDATE_EMAIL)) {
				throw new Exception('Invalid email format');
			}
			return $ths->customerModel->update($customerId) $data);
		}
		
		/* Delete a customer by Id */
		public function delete(int $customerId): bool 
		{
			/* Optionally check if customer exists */
			$existing = $this->custorModel->fetchId($customerId);
			
			if (!$existing) {
				throw new Exception('Customer not found');
			}
			return $this->customerModel->delete($customerId);
		}
	}
	
		
			