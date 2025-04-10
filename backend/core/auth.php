<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'vendor/autoload.php';

function authenticateToken() {
    // Expecting header: Authorization: Bearer <token>
    $headers = apache_request_headers();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['message' => 'Authorization header missing']);
        exit;
    }

    $authHeader = $headers['Authorization'];
    if (strpos($authHeader, 'Bearer ') !== 0) {
        http_response_code(401);
        echo json_encode(['message' => 'Invalid auth header format']);
        exit;
    }

    $token = substr($authHeader, 7); // Remove "Bearer "

    $secretKey = getenv('JWT_SECRET') ?: 'your-secret-key';

    try {
        $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

        // Optional: make user info available globally
        $GLOBALS['currentUser'] = $decoded;

    } catch (Exception $e) {
        http_response_code(403);
        echo json_encode(['message' => 'Invalid or expired token', 'error' => $e->getMessage()]);
        exit;
    }
}
