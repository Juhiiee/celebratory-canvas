<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin-login.php");
    exit();
}

include('conn.php');

// Check if a delete request has been made
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize the ID
    $delete_query = "DELETE FROM customers WHERE c_id = $delete_id"; // Delete query
    mysqli_query($conn, $delete_query); // Execute the query
    header("Location: users.php"); // Redirect back to users page after deletion
    exit();
}

// Query to join customers and orders tables
$query = "SELECT customers.c_id, customers.c_name, customers.c_email, orders.contact_info 
          FROM customers 
          LEFT JOIN orders ON customers.c_id = orders.c_id";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Records Display - Celebratory Canvas</title>
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
                            <a class="nav-link active" href="users.php">Users</a>
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

            <!-- Users Section -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <div class="text-center">
                    <h1>Customers Record</h1>
                </div>

                <?php if ($total > 0): ?>
                    <table>
                        <tr>
                            <th>Customer Id</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Contact Info</th>
                            <th>Operation</th>
                        </tr>

                        <?php while ($result = mysqli_fetch_assoc($data)): ?>
                            <tr>
                                <td><?php echo $result['c_id']; ?></td>
                                <td><?php echo htmlspecialchars($result['c_name']); ?></td>
                                <td><?php echo htmlspecialchars($result['c_email']); ?></td>
                                <td><?php echo htmlspecialchars($result['contact_info']); ?></td>
                                <td>
                                    <a href="users.php?delete_id=<?php echo $result['c_id']; ?>" class="btn button update-btn"
                                        onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p>No records found!</p>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>