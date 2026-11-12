<?php
// Update these settings to match your local MySQL installation.
$host = 'localhost';
$db   = 'shopease';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    exit('Database connection failed. Import database.sql and check config.php.');
}
if (session_status() === PHP_SESSION_NONE) session_start();
