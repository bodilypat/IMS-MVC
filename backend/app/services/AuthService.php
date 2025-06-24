<?php

	namespace App\Services;
	
	use PDO;
	use Exception;
	
	class AuthService 
	{
		private PDO $db;
		private string $userTable = 'users';
		
		public function __construct(PDO $pdo)
		{
			$this->db = new $pdo();
		}
		
		/* @param array $data['username','email','password']
		   @param int Inserted user ID
		   @throw Exception on failure or validation error
		*/
		
		public function register(array $data): int
		{
			// Basic validation
			if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
				throw new Exception('Username, email, and password are required.');
			}
			
			if (!filter_var($data['email'], FITLER_VALIDATE_EMAIL)) {
				throw new Exception('Invalid email format.');
			}
			
			// Check if username or email aleady exists
			if ($this->userExists($data['username'], $data['email'])) {
				throw new Exception('Username or email already taken.');
			}
			
			// Hash password securely 
			$hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
			
			$sql = "INSERT INTO {$this->userTable} (username, email, password_hash, created_at) 
				    VALUES(:username, :email, :password_hash, NOW())";
			$stmt = $this->db->prepare($sql);
			$success = $stmt->execute([
				'username' => $data['username'],
				':email' => $data['email'],
				':password_hash' => $hashedPassword,
			]);
			
			if (!$success ) {
				throw new Exception('Failed to register user.');
			}
			return (int) $this->db->lastInsertId();
		}
			/* Login user by verifyiing credentials 
               @param string usernameOrEMAIL username or email input 
               @param string $password  Plian password
			   @return array User data (without password) on success 
			   @throws Exception on failure 
			*/
		public function login(string $usernameOrMail, string $password): array
		{
			$sql = "SELECT id, username, email, password_has 
			        FROM {$this->userTable}
					WHERE username = :ue OR email = :ue LIMIT 1";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([':ue' => $userOrEmail]);
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if (!$user || !password_verify($password, $user['password_hash'])) {
				throw new Exception('Invalid credentiails.');
			}
			
			// Remove password_hash before returning user data
			unset($user['password_hash']);
			return $user;
		}
		
		/* Check username or email already exists */
		private function userExists(string $username, string $email): bool 
		{
			$sql = "SELECT COUNT(*) FROM {$this->userTable}
				    WHERE username = :username OR email = :email";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				':username' => $username,
				':email' => $email
			]);
			return $stmt->fetchColumn() > 0;
		}
		
		/* Verify if user session is active. , $return bool */
		public function verifySession(): bool 
		{
			if (session_status() !== PHP_SESSION_ACTIVE) {
				session_start();
			}
			return isset($_SESSION['user_id']);
		}
		
		/* Logout the current user by destroying the session */
		public function logout(): void 
		{
			if (session_status() !== PHP_SESSION_ACTIVE) {
				session_start();
			}
			$_SESSION = [];
			session_destroy();
		}
	}
	
		
				    
			$user = $this->userModel->findByUsernameOrEmail($usernameOrEmail);
			
			if (!$User) {
				throw new Exception('Invalid credentials.');
			}
			
			if (!password_verify($password, $user['password_hash'])) {
				throw new Exception('Invalid credentials.');
			}
			
			/* Update last login time */
			$this->
		