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
    $delete_id = intval($_GET['delete_id']);

    // First, delete from the payment table using the order_id
    $delete_payment_query = "DELETE FROM payment WHERE c_id IN (SELECT c_id FROM orders WHERE order_id = $delete_id)";
    mysqli_query($conn, $delete_payment_query);

    // Then, delete from the orders table
    $delete_query = "DELETE FROM orders WHERE order_id = $delete_id";
    mysqli_query($conn, $delete_query);

    // Redirect back to orders page
    header("Location: orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders and Payments - Celebratory Canvas</title>
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
                            <a class="nav-link active" href="orders.php">Orders</a>
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

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 admin-panel">
                <?php
                $query = "SELECT 
                orders.order_id, 
                orders.event_date, 
                orders.total_amount, 
                orders.status, 
                orders.created_at, 
                orders.venue, 
                orders.contact_info,
                decorations.decoration_id, 
                MAX(payment.c_name) AS c_name, 
                MAX(payment.payment_date) AS payment_date, 
                MAX(payment.paid_amount) AS paid_amount,
                decorations.vendor_id, 
                MAX(vendors.vendor_name) AS vendor_name
            FROM orders
            LEFT JOIN payment ON orders.c_id = payment.c_id
            LEFT JOIN decorations ON orders.decoration_id = decorations.decoration_id
            LEFT JOIN vendors ON decorations.vendor_id = vendors.vendor_id
            GROUP BY orders.order_id, decorations.decoration_id";


                $data = mysqli_query($conn, $query);
                $total = mysqli_num_rows($data);

                if ($total != 0) {
                ?>
                    <div class="text-center">
                        <h1>Orders and Payments</h1>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Event Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Venue</th>
                                <th>Contact Info</th>
                                <th>Decoration ID</th>
                                <th>Customer Name</th>
                                <th>Payment Date</th>
                                <th>Paid Amount</th>
                                <th>Vendor Name</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($result = mysqli_fetch_assoc($data)) {
                                // Format the event date to DD/MM/YY
                                $event_date = date("d/m/y", strtotime($result['event_date']));
                                // Format the created_at to DD/MM/YY and time in 12-hour format with AM/PM
                                $created_at = date("d/m/y g:i A", strtotime($result['created_at']));
                                // Format the payment_date to DD/MM/YY and time in 12-hour format with AM/PM
                                $payment_date = date("d/m/y g:i A", strtotime($result['payment_date']));

                                echo "<tr>
                                    <td>" . $result['order_id'] . "</td>
                                    <td>" . $event_date . "</td>
                                    <td>" . $result['total_amount'] . "</td>
                                    <td>" . $result['status'] . "</td>
                                    <td>" . $created_at . "</td>
                                    <td>" . $result['venue'] . "</td>
                                    <td>" . $result['contact_info'] . "</td>
                                    <td>" . $result['decoration_id'] . "</td>
                                    <td>" . $result['c_name'] . "</td>
                                    <td>" . $payment_date . "</td>
                                    <td>" . $result['paid_amount'] . "</td>
                                    <td>" . $result['vendor_name'] . "</td>
                                    <td><a href='orders.php?delete_id=" . $result['order_id'] . "' class='btn button update-btn' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</a></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                <?php
                } else {
                    echo "<p>No records found!</p>";
                }
                ?>
            </main>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>