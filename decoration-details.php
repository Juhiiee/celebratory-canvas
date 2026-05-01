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

if (isset($_GET['decoration_id'])) {
    $decoration_id = intval($_GET['decoration_id']);

    $sql = "SELECT * FROM decorations WHERE decoration_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $decoration_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Decoration not found.";
        exit();
    }
} else {
    echo "Invalid decoration ID.";
    exit();
}

/* FETCH SIMILAR */
$current_category = $row['category'];

$similar_sql = "SELECT decoration_id, decoration_name, img_path, decoration_price 
                FROM decorations 
                WHERE category = '$current_category' 
                AND decoration_id != $decoration_id 
                LIMIT 4";

$similar_result = $conn->query($similar_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $row['decoration_name']; ?> - Celebratory Canvas</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="decoration-details.css">
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

<div class="main-content">

<!-- MAIN DETAILS -->
<section id="decoration-details">
    <div class="container">
        <div class="row align-items-center custom-row">

            <!-- IMAGE -->
            <div class="col-md-6">
                <div class="image-box">
                    <img src="<?php echo $row['img_path']; ?>" class="main-img">
                </div>
            </div>

            <!-- DETAILS -->
            <div class="col-md-6">
                <div class="details-box">

                    <h2><?php echo $row['decoration_name']; ?></h2>

                    <p class="price">₹<?php echo $row['decoration_price']; ?></p>

                    <p class="desc"><?php echo $row['decoration_description']; ?></p>

                    <form action="booking.php" method="GET">
                        <input type="hidden" name="decoration_id" value="<?php echo $decoration_id; ?>">
                        <button type="submit" class="confirm-btn">Book Now</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- SIMILAR SECTION -->
<section class="similar-section">
    <div class="container">
        <h3 class="text-center mb-4"><p id="p2">Similar Decorations</p></h3>

        <div class="similar-grid">
            <?php
            if ($similar_result->num_rows > 0) {
                while ($s = $similar_result->fetch_assoc()) {
            ?>
                <div class="similar-card">
                    <a href="decoration-details.php?decoration_id=<?php echo $s['decoration_id']; ?>">
                        <img src="<?php echo $s['img_path']; ?>">
                        <div class="similar-overlay">
                            <p><?php echo $s['decoration_name']; ?></p>
                            <p>₹<?php echo $s['decoration_price']; ?></p>
                        </div>
                    </a>
                </div>
            <?php } } ?>
        </div>
    </div>
</section>

</div>

<!-- FOOTER -->
<footer class="footer">
    <p>Email: support@celebratorycanvas.com</p>
    <p>&copy; 2024 Celebratory Canvas</p>
</footer>

</body>
</html>