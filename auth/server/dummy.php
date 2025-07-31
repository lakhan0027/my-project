<?php
require_once '../../includes/sessionStore.php';
echo "✅ Admin inserted successfully!";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
// Include your database connection file
// require_once '../../db.php'; // ✅ Update path if it's in a different folder

// // Admin credentials
// $email = 'admin@example.com';
// $plainPassword = 'admin123';

// // Hash the password
// $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// // Insert admin data into the table
// try {
//     $stmt = $pdo->prepare("INSERT INTO admin (email, password) VALUES (?, ?)");
//     $stmt->execute([$email, $hashedPassword]);
//     echo "✅ Admin inserted successfully!";
// } catch (PDOException $e) {
//     echo "❌ Error inserting admin: " . $e->getMessage();
//}
?>
