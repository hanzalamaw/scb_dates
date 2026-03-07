<?php
// auth/jwt_config.php

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

define('JWT_SECRET', 'your-super-secret-key-change-this-in-production');
define('JWT_ALGO', 'HS256');
define('JWT_EXPIRY', 86400); // 1 hour in seconds
define('COOKIE_NAME', 'scb_token');

/**
 * Generate a JWT token for a given user payload
 */
function generateToken(array $userData): string {
    $issuedAt = time();
    $payload = [
        'iat'      => $issuedAt,
        'exp'      => $issuedAt + JWT_EXPIRY,
        'user_id'  => $userData['user_id'],
        'username' => $userData['username'],
        'role'     => $userData['role'],
    ];
    return JWT::encode($payload, JWT_SECRET, JWT_ALGO);
}

/**
 * Decode and validate a JWT token
 * Returns decoded payload or null on failure
 */
function verifyToken(string $token): ?object {
    try {
        return JWT::decode($token, new Key(JWT_SECRET, JWT_ALGO));
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Get token from cookie
 */
function getTokenFromCookie(): ?string {
    return $_COOKIE[COOKIE_NAME] ?? null;
}

/**
 * Set JWT token as an HttpOnly cookie
 */
function setTokenCookie(string $token): void {
    setcookie(
        COOKIE_NAME,
        $token,
        [
            'expires'  => time() + JWT_EXPIRY,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Strict',
            // 'secure' => true, // Uncomment when using HTTPS
        ]
    );
}

/**
 * Clear the JWT cookie
 */
function clearTokenCookie(): void {
    setcookie(COOKIE_NAME, '', [
        'expires'  => time() - 3600,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
}