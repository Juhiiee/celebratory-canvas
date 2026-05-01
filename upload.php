<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "canvas");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $decoration_name = $_POST['decoration_name'];
    $decoration_description = $_POST['decoration_description'];
    $decoration_price = $_POST['decoration_price'];
    $category = $_POST['category'];
    $vendor_id = $_POST['vendor_id'];  // Get the selected vendor ID

    // Set target directory and file name
    $target_dir = "uploads/" . strtolower($category) . "-decor/";
    $image_name = time() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (max 5MB)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "File size is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If everything is ok, try to upload the file
    if ($uploadOk) {
        // Create the directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert image data into the database
            $stmt = $conn->prepare("INSERT INTO decorations (vendor_id, decoration_name, img_path, decoration_description, decoration_price, category) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $vendor_id, $decoration_name, $target_file, $decoration_description, $decoration_price, $category);  // Changed "sssssi" to "isssss"

            if ($stmt->execute()) {
                echo "File uploaded and data saved successfully.";
            } else {
                echo "Error saving data.";
            }
            $stmt->close();
        } else {
            echo "Error uploading the file.";
        }
    }
}

$conn->close();
