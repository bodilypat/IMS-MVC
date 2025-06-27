<?php

	namespace App\Services;
	
	use App\Models\User;
	use PDO;
	
	class AuthService 
	{
		private User $userModel;
		
		public function __construct(PDO $db)
		{
			$this->userModel = new User($db);
		}
		
		/* Register a new user */
		public function register(array $data): bool 
		{
			// Basic validation could go here
			$data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
			unset($data['password']);
			
			return $this->userModel->create($data);
		}
		
		/* Authenticate user using username or email + password  */
		public function login(string $identifier, string $password): ?array 
		{
			$user = $this->userModel->findByUsernameOrEmail($identifier);
			
			if (!$user || !password_verify($password, $user['password_hash'])) {
				return null;
			}
			
			/* Update last login timestamp */
			$this->userModel->updateLastLogin($user['user_id']);
			
			/* Return essential info (without password) */
			unset($user['password_hash']);
			return $user;
		}
		
		/* Get User profile by ID */
		public function getProfile(int $userId): ?array 
		{
			$user = $this->userModel->findById($userId);
			
			if ($user) {
				unset($user['password_hash']);
			}
			return $user;
		}
		
		/* Soft delete a user */
		public function deleteUser(int $userId): bool 
		{
			return $this->userModel->softDelete($userId);
		}
		
		/* Change a user's password */
		public function changePassword(int $userId, string $newPassword): bool 
		{
			$hash = password_hash($newPassword, PASSWORD_BCRYPT);
			return $this->userModel->updatePassword($userId, $hash);
		}
	}
	