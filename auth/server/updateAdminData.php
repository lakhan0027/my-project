<?php
require_once '../../db.php'; // Assumes $pdo is returned here


// Optional: print session for debugging
// print_r($_SESSION);

// Handle password update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = trim($_POST['password'] ?? '');

    // Validate input
    if (empty($newPassword)) {
        header("Location: ../client/adminLogin.html?error=Password field is required.");
        exit;
    }

    if (strlen($newPassword) < 6) {
        header("Location: ../client/adminLogin.html?error=Password must be at least 6 characters.");
        exit;
    }

    // Hash new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    try {
        // Update password for the only admin row
        $stmt = $pdo->prepare("UPDATE admin SET password = ? LIMIT 1");
        $stmt->execute([$hashedPassword]);

        // Redirect with success message
      echo "<script>
  alert('Password updated successfully.');
    window.location.href = '../client/adminLogin.html?success=' + encodeURIComponent('Password updated successfully.');
</script>";
exit;

       
    } catch (PDOException $e) {
        error_log("[" . date("Y-m-d H:i:s") . "] Password update error: " . $e->getMessage() . "\n", 3, __DIR__ . '/error_log.txt');
        header("Location: ../client/adminLogin.html?error=An error occurred. Try again later.");
        exit;
    }
}
?>
