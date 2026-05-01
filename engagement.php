<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['c_name'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "canvas");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Engagement images from the decorations table
// Fetch Wedding images from the decorations table
$min_price = $_GET['min_price'] ?? '';
$max_price = $_GET['max_price'] ?? '';
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? '';

$sql = "SELECT decoration_id, decoration_name, img_path, decoration_price 
        FROM decorations 
        WHERE category = 'engagement'";

// SEARCH
if (!empty($search)) {
    $sql .= " AND decoration_name LIKE '%$search%'";
}

// PRICE RANGE
if (!empty($min_price) && !empty($max_price)) {
    $sql .= " AND decoration_price BETWEEN $min_price AND $max_price";
}

// SORTING
if ($sort == "low") {
    $sql .= " ORDER BY decoration_price ASC";
} elseif ($sort == "high") {
    $sql .= " ORDER BY decoration_price DESC";
}$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagement Decorations - Celebratory Canvas</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="main.css">

    <!--style>
        .footer {
            background-color: #daae81;
            /* Same color as the navbar */
            color: white;
            /* Text color */
            text-align: center;
            /* Center the text */
            padding: 10px 0;
            /* Padding for the footer */
            position: relative;
            /* Ensure proper positioning */
            bottom: 0;
            /* Stick to the bottom */
            width: 100%;
            /* Full width */
        }
    </style-->
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
    <!-- Engagement Gallery Section -->
    <section id="decorations-themes" class="py-5">
        <div class="container">
            <p id="p2">Our Decorations For Engagement</p>

            <div class="filter-wrapper">
                <form method="GET" class="filter-bar">
        
                    <!-- SEARCH -->
                    <input type="text" name="search" placeholder="Search decoration..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        
                    <!-- PRICE -->
                    <input type="number" name="min_price" placeholder="Min ₹" value="<?php echo $_GET['min_price'] ?? ''; ?>">
                    <input type="number" name="max_price" placeholder="Max ₹" value="<?php echo $_GET['max_price'] ?? ''; ?>">

                    <!-- SORT -->
                    <select name="sort">
                        <option value="">Sort</option>
                        <option value="low" <?php if(($sort ?? '')=='low') echo 'selected'; ?>>Low → High</option>
                        <option value="high" <?php if(($sort ?? '')=='high') echo 'selected'; ?>>High → Low</option>
                    </select>
        
                     <!-- APPLY -->
                    <button type="submit">Apply</button>
        
                    <!-- RESET -->
                    <a href="engagement.php" class="reset-btn">Reset</a>

                </form>
        </div>

            <div class="showcase">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="showcase-item">';
                        echo '    <a href="decoration-details.php?decoration_id=' . $row["decoration_id"] . '">';
                        echo '        <div class="showcase-image">';
                        echo '            <img src="' . $row["img_path"] . '" alt="' . $row["decoration_name"] . '">';
                        echo '        </div>';
                        echo '        <div class="overlay">';
                        echo '            <h4>' . $row["decoration_name"] . '</h4>';
                        echo '            <p>Price: ₹' . $row["decoration_price"] . '</p>';
                        echo '        <form action="booking.php" method="GET">';
                        echo '            <input type="hidden" name="decoration_id" value="' . $row["decoration_id"] . '">';
                        echo '            <button type="submit" class="booknow mt-2">Book Now</button>';
                        echo '        </form>';
                        echo '        </div>';
                        echo '    </a>';
                        echo '</div>';
                    }
                } else {
                    echo "No mehendi decorations available.";
                }
                ?>
            </div>
        </div>
    </section>

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

</body>

</html>

<?php
$conn->close();
?>