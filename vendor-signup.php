<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $vendor_name = trim($_POST['username']);
    $vendor_password = $_POST['password']; // 6-digit PIN

    // Password Hashing
    $hashed_password = password_hash($vendor_password, PASSWORD_DEFAULT);

    // Check if vendor already exists
    $check = $conn->prepare("SELECT vendor_id FROM vendors WHERE vendor_name = ?");
    $check->bind_param("s", $vendor_name);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Username already taken.');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO vendors (vendor_name, vendor_password) VALUES (?, ?)");
        $stmt->bind_param("ss", $vendor_name, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='vendor-login.php';</script>";
        } else {
            echo "<script>alert('Error occurred. Please try again.');</script>";
        }
        $stmt->close();
    }
    $check->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="login-signup.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h2 class="text-center">Vendor Sign Up</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="transparent-input" id="username" name="username" required 
                           placeholder="Create a username" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">6-Digit PIN</label>
                    <input type="password" class="transparent-input" id="password" name="password" required
                           placeholder="Enter 6 digits" minlength="6" maxlength="6" pattern="\d{6}" 
                           inputmode="numeric" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>
                <input type="submit" value="Register" name="signup" class="btn btn-primary w-100">
                <p class="mt-3 text-center"><strong>Already have a vendor account? <a href="vendor-login.php">Login</a></strong></p>
            </form>
        </div>
    </div>
</body>
</html>