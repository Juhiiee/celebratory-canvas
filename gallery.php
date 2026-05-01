<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['c_name'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Gallery - Celebratory Canvas</title>
    <!-- Bootstrap CSS -->
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

    <!-- Gallery Section -->
    <section id="decorations-themes" class="py-5">
        <div class="container">
            <p id="p2">Gallery</p>
            <div class="showcase">
                <?php
                for ($i = 1; $i <= 31; $i++): // Loop through images
                ?>
                <div class="showcase-item">
                    <div class="showcase-image">
                        <img src="gallery-decor/g<?php echo $i; ?>.jpg" alt="gallery Image <?php echo $i; ?>"
                            data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this.src)">
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-family: 'Baskerville';
    color: #784E2C" id="imageModalLabel">Gallery Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <img id="fullImage" src="" alt="Full Size Image" class="img-fluid"
                        style="max-width: 80%; max-height: 70vh; object-fit: contain;">
                </div>
            </div>
        </div>
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

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    function showImage(src) {
        document.getElementById('fullImage').src = src;
    }
    </script>
</body>

</html>