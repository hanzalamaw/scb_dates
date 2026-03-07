<?php
// auth/login.php

header('Content-Type: application/json');

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/jwt_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

// Get and sanitize input
$input = json_decode(file_get_contents('php://input'), true);

// Support both JSON body and form POST
$username = trim($input['username'] ?? $_POST['username'] ?? '');
$password = $input['password'] ?? $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Username and password are required']);
    exit;
}

// Fetch user by username or email
$stmt = $conn->prepare(
    "SELECT user_id, username, name, email, password, role 
     FROM users 
     WHERE username = ? OR email = ? 
     LIMIT 1"
);
$stmt->bind_param('ss', $username, $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Verify user exists and password matches (plain string comparison)
if (!$user || $password !== $user['password']) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
    exit;
}

// Update last_login_at
$updateStmt = $conn->prepare("UPDATE users SET last_login_at = NOW() WHERE user_id = ?");
$updateStmt->bind_param('i', $user['user_id']);
$updateStmt->execute();
$updateStmt->close();

$conn->close();

// Generate JWT and set cookie
$token = generateToken($user);
setTokenCookie($token);

echo json_encode([
    'status'   => 'success',
    'message'  => 'Login successful',
    'redirect' => '../index.php',
    'user'     => [
        'user_id'  => $user['user_id'],
        'username' => $user['username'],
        'name'     => $user['name'],
        'role'     => $user['role'],
    ],
]);