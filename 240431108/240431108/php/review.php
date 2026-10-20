<?php
// ============================================================
//  review.php  —  Handles Guest Review / Feedback submission
//  Called by review.html via fetch (AJAX POST)
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
$guest_name  = trim($conn->real_escape_string($_POST['guest_name']  ?? ''));
$email       = trim($conn->real_escape_string($_POST['email']       ?? ''));
$rating      = (int)($_POST['rating']      ?? 5);
$review_text = trim($conn->real_escape_string($_POST['review_text'] ?? ''));

// ---------- Server-side validation ----------
$errors = [];

if (strlen($guest_name) < 2) {
    $errors[] = 'Please enter your name.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}
if ($rating < 1 || $rating > 5) {
    $errors[] = 'Rating must be between 1 and 5.';
}
if (strlen($review_text) < 10) {
    $errors[] = 'Review must be at least 10 characters.';
}

if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
    exit;
}

// ---------- Insert into reviews table ----------
$stmt = $conn->prepare(
    "INSERT INTO reviews (guest_name, email, rating, review_text) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param('ssis', $guest_name, $email, $rating, $review_text);

if ($stmt->execute()) {
    echo json_encode([
        'status'  => 'success',
        'message' => 'Thank you, ' . htmlspecialchars($guest_name) . '! Your review has been submitted.'
    ]);
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Failed to submit review. Please try again. ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
