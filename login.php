<?php
session_start(); // Start the session

include("conn.php"); // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $c_name = trim($_POST['c_name']);
    $c_password = trim($_POST['c_password']);

    // Escape input to prevent SQL injection
    $c_name = $conn->real_escape_string($c_name);

    // Prepare and execute SQL statement to find user by username
    $stmt = $conn->prepare("SELECT c_id, c_password FROM customers WHERE c_name = ?");
    $stmt->bind_param("s", $c_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Bind result variables
        $stmt->bind_result($c_id, $hashedPassword);
        $stmt->fetch();

        // Verify the password

        if (password_verify($c_password, $hashedPassword)) {
            // Password is correct, start session and store c_name and c_id
            $_SESSION['c_name'] = $c_name;
            $_SESSION['c_id'] = $c_id;

            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that username.');window.location.href='login.php';</script>";
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
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="login-signup.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h2 class="text-center">Login</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="c_name" class="form-label">Username</label>
                    <input type="text" class="transparent-input" id="c_name" name="c_name" required
                        placeholder="Enter your username" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="c_password" class="form-label">Password</label>
                    <input type="password" class="transparent-input" id="c_password" name="c_password" required
                        placeholder="Enter your 6-digit password" minlength="6" maxlength="6" pattern="\d{6}"
                        inputmode="numeric" title="Please enter exactly 6 digits"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>
                <input type="submit" value="Login" name="submit" class="btn btn-primary w-100">
                <p class="mt-3 text-center"><strong>Don't have an account? <a href="signup.php">Sign Up</a></strong></p>
                <p class="mt-3 text-center"><strong><a href="vendor-login.php">Are you a Vendor?</a></strong></p>

            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>