<?php
header('Content-Type: application/json'); // respond with JSON

include 'db.php'; // this should define $conn

// Get POST data
$id = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;

if (!$id || !$status) {
  echo json_encode(["success" => false, "error" => "Missing data"]);
  exit;
}

// Update query
$stmt = $conn->prepare("UPDATE customers SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "error" => $conn->error]);
}

$stmt->close();
$conn->close();
?>
