<?php
session_start();
include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}

// Get the vendor_id from the URL
$vendor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch vendor details from the database
$query = "SELECT * FROM vendors WHERE vendor_id = $vendor_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $vendor = mysqli_fetch_assoc($result);
} else {
    echo "Vendor not found!";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vendor_name = mysqli_real_escape_string($conn, $_POST['vendor_name']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);
    $vendor_email = mysqli_real_escape_string($conn, $_POST['vendor_email']);

    // Update the vendor details in the database
    $update_query = "UPDATE vendors SET vendor_name = '$vendor_name', contact_info = '$contact_info', vendor_email = '$vendor_email' WHERE vendor_id = $vendor_id";

    if (mysqli_query($conn, $update_query)) {
        // Redirect back to the vendors.php page after updating
        header("Location: vendors.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vendor - Celebratory Canvas</title>
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
                            <a class="nav-link" href="decorations.php">Decorations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="vendors.php">Vendors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact_us.php">Customers Messages</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Update Vendor Section -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <div class="container mt-5">
                    <div class="text-center">
                        <h1>Update Vendor</h1>
                    </div>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="vendor_name" class="form-label">Vendor Name</label>
                            <input type="text" class="form-control" id="vendor_name" name="vendor_name"
                                value="<?php echo htmlspecialchars($vendor['vendor_name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_info" class="form-label">Contact Info</label>
                            <input type="text" class="form-control" id="contact_info" name="contact_info"
                                value="<?php echo htmlspecialchars($vendor['contact_info']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="vendor_email" class="form-label">Vendor Email</label>
                            <input type="email" class="form-control" id="vendor_email" name="vendor_email"
                                value="<?php echo htmlspecialchars($vendor['vendor_email']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-submit">Update Vendor</button>
                        <a href="vendors.php" class="btn btn-submit">Cancel</a>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>