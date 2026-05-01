<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}

include('conn.php');

// Handle adding a new vendor
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_vendor'])) {
    $vendor_name = mysqli_real_escape_string($conn, $_POST['vendor_name']);
    $vendor_password = mysqli_real_escape_string($conn, $_POST['vendor_password']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);
    $vendor_email = mysqli_real_escape_string($conn, $_POST['vendor_email']);

    $query = "INSERT INTO vendors (vendor_name, vendor_password, contact_info, vendor_email, created_at) VALUES ('$vendor_name', '$vendor_password', '$contact_info', '$vendor_email', NOW())";
    mysqli_query($conn, $query);
}

// Handle vendor deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // First, delete any orders associated with decorations of this vendor
    $delete_orders_query = "
        DELETE FROM orders
        WHERE decoration_id IN (SELECT decoration_id FROM decorations WHERE vendor_id = $delete_id)
    ";
    mysqli_query($conn, $delete_orders_query);

    // Then, delete any decorations associated with this vendor
    $delete_decorations_query = "
        DELETE FROM decorations WHERE vendor_id = $delete_id
    ";
    mysqli_query($conn, $delete_decorations_query);

    // Finally, delete the vendor
    $delete_vendor_query = "
        DELETE FROM vendors WHERE vendor_id = $delete_id
    ";
    mysqli_query($conn, $delete_vendor_query);

    header("Location: vendors.php"); // Redirect after deletion
    exit();
}


// Fetch vendors from the database
$query = "SELECT * FROM vendors";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendors - Celebratory Canvas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <!-- Header and Navigation Bar -->
    <header class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin-panel.php">Celebratory Canvas Admin</a>
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

            <!-- Vendors Section -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <div class="text-center">
                    <h1>Vendors</h1>
                    <p>
                        <a href="add-vendors.php" class="decor-link" title="Add Vendors">Add
                            Vendor</a>
                    </p>
                </div>

                <?php if ($total > 0) { ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Vendor ID</th>
                                <th>Vendor Name</th>
                                <th>Contact Info</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($result = mysqli_fetch_assoc($data)) {
                                echo "<tr>
                                <td>" . $result['vendor_id'] . "</td>
                                <td>" . htmlspecialchars($result['vendor_name']) . "</td>
                                <td>" . htmlspecialchars($result['contact_info']) . "</td>
                                <td>" . htmlspecialchars($result['vendor_email']) . "</td>
                                <td>" . date("d/m/y g:i A", strtotime($result['created_at'])) . "</td>
                                <td>
                                    <a href='update-vendors.php?id=" . $result['vendor_id'] . "' class='btn button update-btn'>Update</a>
                                    <a href='vendors.php?delete_id=" . $result['vendor_id'] . "' class='btn button update-btn' onclick='return confirm(\"Are you sure you want to delete this vendor?\")'>Delete</a>
                                </td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo "<p style='text-align:center'>No records found!</p>";
                } ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>