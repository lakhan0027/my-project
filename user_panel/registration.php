<?php
print_r($_POST);
require_once '../db.php';
require_once __DIR__ . '/models/UserRegistration.php';
require_once __DIR__ . '/dao/UserRegistrationDAO.php';

$user = new UserRegistration();

// Populate model from POST safely
foreach ($_POST as $key => $value) {
    if (property_exists($user, $key)) {
        $user->$key = htmlspecialchars(trim($value));
    }
}

// Backend validation

// 1. ✅ Phone number validation
$cleanPhone = preg_replace('/\D/', '', $user->phone_number); // remove non-digits
if (str_starts_with($cleanPhone, '91') && strlen($cleanPhone) > 10) {
    $cleanPhone = substr($cleanPhone, 2);
}
if (strlen($cleanPhone) !== 10) {
    exit("<script>alert('Phone number must be exactly 10 digits.'); window.history.back();</script>");
}

// 2. ✅ Percentage validation
$percentages = [
    '10th' => floatval(str_replace('%', '', $user->tenth_percentage)),
    '12th' => floatval(str_replace('%', '', $user->twelfth_percentage)),
    'Graduation' => floatval(str_replace('%', '', $user->graduation_percentage)),
];

foreach ($percentages as $label => $percent) {
    if ($percent < 0 || $percent > 100) {
        exit("<script>alert('Invalid $label percentage. Must be between 0 and 100.'); window.history.back();</script>");
    }
}

// 3. ✅ Name and occupation field validation
$fields = [
    'First Name' => $user->first_name,
    'Last Name' => $user->last_name,
    'Father\'s Name' => $user->father_name,
    'Father\'s Occupation' => $user->father_occupation,
];

foreach ($fields as $label => $field) {
    if (strlen(trim($field)) < 2) {
        exit("<script>alert('$label must be at least 2 characters long.'); window.history.back();</script>");
    }
}

// Update cleaned phone number back to model
$user->phone_number = $cleanPhone;

$dao = new UserRegistrationDAO($pdo);

// Check if it's an update or new insert
if (!empty($user->id)) {
    $success = $dao->update($user);
    $message = $success ? "Updated successfully." : "Update failed.";
} else {
    $success = $dao->save($user);
    $message = $success ? "Saved successfully." : "Save failed.";
}

// Redirect with alert
echo "<script>alert('$message'); window.location.href = '../admin_panel/welcomeadmin.php';</script>";
exit;
?>
