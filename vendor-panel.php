<?php
session_start();

// Check if the vendor is logged in
if (!isset($_SESSION['vendor_id'])) {
    header("Location: vendor-login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "canvas");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$vendor_id = $_SESSION['vendor_id'];
$vendor_name = $_SESSION['vendor_name'];

// Fetch orders related to this vendor's decorations
$sql = "SELECT o.order_id, o.event_date, o.venue, o.total_amount, o.vendor_commission, c.c_name, o.contact_info 
        FROM orders o
        JOIN decorations d ON o.decoration_id = d.decoration_id
        JOIN customers c ON o.c_id = c.c_id
        WHERE d.vendor_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendor_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Panel - Celebratory Canvas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <!-- Header and Navigation Bar -->
    <header class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Celebratory Canvas Vendor Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="vendor-logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="vendor-panel.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vendor-decorations.php">My Decorations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vendor-orders.php">My Orders</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Orders Section -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <div class="text-center">
                    <h1>Welcome, <?php echo htmlspecialchars($vendor_name); ?>!</h1>
                    <p>Here you can see your Decorations & Orders.</p>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>