<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $company = $_POST['company'];
    $designation = $_POST['designation'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $status = $_POST['status'];

    $sql = "INSERT INTO customers (name, company, designation, address, city, status) 
            VALUES ('$name', '$company', '$designation', '$address', '$city', '$status')";

    if ($conn->query($sql) === TRUE) {
        
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

