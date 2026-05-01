<?php
session_start();

// Check login
if (!isset($_SESSION['c_name']) || !isset($_SESSION['c_id'])) {
    header("Location: login.php");
    exit();
}

// DB connection
$conn = new mysqli("localhost", "root", "", "canvas");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$c_id = $_POST['c_id'];
$decoration_id = $_POST['decoration_id'];
$venue_date = $_POST['venue_date'];
$venue = $_POST['venue'];
$contact_info = $_POST['contact_info'];
$total_amount = $_POST['total_amount'] ?? 0;

// Fetch customer email
$sql_customer = "SELECT c_email FROM customers WHERE c_id = ?";
$stmt_customer = $conn->prepare($sql_customer);
$stmt_customer->bind_param("i", $c_id);
$stmt_customer->execute();
$result_customer = $stmt_customer->get_result();
$customer = $result_customer->fetch_assoc();

if (!$customer) {
    die("Customer not found.");
}

$c_email = $customer['c_email'];

// Fetch decoration price + name
$sql_decoration = "SELECT decoration_price, decoration_name FROM decorations WHERE decoration_id = ?";
$stmt_decoration = $conn->prepare($sql_decoration);
$stmt_decoration->bind_param("i", $decoration_id);
$stmt_decoration->execute();
$result_decoration = $stmt_decoration->get_result();
$decoration = $result_decoration->fetch_assoc();

if (!$decoration) {
    die("Decoration not found.");
}

$decoration_price = (float) str_replace('₹', '', $decoration['decoration_price']);
$decoration_name = $decoration['decoration_name'];

// Calculate vendor commission (5%)
$vendor_commission = round($decoration_price * 0.05, 2);

// Insert into orders table
$sql_order = "INSERT INTO orders 
(decoration_id, c_id, event_date, total_amount, vendor_commission, status, created_at, venue, contact_info) 
VALUES (?, ?, ?, ?, ?, 'pending', NOW(), ?, ?)";

$stmt_order = $conn->prepare($sql_order);
$stmt_order->bind_param("iisssss", 
    $decoration_id, 
    $c_id, 
    $venue_date, 
    $total_amount, 
    $vendor_commission, 
    $venue, 
    $contact_info
);

$stmt_order->execute();

// Insert into payment table
$sql_payment = "INSERT INTO payment 
(c_id, c_name, c_email, payment_date, paid_amount) 
VALUES (?, ?, ?, NOW(), ?)";

$stmt_payment = $conn->prepare($sql_payment);
$stmt_payment->bind_param("isss", 
    $c_id, 
    $_SESSION['c_name'], 
    $c_email, 
    $total_amount
);

// FINAL REDIRECT
if ($stmt_payment->execute()) {

    header("Location: success.php?decoration_name=" . urlencode($decoration_name) . 
           "&venue_date=" . urlencode($venue_date) . 
           "&venue=" . urlencode($venue));
    exit();

} else {
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
