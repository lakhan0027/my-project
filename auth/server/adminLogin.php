<?php
session_start();
require_once '../../db.php'; // ✅ Update this path to your actual db.php location

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
    exit;
}

// Sanitize and fetch input
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Basic validation
$errors = [];

if (empty($email)) {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

if (empty($password)) {
    $errors[] = "Password is required.";
} elseif (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
}

// Return errors if any
if (!empty($errors)) {
    echo "<script>alert('" . implode("\\n", $errors) . "'); window.history.back();</script>";
    exit;
}

try {
    // Fetch admin data
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    // Verify credentials
    if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_email'] = $admin['email'];

    echo "<script>
        alert('Login Successfully.');
        window.location.href = '../../admin_panel/welcomeadmin.php';
    </script>";
    exit;
} else {
    echo "<script>
        alert('Invalid email or password.');
        window.history.back();
    </script>";
    exit;
}

} catch (PDOException $e) {
    echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
    exit;
}
?>
