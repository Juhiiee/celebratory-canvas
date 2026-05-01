<?php
session_start();
if (!isset($_SESSION['vendor_id'])) {
    header("Location: vendor-login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Decoration - Vendor Panel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Celebratory Canvas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-2 d-md-block sidebar collapse">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="vendor-panel.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="vendor-add-decorations.php">Add Decorations</a></li>
                <li class="nav-item"><a class="nav-link" href="vendor-orders.php">My Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="vendor-logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-panel">
            <div class="container">
                <div class="text-center mb-4">
                    <h1>Add New Decoration</h1>
                </div>
                <form action="vendor-upload-logic.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Decoration Name</label>
                        <input type="text" class="form-control" name="decoration_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" class="form-control" name="decoration_price" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="category">
                            <option value="Wedding">Wedding</option>
                            <option value="Reception">Reception</option>
                            <option value="Sangeet">Sangeet</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 py-2">Upload Now</button>
                </form>
            </div>
        </main>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>