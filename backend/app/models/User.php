<?php

	namespace App\Models;
	
	use PDO;
	use PDOException;
	
	class User
	{
		private PDO $db;
		private string $table = 'users';
		
		public function __construct(PDO $pdo)
		{
			$this->db = $pdo;
		}
		
		/* Create a new user */
		public function create(array $data): bool 
		{
			try {
				$sql = "INSERT INTO users 
							(full_name, username, email, password_hash, role, status)
						VALUES
							(:full_name, :username, :email, :password_hash, :role, :status)
						";
				
				$stmt = $this->db->prepare($sql);
				
				return $stmt->execute([
					'full_name'  => $data['full_name'],
					'username'   => $data['username'],
					'email'  => $data['email'],
					'password_hash'  => $data['password_hash'],
					'role'  => $data['role' ?? 'Employee',
					'status'  => $data['status' ?? 'Active'
				]);
			} catch (PDOException $e) {
				error_log("User::create - " . $e->getMessage());
				return false;
			}
		}
		
		/* Find user by ID */
		public function findById(int $id): ?array 
		{
			try {
				$sql = "SELECT * FROM users WHERE user_id = :id AND deleted_at IS NULL";
				$stmt = $this->db->prepare($sql);;
				$stmt->excute(['id' => $id]);
				
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result ?: null;
			} catch (PDOException $e) {
				error_log("User::findById - " . $e->getMessage());
				return null;
			}
		}
		
		/* Find user by username or email */
		public function findByUsernameOrEmail(string $identifier): ?array 
		{
			try {
				$sql = "SELECT * FROM users 
						WHERE (username = :identifier OR email = :identifier)
						AND deleted_at IS NULL
						AND status = 'Active' 
					";
					
				$stmt = $this->db->prepare($sql);
				$stmt->execute(['identifier' => $identifier]);
				
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result ?: null;
			} catch (PDOException $e) {
					error_log("User::findByUsernameOrEmail - " . $e->getMessage());
					return null;
			}
		}
		
		/* Update last login time */
		public function updateLastLogin(int $userId): bool 
		{
			try {
					$sql = " UPDATE users 
							 SET last_login_at = NOW(), updated_at = NOW()
							 WHERE user_id = :id AND deleted_at IS null 
							";
							
					$stmt = $this->db->prepare($sql);
					return $stmt->execute(['id' => $userIdd]);
			} catch (PDOException $e) {
				error_log("User:updateLastLogin - " . $e->getMessage());
				return false;
			}
		}
		
		/* Soft delete a user */
		public function softDelete(int $userId): bool 
		{
			try {
				$sql = " UPDATE users 
				         SET deleted_at = NOW(),  updated_at = NOW()
						 WHERE user_id = :id AND deleted_at = IS NULL 
						";
				$stmt = $this->db->prepare($sql);
				return $stmt->execute(['id' => $userId]);
			} catch(PDOException $e) {
				error_log("User::softDelete - " . $e->getMessage());
				return false;
			}
		}
		
		/* Update user's password */
		public function updatePassword9int $userId, string $hash): bool 
		{
			try {
				$sql = " UPDATE users 
						 SET password_hash = :hash, updated_at = NOW() 
						 WHERE user_id = :id AND deleted_at IS NULL
						";
						
				$stmt = $this->db->prepare($sql);
				return $stmt->execute([
					'hash' => $hash,
					'id' => $userId 
				]);
			} catch (PDOException $e) {
				error_log("User::updatePassword - " . $e->getMessage());
				return false;
			}
		}
	}
	
	
						
					
		
		public function findByUsername(string $username): ?array 
		{
			$stmt = $this->db->prepare("SELECT * FROM users WHERE username =:username AND deleted_at IS NULL LIMIT 1");
			$stmt->execute(['username' => $username]);
			
			return $stmt = fetch(PDO::FETCH_ASSOC) ?: NULL;
		}
		
		public function findByEmail(string $email): ?array 
		{
			$stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email AND deleted_at IS NULL LIMIT 1");
			$stmt->execute(['email' => $email]);
			
			return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
		}
		
		public function create(array $data): bool 
		{
			$stmt = $this->db->prepare("
				INSERT INTO (full_name, username, email, password_hash, role, status)
				VALUES(:full_name, :username, :email, :password_hash, :role, :status) 
			");
			
			return $stmt->execute([
				'full_name' =>$data['full_name'],
				'username' => $data['username'],
				'email' => $data['email'],
				'password_hash' => $data['password_hash'],
				'role' => $data['role'],
				'status' => $data['status'] ?? 'Active'
			]);
		}
		
		public function updateLastLogin(int $userId):bool 
		{
			$stmt = $this->db->prepare("UPDATE users SET last_login_at =  NOW() WHERE user_id = :user_id");
			return $stmt->execute(['user_id' => $userId]);
		}
		
		public function all(): array
		{
			$stmt = $this->db->query("SELECT * FROM users WHERE deleted_at IS NULL ORDER BY created_at DESC");
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function delete(int $userId): bool 
		{
			$stmt = $this->prepare("UPDATE users SET deleted_at = NOW() WHERE user_id = :user_id");
			return $stmt->execute(['user_id' => $userId]);
		}
	}
	
			