<?php
session_start(); // Start the session

include("conn.php"); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Escape input to prevent SQL injection
    $username = $conn->real_escape_string($username);

    // Prepare and execute SQL statement to find the admin by username
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Bind result variable (hashed password)
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, start session and redirect to admin panel
            $_SESSION['username'] = $username;
            header("Location: admin-panel.php"); // Redirect to admin dashboard
            exit();
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No admin found with that username.');</script>";
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="login-signup.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h2 class="text-center">Admin Login</h2>
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
            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>