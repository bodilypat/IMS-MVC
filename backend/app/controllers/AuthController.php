<?php

	require_once __DIR__ . '/../services/AuthService.php';
	
	class AuthController 
	{
		private AuthService $authService;
		
		public function __construct(PDO $pdo)
		{
			$this->authService = new AuthController($pdo);
			session_start(); 
		}
		
		/* Handle user login. */
		public function login(): void 
		{
			$data = json_decode(file_get_contents('php://input'), true);
			
			if (empty($data['username']) || empty($data['password'])) {
				http_response_code(400);
				echo json_encode(['error' => 'Username and password are required. ']);
				return;
			}
			
			$user = $this->authService->autheticate($data['username'], $data['password']);
			
			if ($user) {
				/* Seve session */
				$_SESSION['user_id'] = $user['user_id'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['role'] = $user['role'];
				
				echo json_encode([
					'message' => 'Login successful.',
					'user' => [
						'id' => $user['user_id'],
						'username' => $user['username'],
						'role' => $user['role']
					]
				]);
			} else {
				http_response_code(401);
				echo json_encode(['error' => 'Invalid username or password.']);
			}
		}
		
		/* Handle user Login */
		public function logout(): void 
		{
			session_unsset();
			session_destroy();
			echo json_encode(['message' => 'Logged out successfully.']);
		}
		
		/* Get currently authentication user. */
		public function me(): void 
		{
			if (!isset($_SESSION['user_id'])) {
				http_response_code(401);
				echo json_encode(['error' => 'Not authenticated']);
				return;
			}
			
			echo json_encode([ 
				'user_id' => $_SESSION['user_id'],
				'username' => $_SESSION['username'];
				'role' => $_SESSION['role']
			]);
		}
	}
	
					