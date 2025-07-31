<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login if not authenticated
    header("Location: ../auth/client/adminLogin.html");
    exit;
}

// Access and print the admin_id
$adminId = $_SESSION['admin_id'];
// echo "Admin ID: " . $adminId;
?>
