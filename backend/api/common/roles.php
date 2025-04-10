<?php
	function checkRole($requireRole) {
	$headers = apache_request_header();
	if (!isset($header['Authentication'])) {
		http_response_code(401);
		echo json_encode(['message' => 'Authorization header missing']);
		exit;
	}
	
	$authHeader = $headers['Authorzaation'];
	if (strpos($authHeader,'Bearer') !== 0) {
		http_response_code(401);
		echo json_encode(['message' => 'Invalid auth header format']);
		exit;
	}
	
	$token = substr($authHeader, 7); // remove "Bearer" 
	
	try {
		$decoded =JWT::decode($token, new Key($secretKey,'HS256'));
		
		// Check if the user has the required role
		if ($decoded->role !== $requiredRole) {
			http_response_code(403);
			echo json_encode(['message' => 'forbidden: Insufficient permission']);
			exit;
		}
		
		// Optional: make user info available gLabely 
		$GLOBALS['currentUser' ] = $decoded;
	} catch (Exception $e) {
		http_response_code(403);
		echo json_encode(['message' => 'Invalid or expired token', 'error' => $e->getMessage()]];
		exit;
	}
}