<?php
session_start();
include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Delete from decorations table
    $delete_query = "DELETE FROM decorations WHERE decoration_id = $delete_id";

    // Execute delete query
    if (mysqli_query($conn, $delete_query)) {
        echo "Decoration deleted successfully!";
        header("Location: decorations.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}


// Determine the category to filter by
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Construct the query based on the category
if ($category && $category !== 'All') {
    $query = "SELECT d.*, v.vendor_name FROM decorations d JOIN vendors v ON d.vendor_id = v.vendor_id WHERE d.category = '$category'";
} else {
    $query = "SELECT d.*, v.vendor_name FROM decorations d JOIN vendors v ON d.vendor_id = v.vendor_id";
}

$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decorations Details Display - Celebratory Canvas</title>
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

            <!-- Decorations Section -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <div class="text-center">
                    <h1>Decorations</h1>
                    <p>
                        <a href="add.php" class="decor-link" title="Add Decorations">Add</a>
                        <a href="decorations.php" class="decor-link" title="View All Decorations">View All</a>
                        <a href="decorations.php?category=Wedding" class="decor-link"
                            title="View All Wedding Decorations">Wedding</a>
                        <a href="decorations.php?category=Engagement" class="decor-link"
                            title="View All Engagement Decorations">Engagement</a>
                        <a href="decorations.php?category=Sangeet" class="decor-link"
                            title="View All Sangeet Decorations">Sangeet</a>
                        <a href="decorations.php?category=Mehendi" class="decor-link"
                            title="View All Mehendi Decorations">Mehendi</a>
                        <a href="decorations.php?category=Haldi" class="decor-link"
                            title="View All Haldi Decorations">Haldi</a>
                        <a href="decorations.php?category=Reception" class="decor-link"
                            title="View All Reception Decorations">Reception</a>
                    </p>
                </div>

                <?php
                if ($total != 0) {
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Decoration Id</th>
                                <th>Decoration Name</th>
                                <th>Image</th>
                                <th>Image Path</th>
                                <th>Decoration Description</th>
                                <th>Decoration Price</th>
                                <th>Category</th>
                                <th>Vendor Name</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($result = mysqli_fetch_assoc($data)) {
                                echo "<tr>
                                    <td>" . $result['decoration_id'] . "</td>
                                    <td>" . $result['decoration_name'] . "</td>
                                    <td><img src='" . $result['img_path'] . "' alt='" . $result['decoration_name'] . "' style='width:100px; height:100px;'></td>
                                    <td>" . $result['img_path'] . "</td>
                                    <td>" . $result['decoration_description'] . "</td>
                                    <td>" . $result['decoration_price'] . "</td>
                                    <td>" . $result['category'] . "</td>
                                    <td>" . $result['vendor_name'] . "</td> <!-- Display Vendor Name -->
                                    <td>
                                    <a href='update-decorations.php?id=" . $result['decoration_id'] . "' class='btn button update-btn'>Update</a>
                                    <a href='decorations.php?delete_id=" . $result['decoration_id'] . "' class='btn button update-btn' onclick='return confirm(\"Are you sure you want to delete this vendor?\")'>Delete</a>
                                </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p style='text-align:center'>No records found!</p>";
                }
                ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>