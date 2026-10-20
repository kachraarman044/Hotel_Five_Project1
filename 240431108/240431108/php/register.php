<?php
// ============================================================
//  register.php  —  Handles Sign-Up form submission
//  Called by sign-up.html via fetch (AJAX POST)
// ============================================================

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'db_connect.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

// ---------- Read & sanitize inputs ----------
$full_name = trim($conn->real_escape_string($_POST['full_name'] ?? ''));
$email     = trim($conn->real_escape_string($_POST['email']     ?? ''));
$phone     = trim($conn->real_escape_string($_POST['phone']     ?? ''));
$password  = $_POST['password']         ?? '';
$confirm   = $_POST['confirm_password'] ?? '';

// ---------- Server-side validation ----------
$errors = [];

if (strlen($full_name) < 2) {
    $errors[] = 'Full name must be at least 2 characters.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}

if (strlen(preg_replace('/\D/', '', $phone)) < 10) {
    $errors[] = 'Please enter a valid phone number (min 10 digits).';
}

if (strlen($password) < 6) {
    $errors[] = 'Password must be at least 6 characters.';
}

if ($password !== $confirm) {
    $errors[] = 'Passwords do not match.';
}

if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
    exit;
}

// ---------- Check if email already exists ----------
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param('s', $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'This email is already registered. Please login.']);
    $check->close();
    $conn->close();
    exit;
}
$check->close();

// ---------- Hash password & insert ----------
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare(
    "INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param('ssss', $full_name, $email, $phone, $hashed_password);

if ($stmt->execute()) {
    echo json_encode([
        'status'  => 'success',
        'message' => 'Account created successfully! Welcome to Luxe Hotel & Dine.'
    ]);
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Registration failed. Please try again. ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
