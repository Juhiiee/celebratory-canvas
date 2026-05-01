<?php
session_start();

if (!isset($_SESSION['c_name'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "canvas");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$c_name = $_SESSION['c_name'];
$c_id = $_SESSION['c_id'];

$decoration_id = isset($_GET['decoration_id']) ? intval($_GET['decoration_id']) : 0;

$sql = "SELECT decoration_name, img_path, decoration_price FROM decorations WHERE decoration_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $decoration_id);
$stmt->execute();
$result = $stmt->get_result();
$decoration = $result->fetch_assoc();

if (!$decoration) {
    echo "Decoration not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking - Celebratory Canvas</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="main.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top custom-navbar">
    <div class="container-fluid">
        <button onclick="history.back()" class="back-button">&#8249;</button>
        <a class="navbar-brand" href="index.php">Celebratory Canvas</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto px-4">
                <li><a class="nav-link" href="index.php#home">Home</a></li>
                <li><a class="nav-link" href="index.php#about">About</a></li>
                <li><a class="nav-link" href="index.php#gallery">Gallery</a></li>
                <li><a class="nav-link" href="index.php#decorations-themes">Decorations</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN -->
<div class="booking-wrapper">

    <!-- LEFT -->
    <div class="booking-left">
        <img src="<?php echo htmlspecialchars($decoration['img_path']); ?>" class="booking-img">

        <h3><?php echo htmlspecialchars($decoration['decoration_name']); ?></h3>
        <p class="price">₹<?php echo htmlspecialchars($decoration['decoration_price']); ?></p>
    </div>

    <!-- RIGHT -->
    <div class="booking-right">

        <h2>Complete Your Booking</h2>

        <form action="booking-process.php" method="POST">

            <input type="hidden" name="decoration_id" value="<?php echo $decoration_id; ?>">
            <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">

            <div class="form-group">
                <label>Name</label>
                <input type="text" value="<?php echo htmlspecialchars($c_name); ?>" readonly>
            </div>

            <div class="form-group">
                <label>Event Date</label>
                <input type="date" name="venue_date" required>
            </div>

            <div class="form-group">
                <label>Venue</label>
                <input type="text" name="venue" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="contact_info" required>
            </div>

            <div class="form-group">
                <label>Card Number</label>
                <input type="text" name="card_number" required>
            </div>

            <div class="row">
                <div class="col">
                    <label>Expiry</label>
                    <input type="text" name="expiry_date" placeholder="MM/YY">
                </div>

                <div class="col">
                    <label>CVV</label>
                    <input type="text" name="cvv">
                </div>
            </div>

            <button type="submit" class="confirm-btn">
                Confirm Booking
            </button>

        </form>
    </div>

</div>

<!-- FOOTER -->
<footer class="footer">
    <p>Email: support@celebratorycanvas.com</p>
    <p>&copy; 2024 Celebratory Canvas</p>
</footer>

</body>
</html>