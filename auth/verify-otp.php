<?php
// auth/verify-otp.php

header('Content-Type: application/json');

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/jwt_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

// Read pending cookie
$pending = $_COOKIE['scb_pending'] ?? null;
if (!$pending) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Session expired. Please log in again.']);
    exit;
}

$data   = json_decode(base64_decode($pending), true);
$userId = (int)($data['user_id'] ?? 0);
$exp    = (int)($data['exp']     ?? 0);

if (!$userId || time() > $exp) {
    setcookie('scb_pending', '', ['expires' => time() - 3600, 'path' => '/', 'httponly' => true, 'samesite' => 'Strict']);
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Session expired. Please log in again.']);
    exit;
}

$input      = json_decode(file_get_contents('php://input'), true);
$enteredOtp = trim($input['otp'] ?? $_POST['otp'] ?? '');

if (empty($enteredOtp)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Please enter the verification code.']);
    exit;
}

// Fetch user + stored OTP
$stmt = $conn->prepare(
    "SELECT user_id, username, name, email, role, otp_code, otp_expires_at 
     FROM users WHERE user_id = ? LIMIT 1"
);
$stmt->bind_param('i', $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    exit;
}

// Check OTP expiry
if (!$user['otp_expires_at'] || strtotime($user['otp_expires_at']) < time()) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Code has expired. Please log in again.']);
    exit;
}

// Check OTP value
if ($enteredOtp !== $user['otp_code']) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Invalid code. Please try again.']);
    exit;
}

// OTP valid — clear it, update last_login_at, issue JWT
$stmt = $conn->prepare("UPDATE users SET otp_code = NULL, otp_expires_at = NULL, last_login_at = NOW() WHERE user_id = ?");
$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->close();
$conn->close();

// Clear pending cookie
setcookie('scb_pending', '', ['expires' => time() - 3600, 'path' => '/', 'httponly' => true, 'samesite' => 'Strict']);

$token = generateToken($user);
setTokenCookie($token);

echo json_encode([
    'status'   => 'success',
    'message'  => 'Verified successfully.',
    'redirect' => '../index.php',
]);