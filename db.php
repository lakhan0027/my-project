<?php
// db.php — Database connection using PDO (PlanLelo)

$host = 'localhost';       // or '127.0.0.1'
$db   = 'lsmt';            // your database name
$user = 'root';            // default XAMPP username
$pass = '';                // default XAMPP password (empty)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // throws exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // use real prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Log the error to a file instead of displaying it
    error_log("[" . date("Y-m-d H:i:s") . "] DB Connection Error: " . $e->getMessage() . "\n", 3, __DIR__ . '/error_log.txt');
    exit('Database connection failed. Please try again later.');
}
?>