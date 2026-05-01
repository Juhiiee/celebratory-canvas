<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "canvas");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $vendor_name = $_POST['vendor_name'];
    $contact_info = $_POST['contact_info'];
    $vendor_email = $_POST['vendor_email'];

    // Hash the default password
    $vendor_password = password_hash('147896', PASSWORD_DEFAULT);

    // Insert vendor data into the database, including the hashed password
    $stmt = $conn->prepare("INSERT INTO vendors (vendor_name, contact_info, vendor_email, vendor_password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $vendor_name, $contact_info, $vendor_email, $vendor_password);

    if ($stmt->execute()) {
        echo "Vendor added successfully.";
    } else {
        echo "Error adding vendor: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
