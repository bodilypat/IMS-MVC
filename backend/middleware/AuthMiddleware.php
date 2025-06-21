<?php
	
	namespace Middleware;
	
	class AuthMiddleware 
	{
		public static function handle() 
		{
			/* session-based auth */
			session_start();
			if (!isset($_SESSION['user'])) {
				http_response_code(401);
				echo json_encode([
					'status' => 'error',
					'message' => 'Unauthorized access. Please login first.'
				]);
				exit();
			}
			/* vslidate user roles here */
		}
	}
	