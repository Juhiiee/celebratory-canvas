<?php
session_start();
include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}

// Get the decoration_id from the URL
$decoration_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch decoration details along with vendor name from the database
$query = "SELECT d.*, v.vendor_name FROM decorations d JOIN vendors v ON d.vendor_id = v.vendor_id WHERE d.decoration_id = $decoration_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $decoration = mysqli_fetch_assoc($result);
} else {
    echo "Decoration not found!";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['decoration_name'];
    $description = $_POST['decoration_description'];
    $price = $_POST['decoration_price'];
    $category = $_POST['category'];
    $vendor_id = $_POST['vendor_id']; // Added vendor_id from the form

    // Update the decoration details in the database
    $update_query = "UPDATE decorations SET decoration_name = '$name', decoration_description = '$description', decoration_price = '$price', category = '$category', vendor_id = '$vendor_id' WHERE decoration_id = $decoration_id";

    if (mysqli_query($conn, $update_query)) {
        // Redirect back to the decorations.php page after updating
        header("Location: decorations.php");
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
    <title>Update Decoration - Celebratory Canvas</title>
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

            <!-- Update Decoration Section -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <div class="container mt-5">
                    <div class="text-center">
                        <h1>Update Decorations</h1>
                    </div>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="decoration_name" class="form-label">Decoration Name</label>
                            <input type="text" class="form-control" id="decoration_name" name="decoration_name"
                                value="<?php echo $decoration['decoration_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="decoration_description" class="form-label">Description</label>
                            <textarea class="form-control" id="decoration_description" name="decoration_description"
                                rows="4" required><?php echo $decoration['decoration_description']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="decoration_price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="decoration_price" name="decoration_price"
                                value="<?php echo $decoration['decoration_price']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="Wedding"
                                    <?php echo ($decoration['category'] == 'Wedding') ? 'selected' : ''; ?>>Wedding
                                </option>
                                <option value="Engagement"
                                    <?php echo ($decoration['category'] == 'Engagement') ? 'selected' : ''; ?>>
                                    Engagement</option>
                                <option value="Sangeet"
                                    <?php echo ($decoration['category'] == 'Sangeet') ? 'selected' : ''; ?>>Sangeet
                                </option>
                                <option value="Mehendi"
                                    <?php echo ($decoration['category'] == 'Mehendi') ? 'selected' : ''; ?>>Mehendi
                                </option>
                                <option value="Haldi"
                                    <?php echo ($decoration['category'] == 'Haldi') ? 'selected' : ''; ?>>Haldi</option>
                                <option value="Reception"
                                    <?php echo ($decoration['category'] == 'Reception') ? 'selected' : ''; ?>>Reception
                                </option>
                            </select>
                        </div>
                        <!-- Vendor Name Dropdown -->
                        <div class="mb-3">
                            <label for="vendor_id" class="form-label">Vendor Name</label>
                            <select class="form-control" id="vendor_id" name="vendor_id" required>
                                <option value="">Select Vendor</option>
                                <?php
                                // Fetch all vendors for the dropdown
                                $vendor_query = "SELECT * FROM vendors";
                                $vendors = mysqli_query($conn, $vendor_query);
                                while ($vendor = mysqli_fetch_assoc($vendors)) {
                                    echo "<option value='" . $vendor['vendor_id'] . "' " . (($decoration['vendor_id'] == $vendor['vendor_id']) ? 'selected' : '') . ">" . $vendor['vendor_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-submit">Update Decoration</button>
                        <a href="decorations.php" class="btn btn-submit">Cancel</a>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>