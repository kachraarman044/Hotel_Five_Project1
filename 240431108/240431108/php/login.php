<?php
// ============================================================
//  login.php  —  Handles Login form submission
//  Called by login.html via fetch (AJAX POST)
// ============================================================

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Start session to store logged-in user info
session_start();

require_once 'db_connect.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

// ---------- Read & sanitize inputs ----------
$email    = trim($conn->real_escape_string($_POST['email']    ?? ''));
$password = $_POST['password'] ?? '';

// ---------- Server-side validation ----------
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email address.']);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(['status' => 'error', 'message' => 'Password must be at least 6 characters.']);
    exit;
}

// ---------- Fetch user from DB ----------
$stmt = $conn->prepare("SELECT id, full_name, email, password FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'No account found with this email. Please sign up.']);
    $stmt->close();
    $conn->close();
    exit;
}

$user = $result->fetch_assoc();

// ---------- Verify password ----------
if (!password_verify($password, $user['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Incorrect password. Please try again.']);
    $stmt->close();
    $conn->close();
    exit;
}

// ---------- Login successful — store session ----------
$_SESSION['user_id']   = $user['id'];
$_SESSION['user_name'] = $user['full_name'];
$_SESSION['user_email']= $user['email'];

echo json_encode([
    'status'  => 'success',
    'message' => 'Login successful! Welcome back, ' . $user['full_name'] . '.',
    'user'    => [
        'id'    => $user['id'],
        'name'  => $user['full_name'],
        'email' => $user['email']
    ]
]);

$stmt->close();
$conn->close();
?>
