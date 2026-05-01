<?php
include('conn.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $message = $_POST['message'];

    // Fetch c_id based on email
    $query = "SELECT c_id FROM customers WHERE c_email = '$c_email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $c_id = $user['c_id'];

        // Insert into reviews table
        $insertQuery = "INSERT INTO contact_us (c_id, c_name, message) VALUES ('$c_id', '$c_name', '$message')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Your message has been submitted successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with that email!'); window.location.href='index.php';</script>";
    }
}
