<?php
session_start();
require_once 'config.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin) {
            echo "Debug: User found: " . htmlspecialchars($admin['username']) . "<br>";
            echo "Debug: Stored hash: " . htmlspecialchars($admin['password']) . "<br>";
            if (password_verify($password, $admin['password'])) {
                echo "Debug: Password verification successful<br>";
                $_SESSION['admin_id'] = $admin['id'];
                header("Location: admin.php");
                exit;
            } else {
                echo "Debug: Password verification failed<br>";
                $error = "Invalid username or password";
            }
        } else {
            echo "Debug: No user found with username: " . htmlspecialchars($username) . "<br>";
            $error = "Invalid username or password";
        }
    } catch (PDOException $e) {
        echo "Debug: Database error: " . $e->getMessage() . "<br>";
        $error = "Database error occurred: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AGAPEO ORPHANAGE</title>
    <link rel="stylesheet" href="css/styles_index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" class="mt-4">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>