<?php
session_start();
include 'conn.php';

// Check login
if (!isset($_SESSION['c_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['c_id'];
$user_name = $_SESSION['c_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Celebratory Canvas</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>

<body>

<!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top custom-navbar">
        <div class="container-fluid">
            <button onclick="history.back()" class="back-button">&#8249;</button>
            <a class="navbar-brand" href="index.php">Celebratory Canvas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto px-4">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#gallery">Our Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#decorations-themes">Decorations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- PROFILE SECTION -->
 <div class="main-content">
    <section class="py-5">
    <div class="container">

        <!-- USER -->
        <p id="p2">Welcome, <?php echo $user_name; ?> 👋</p>

        <!-- BOOKINGS -->
        <h4 class="showcase-title">Your Bookings</h4>

        <div class="row">
        <?php
        $query = "SELECT o.*, d.decoration_name, d.img_path
                  FROM orders o
                  JOIN decorations d ON o.decoration_id = d.decoration_id
                  WHERE o.c_id='$user_id'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                $status = strtolower($row['status']);
                $color = ($status == "confirmed") ? "green" : "red";
        ?>
            <div class="col-md-6 mb-4">
                <div class="booking-card d-flex">

                    <!-- IMAGE -->
                    <img src="<?php echo $row['img_path']; ?>" class="booking-img">

                    <!-- DETAILS -->
                    <div class="booking-details">
                        <h5><?php echo $row['decoration_name']; ?></h5>
                        <p><b>Date:</b> <?php echo $row['event_date']; ?></p>
                        <p><b>Status:</b> 
                            <span style="color:<?php echo $color; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </p>
                    </div>

                </div>
            </div>
        <?php
            }
        } else {
            echo "<p style='text-align:center;'>You haven't booked anything yet.</p>";
        }
        ?>
        </div>

    </div>
</section>
 </div>


<!-- Footer -->
<footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>Email: support@celebratorycanvas.com</p>
                <p>Phone: +91 9824310914, +91 9428348348</p>
            </div>
            <div class="quick-links">
                <a href="index.php#about">About Us</a>
                <a href="index.php#gallery">Gallery</a>
                <a href="index.php#decorations-themes">Decorations</a>
                <a href="index.php#contact">Contact Us</a>
            </div>

            <div class="footer-content">
                <p>&copy; 2024 Celebratory Canvas.</p>
            </div>
        </div>
    </footer>

<script src="js/bootstrap.min.js"></script>

</body>
</html>