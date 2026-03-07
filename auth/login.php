<?php
// auth/login.php

header('Content-Type: application/json');

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/jwt_config.php';
require_once __DIR__ . '/mail_helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$input    = json_decode(file_get_contents('php://input'), true);
$username = trim($input['username'] ?? $_POST['username'] ?? '');
$password = $input['password']      ?? $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Username and password are required']);
    exit;
}

// Fetch user
$stmt = $conn->prepare(
    "SELECT user_id, username, name, email, password, role
     FROM users
     WHERE username = ? OR email = ?
     LIMIT 1"
);
$stmt->bind_param('ss', $username, $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user || $password !== $user['password']) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
    exit;
}

// SCB role → 2FA required
if ($user['role'] === 'scb') {
    $code    = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    $expires = date('Y-m-d H:i:s', time() + 600);

    $stmt = $conn->prepare("UPDATE users SET otp_code = ?, otp_expires_at = ? WHERE user_id = ?");
    $stmt->bind_param('ssi', $code, $expires, $user['user_id']);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $emailSent = sendOtpEmail($user['email'], $user['name'], $code);

    if (!$emailSent) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to send verification email. Please try again.']);
        exit;
    }

    $tempPayload = base64_encode(json_encode(['user_id' => $user['user_id'], 'exp' => time() + 600]));
    setcookie('scb_pending', $tempPayload, [
        'expires'  => time() + 600,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Strict',
    ]);

    echo json_encode([
        'status'   => '2fa_required',
        'message'  => 'A verification code has been sent to your email.',
        'redirect' => '../verify-otp.html',
    ]);
    exit;
}

// All other roles → issue JWT immediately
$stmt = $conn->prepare("UPDATE users SET last_login_at = NOW() WHERE user_id = ?");
$stmt->bind_param('i', $user['user_id']);
$stmt->execute();
$stmt->close();
$conn->close();

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