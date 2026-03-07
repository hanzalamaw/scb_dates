<?php
// auth/resend-otp.php

header('Content-Type: application/json');

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/mail_helper.php';

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
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Session expired. Please log in again.']);
    exit;
}

$stmt = $conn->prepare("SELECT email, name FROM users WHERE user_id = ? LIMIT 1");
$stmt->bind_param('i', $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    exit;
}

$code    = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
$expires = date('Y-m-d H:i:s', time() + 600);

$stmt = $conn->prepare("UPDATE users SET otp_code = ?, otp_expires_at = ? WHERE user_id = ?");
$stmt->bind_param('ssi', $code, $expires, $userId);
$stmt->execute();
$stmt->close();
$conn->close();

// Refresh pending cookie
$tempPayload = base64_encode(json_encode(['user_id' => $userId, 'exp' => time() + 600]));
setcookie('scb_pending', $tempPayload, [
    'expires'  => time() + 600,
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Strict',
]);

$sent = sendOtpEmail($user['email'], $user['name'], $code);

if (!$sent) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to send email. Please try again.']);
    exit;
}

echo json_encode(['status' => 'success', 'message' => 'Code resent.']);