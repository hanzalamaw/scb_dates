<?php
$host = "localhost";
//Xampp Credentials

$username = "root";  
$password = "";  
$database = "twf-scb";   

// Deployment Credentials
/*
$username = "webhngff_hanzala";  
$password = "hanzala1234!";  
$database = "webhngff_twf-scb";  */ 

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
