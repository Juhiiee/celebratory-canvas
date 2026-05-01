<?php
include("conn.php"); // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_password = $_POST['c_password'];

    // Server-side validation for password length and format
    if (strlen($c_password) !== 6 || !ctype_digit($c_password)) {
        echo "Error: Password must be exactly 6 digits.";
        exit();
    }

    // Escape strings
    $c_name = $conn->real_escape_string($c_name);
    $c_email = $conn->real_escape_string($c_email);

    // Hash the password
    $hashedPassword = password_hash($c_password, PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO customers (c_name, c_password, c_email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $c_name, $hashedPassword, $c_email);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="login-signup.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h2 class="text-center">Sign Up</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="c_name" class="form-label">Username</label>
                    <input type="text" class="transparent-input" id="c_name" name="c_name" required
                        placeholder="Enter your username" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="c_email" class="form-label">Email</label>
                    <input type="email" class="transparent-input" id="c_email" name="c_email" required
                        placeholder="Enter your email" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="c_password" class="form-label">Password</label>
                    <input type="password" class="transparent-input" id="c_password" name="c_password" required
                        placeholder="Create your 6-digit password" minlength="6" maxlength="6" pattern="\d{6}"
                        title="Password must be exactly 6 digits">
                </div>
                <input type="submit" value="Signup" name="submit" class="btn btn-primary w-100">
                <p class="mt-3 text-center"><strong>Already have an account? <a href="login.php">Login</a></strong></p>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>