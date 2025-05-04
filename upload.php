<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $target_dir = "images/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file = $_FILES['image'];
    $filename = basename($file['name']);
    $target_file = $target_dir . time() . '_' . $filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate file
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        die("File is not an image.");
    }

    if ($file['size'] > 5000000) { // 5MB limit
        die("File is too large.");
    }

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        die("Only JPG, JPEG, PNG & GIF files are allowed.");
    }

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        $stmt = $pdo->prepare("INSERT INTO images (filename) VALUES (?)");
        $stmt->execute([basename($target_file)]);
        header("Location: admin.php");
        exit;
    } else {
        die("Error uploading file.");
    }
}
?>