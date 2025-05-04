<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AGAPEO ORPHANAGE</title>
    <link rel="stylesheet" href="css/styles_index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Dashboard</h2>
        <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
        <h3>Upload Image</h3>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Select Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <h3 class="mt-5">Uploaded Images</h3>
        <div class="row">
            <?php
            $stmt = $pdo->query("SELECT * FROM images ORDER BY uploaded_at DESC");
            while ($image = $stmt->fetch()) {
                echo '<div class="col-3 mb-3"><img src="images/' . htmlspecialchars($image['filename']) . '" class="img-fluid" alt="Uploaded Image"></div>';
            }
            ?>
        </div>
    </div>
</body>
</html>