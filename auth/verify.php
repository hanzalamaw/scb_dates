<?php
// auth/verify.php
// Include this at the TOP of any PHP page you want to protect:
//   require_once __DIR__ . '/auth/verify.php';

require_once __DIR__ . '/jwt_config.php';

$token = getTokenFromCookie();

if (!$token) {
    header('Location: ../login.html');
    exit;
}

$decoded = verifyToken($token);

if (!$decoded) {
    clearTokenCookie();
    header('Location: ../login.html');
    exit;
}

// Make user data available to the including file
$authUser = [
    'user_id'  => $decoded->user_id,
    'username' => $decoded->username,
    'role'     => $decoded->role,
];

/**
 * Require a specific role. Call after including verify.php:
 *   requireRole('admin');
 */
function requireRole(string $role): void {
    global $authUser;
    if ($authUser['role'] !== $role) {
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'Forbidden: insufficient permissions']);
        exit;
    }
}