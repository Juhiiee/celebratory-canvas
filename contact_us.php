<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}

include('conn.php');

// Query to fetch reviews
$query = "SELECT con_id, c_name, message, created_at FROM contact_us ORDER BY con_id DESC";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

// Check if a delete request has been made
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM contact_us WHERE r_id = $delete_id";
    mysqli_query($conn, $delete_query);
    header("Location: contact_us.php"); // Redirect back to reviews page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews - Celebratory Canvas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
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

    <div class="container-fluid">
        <div class="row">
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
                            <a class="nav-link" href="vendors.php">Vendors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contact_us.php">Customers Messages</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <h1 class="text-center">Customer Messages</h1>

                <?php if ($total > 0): ?>
                    <table>
                        <tr>
                            <th>Contact_us ID</th>
                            <th>Customer Name</th>
                            <th>Message</th>
                            <th>created_at</th>
                            <th>Action</th>
                        </tr>
                        <?php while ($result = mysqli_fetch_assoc($data)): ?>
                            <tr>
                                <td><?php echo $result['con_id']; ?></td>
                                <td><?php echo htmlspecialchars($result['c_name']); ?></td>
                                <td><?php echo htmlspecialchars($result['message']); ?></td>
                                <td><?php echo htmlspecialchars($result['created_at']); ?></td>
                                <td>
                                    <a href="reviews.php?delete_id=<?php echo $result['con_id']; ?>"
                                        class="btn button update-btn"
                                        onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p class="text-center">No reviews found!</p>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>