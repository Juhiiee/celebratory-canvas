<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "canvas");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch vendors from the database
$sql_vendors = "SELECT vendor_id, vendor_name FROM vendors";
$result_vendors = $conn->query($sql_vendors);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Celebratory Canvas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <!-- Header and Navigation Bar -->
    <header class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Celebratory Canvas Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-logout.php">Logout</a>
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
                            <a class="nav-link" href="admin-panel.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="decorations.php">Decorations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vendors.php">Vendors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact_us.php">Customers Messages</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Home Section -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <div class="container mt-5">
                    <div class="text-center">
                        <h1>Add Decorations</h1>
                    </div>
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="decoration_name" class="form-label">Decoration Name</label>
                            <input type="text" class="form-control" id="decoration_name" name="decoration_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="decoration_description" class="form-label">Decoration
                                Description</label>
                            <textarea class="form-control" id="decoration_description" name="decoration_description"
                                rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="decoration_price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="decoration_price" name="decoration_price"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="Sangeet">Sangeet</option>
                                <option value="Reception">Reception</option>
                                <option value="Wedding">Wedding</option>
                                <option value="Mehendi">Mehendi</option>
                                <option value="Haldi">Haldi</option>
                                <option value="Engagement">Engagement</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="vendor_id" class="form-label">Select Vendor</label>
                            <select class="form-control" id="vendor_id" name="vendor_id" required>
                                <?php while ($row = $result_vendors->fetch_assoc()): ?>
                                <option value="<?php echo $row['vendor_id']; ?>">
                                    <?php echo $row['vendor_name']; ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Select Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <input type="submit" class="btn btn-submit" value="Upload" name="submit">
                    </form>
                </div>
            </main>
        </div>
    </div>

    div- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>