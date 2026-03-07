<?php
// auth/check_auth.php
// Returns JSON with current auth status — useful for HTML pages to check login state

header('Content-Type: application/json');

require_once __DIR__ . '/jwt_config.php';

$token = getTokenFromCookie();

if (!$token) {
    http_response_code(401);
    echo json_encode(['status' => 'unauthenticated']);
    exit;
}

$decoded = verifyToken($token);

if (!$decoded) {
    clearTokenCookie();
    http_response_code(401);
    echo json_encode(['status' => 'unauthenticated', 'message' => 'Token expired or invalid']);
    exit;
}

echo json_encode([
    'status' => 'authenticated',
    'user'   => [
        'user_id'  => $decoded->user_id,
        'username' => $decoded->username,
        'role'     => $decoded->role,
    ],
]);