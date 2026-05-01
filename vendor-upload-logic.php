<?php
session_start();
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['vendor_id'])) {
    $vendor_id = $_SESSION['vendor_id'];
    $name = mysqli_real_escape_string($conn, $_POST['decoration_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['decoration_description']);
    $price = $_POST['decoration_price'];
    $category = $_POST['category'];

    // Target directory
    $target_dir = "uploads/" . strtolower($category) . "-decor/";
    if (!is_dir($target_dir)) { mkdir($target_dir, 0755, true); }

    $image_name = time() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert with the SESSION vendor_id
        $stmt = $conn->prepare("INSERT INTO decorations (vendor_id, decoration_name, img_path, decoration_description, decoration_price, category) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $vendor_id, $name, $target_file, $desc, $price, $category);

        if ($stmt->execute()) {
            echo "<script>alert('Uploaded successfully!'); window.location.href='vendor-decorations.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>