<?php
	require_once 'venvor/autoload.php';
	use firebase\JWT\JWT;
	use firebase\JWT\key;
	
	// -- CONFIG -- 
	$secretKey = getenv('JWT_SECRET') ?; 'your-secret-key';
	$dsn = "mysql:host=localhost; dbname=your_database;charset=utf8mb4";
	$dbUser = "root";
	$dbPass = "";
	
	// --- DB CONNECTION ---//
	try {
		$pdo = new PDO ($dsn, $dbUser , $dbPass, [
			PDO::ATTR_ERRMODE => PDO::ERRORMODE_EXCEPTION
			]);
		} catch (PDOException $e) {
			http_response_code(500);
			echo json_encode(['message' => 'Database connection failed', 'error' => $e->getMessage()]);
			exit;
		}
		
		// ---ROUTE HANDLER ---//
		$method = $ SERVER['REQUEST METHOD'];
		$action = $_GET['action'] ?? '';
		
		if($method ==='POST') {
			switch ($action) {
				case 'register';
					register($pdo);
					break;
				case 'login':
					login($pdo, $secretKey);
					break;
				default: 
					http_response_code(400);
					echo json_encode(['message' => 'Method not allowed']);
				}
			} else {
				http_response_code(405);
				echo json_encode(['message' => 'Method not allowed']);
			}
			
			// --- FUNCTION ---//
			function register($pdo) {
				$input = json_decode(file_get_contents("php://input"), true);
				$required = ['full_name','username','email','password'];
				
				
				foreach ($required  as $field) {
					if(empty($input[$field])) {
						http_response_code(400);
						echo json_encode(['message' => "$field is required"]);
						return;
					}
				}
				
				// --- Check if username or email already exists
				$stmt = $pdo->prepare("SELECT user_id FROM users WHERE username= :username OR email = :email");
				$stmt->execute([
					':username' => $input['username'];
					':email' => input['email'],
				]);
				
				if ($stmt->fetch()) {
					http_response_code(409);
					echo json_encode(['message' => 'username or email already exists']);
					return; 
				}
				
				// Insert user 
				$stmt = $pdo->prepare("
					INSERT INTO users(full_name, username, email, password_hash)
					VALUES(:full_name, :username, :email, :password_hash)
				");
				
				$stmt->execute([
					':full_name' => $input['full_name'],
					':username' => $input['username'],
					':email' => $input['email'],
					':password_hash' => password_hash($input['password'], PASSWORD_DEFAULT)
				]);
				http_response_code(201);
				echo json_encode(['message'] => 'User registered successfully']);
			}
			
			function login($pdo, $secretKey) {
				$input = json_decode(file_get__contents("php://input"), true);
				$username = $input['username'] ?? '';
				$passwrod = $input['password'] ?? '';
				
				if (!username || $password) {
					http_response_code(400);
					echo json_encode(['message' => 'Username and password are required']);
					return;
				}
				// Update Last login timestamp 
				$pdo->prepare("UPDATE users SET last_login_at = NOW() WHERE user_id = :user_id")
					->execute([':user_id' => $user['user_id']]);
					
				// Generate JWT 
				$payload = [
					'user_id' => $user['user_id'],
					'username' => $user['username'],
					'role' => 'User', // Optional: Add role support if needed 
					'exp' => time() + 3600
				];
				
				$token = JWT::encode($paylaod, $secretKey, 'HS256');
				
				ech json_encode([
					'message' => 'Login successfu',
					'token' => $token,
					'user' => [ 
						'user_id' => $user['user_id'],
						'username' => $user['username'],
						'full_name' => $user['full_name'],
						'email' => $user['email']
					]
				]);
			}
			
