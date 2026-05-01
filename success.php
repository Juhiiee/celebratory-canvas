<?php
session_start();

if (!isset($_SESSION['c_name'])) {
    header("Location: login.php");
    exit();
}

$decoration_name = $_GET['decoration_name'] ?? "Decoration";
$venue_date = $_GET['venue_date'] ?? "";
$venue = $_GET['venue'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmed</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="success.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Celebratory Canvas</a>
    </div>
</nav>

<div class="success-wrapper">

    <!-- CHECK ICON -->
    <div class="checkmark-circle">
        ✔
    </div>

    <h1>Booking Confirmed!</h1>
    <p class="sub-text">Your celebration is now beautifully planned 🎉</p>

    <!-- DETAILS -->
    <div class="details-box">
        <p><strong>Decoration:</strong> <?php echo htmlspecialchars($decoration_name); ?></p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($venue_date); ?></p>
        <p><strong>Venue:</strong> <?php echo htmlspecialchars($venue); ?></p>
    </div>

    <a href="index.php" class="home-btn">Back to Home</a>

</div>

</body>
</html>