<?php
session_start();
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $vendor_name = trim($_POST['username']);
    $vendor_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT vendor_id, vendor_password FROM vendors WHERE vendor_name = ?");
    $stmt->bind_param("s", $vendor_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($vendor_id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($vendor_password, $hashedPassword)) {
            $_SESSION['vendor_name'] = $vendor_name;
            $_SESSION['vendor_id'] = $vendor_id;
            header("Location: vendor-panel.php");
            exit();
        } else {
            echo "<script>alert('Invalid PIN.');</script>";
        }
    } else {
        echo "<script>alert('No vendor found.');</script>";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="login-signup.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h2 class="text-center">Vendor Login</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="transparent-input" id="username" name="username" required
                           placeholder="Enter your username" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">6-Digit PIN</label>
                    <input type="password" class="transparent-input" id="password" name="password" required
                           placeholder="Enter your PIN" minlength="6" maxlength="6" pattern="\d{6}"
                           inputmode="numeric" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>
                <input type="submit" value="Login" name="submit" class="btn btn-primary w-100">
                <p class="mt-3 text-center"><strong>New vendor? <a href="vendor-signup.php">Sign Up</a></strong></p>
                <p class="mt-3 text-center"><strong><a href="login.php">Are you a User?</a></strong></p>
            </form>
        </div>
    </div>
</body>
</html>