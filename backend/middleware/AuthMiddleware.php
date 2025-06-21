<?php
	
	namespace Middleware;
	
	class AuthMiddleware 
	{
		/* Check user is authenticated, 
			   @param array $allowRoles Roles allowed to access the route, $return void
		*/
		public static function handle(array $allowedRoles = []): void
		{
			if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}
			
			if (empty($_SESSION['user'])) {
				http_response_code(401);
				echo json_encode([
					'status' => 'error',
					'message' => 'Unauthorized access. Please login first.'
				]);
				exit();
			}
			
			/* Authorization check (role-based access) */
			if (!empty($allowedRoles)) {
				$userRole = $_SESSION[['user']['role'] ?? null;
				
				if (!$userRole || !in_array($userRole, $allowedRoles, true)) {
					http_response_code(403);
					echo json_encode([
						'status' => 'error',
						'message' => 'Forbiden. You do not have permission to access this resource.'
					]);
					exit();
				}
			}
		}
	}
	