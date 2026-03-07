<?php require_once __DIR__ . '/auth/verify.php'; ?>
<?php
include 'db.php'; // Include the DB connection

// Fetch all customer records
$sql = "SELECT * FROM customers_dates";
$result = $conn->query($sql);

$customers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($customers);

$conn->close();
?>
