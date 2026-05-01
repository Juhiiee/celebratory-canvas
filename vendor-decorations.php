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

// Fetch decorations related to this vendor
$sql = "SELECT decoration_id, decoration_name, img_path FROM decorations WHERE vendor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendor_id);
$stmt->execute();
$result = $stmt->get_result();
$decorations = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Decorations - Celebratory Canvas</title>
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
                            <a class="nav-link" href="vendor-panel.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="vendor-decorations.php">My Decorations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vendor-orders.php">My Orders</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Decorations Section -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <div class="text-center">
                    <h1>Your Decorations</h1>

                    <?php if (empty($decorations)): ?>
                    <p>No decorations found.</p>
                    <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Decoration ID</th>
                                <th>Name</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($decorations as $decoration): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($decoration['decoration_id']); ?></td>
                                <td><?php echo htmlspecialchars($decoration['decoration_name']); ?></td>
                                <td>
                                    <img src="<?php echo htmlspecialchars($decoration['img_path']); ?>"
                                        style="width:100px; height:auto;">
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>