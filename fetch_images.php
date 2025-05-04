<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config.php';
header('Content-Type: application/json');

$stmt = $pdo->query("SELECT filename FROM images ORDER BY uploaded_at DESC");
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($images);
?>