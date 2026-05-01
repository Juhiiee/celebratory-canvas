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

// 1. Fetch decoration price + vendor_id
// Added vendor_id to the query so we know which vendor to pay
$sql_decoration = "SELECT decoration_price, decoration_name, vendor_id FROM decorations WHERE decoration_id = ?";
$stmt_decoration = $conn->prepare($sql_decoration);
$stmt_decoration->bind_param("i", $decoration_id);
$stmt_decoration->execute();
$result_decoration = $stmt_decoration->get_result();
$decoration = $result_decoration->fetch_assoc();

if (!$decoration) {
    die("Decoration not found.");
}

$vendor_id = $decoration['vendor_id']; // Get vendor ID
$base_price = (float) str_replace('₹', '', $decoration['decoration_price']);
$decoration_name = $decoration['decoration_name'];

// 2. NEW CALCULATION LOGIC (10% Vendor / 5% Customer)
$customer_fee = round($base_price * 0.05, 2);      // 5% Fee from Customer
$vendor_commission = round($base_price * 0.10, 2); // 10% Commission from Vendor
$total_to_pay = $base_price + $customer_fee;      // What customer pays
$vendor_payout = $base_price - $vendor_commission; // What vendor gets[cite: 8]

// Fetch customer email
$sql_customer = "SELECT c_email FROM customers WHERE c_id = ?";
$stmt_customer = $conn->prepare($sql_customer);
$stmt_customer->bind_param("i", $c_id);
$stmt_customer->execute();
$result_customer = $stmt_customer->get_result();
$customer = $result_customer->fetch_assoc();
$c_email = $customer['c_email'];

// 3. Updated INSERT with NEW COLUMNS
// Ensure you have run the ALTER TABLE command we discussed earlier
$sql_order = "INSERT INTO orders 
(decoration_id, c_id, vendor_id, event_date, base_price, customer_fee, vendor_commission, total_amount, vendor_payout, status, created_at, venue, contact_info) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW(), ?, ?)";

$stmt_order = $conn->prepare($sql_order);
// Updated bind_param with new variables
$stmt_order->bind_param("iiisdddddss", 
    $decoration_id, 
    $c_id, 
    $vendor_id,
    $venue_date, 
    $base_price,
    $customer_fee,
    $vendor_commission,
    $total_to_pay,
    $vendor_payout,
    $venue, 
    $contact_info
);
$stmt_order->execute();

// 4. Insert into payment table using the calculated $total_to_pay
$sql_payment = "INSERT INTO payment 
(c_id, c_name, c_email, payment_date, paid_amount) 
VALUES (?, ?, ?, NOW(), ?)";

$stmt_payment = $conn->prepare($sql_payment);
$stmt_payment->bind_param("isss", 
    $c_id, 
    $_SESSION['c_name'], 
    $c_email, 
    $total_to_pay
);

if ($stmt_payment->execute()) {
    header("Location: success.php?decoration_name=" . urlencode($decoration_name) . 
           "&venue_date=" . urlencode($venue_date) . 
           "&venue=" . urlencode($venue));
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>