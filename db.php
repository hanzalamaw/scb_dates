<?php
$host = "localhost";
$username = "webhngff_hanzala";  // Default user for XAMPP
$password = "hanzala1234!";  // Default password is empty  // Your MySQL password
$database = "webhngff_twf-scb";   // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Safe error handling
if ($conn->connect_error) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Connection failed: " . $conn->connect_error
    ]);
    exit;
}
?>
