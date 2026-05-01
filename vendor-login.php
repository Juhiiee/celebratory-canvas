<?php
session_start(); // Start the session

include("conn.php"); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $vendor_name = trim($_POST['username']);
    $vendor_password = trim($_POST['password']);

    // Escape input to prevent SQL injection
    $vendor_name = $conn->real_escape_string($vendor_name);

    // Prepare and execute SQL statement to find the vendor by username
    $stmt = $conn->prepare("SELECT vendor_id, vendor_password FROM vendors WHERE vendor_name = ?");
    $stmt->bind_param("s", $vendor_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Bind result variables (vendor_id and hashed password)
        $stmt->bind_result($vendor_id, $hashedPassword);
        $stmt->fetch();

        // Verify the password against the hashed password
        if (password_verify($vendor_password, $hashedPassword)) {
            // Password is correct, start session and redirect to vendor panel
            $_SESSION['vendor_name'] = $vendor_name;
            $_SESSION['vendor_id'] = $vendor_id; // Fetch and store vendor_id
            header("Location: vendor-panel.php"); // Redirect to vendor dashboard
            exit();
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No vendor found with that username.');</script>";
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="transparent-input" id="password" name="password" required
                        placeholder="Enter your password">
                </div>
                <input type="submit" value="Login" name="submit" class="btn btn-primary w-100">
                <p class="mt-3 text-center"><strong><a href="login.php">Are you User?</a></strong></p>

            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>