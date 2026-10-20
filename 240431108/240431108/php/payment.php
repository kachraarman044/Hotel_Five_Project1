<?php
// ============================================================
//  payment.php  —  Handles Payment / Checkout form submission
//  Called by payment.html via fetch (AJAX POST)
//  SECURITY: Only last 4 digits of card are stored — NEVER full card
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
$full_name  = trim($conn->real_escape_string($_POST['full_name']  ?? ''));
$email      = trim($conn->real_escape_string($_POST['email']      ?? ''));
$address    = trim($conn->real_escape_string($_POST['address']    ?? ''));
$city       = trim($conn->real_escape_string($_POST['city']       ?? ''));
$zip_code   = trim($conn->real_escape_string($_POST['zip_code']   ?? ''));
$card_name  = trim($conn->real_escape_string($_POST['card_name']  ?? ''));
$card_num   = preg_replace('/\D/', '', $_POST['card_number'] ?? '');  // digits only
$amount     = (float)($_POST['amount'] ?? 2290.00);

// ---------- Server-side validation ----------
$errors = [];

if (strlen($full_name) < 2) {
    $errors[] = 'Please enter your full name.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}
if (empty($address)) {
    $errors[] = 'Please enter your delivery address.';
}
if (empty($city)) {
    $errors[] = 'Please enter your city.';
}
if (empty($zip_code)) {
    $errors[] = 'Please enter your ZIP code.';
}
if (strlen($card_name) < 2) {
    $errors[] = 'Please enter the name on the card.';
}
if (strlen($card_num) < 12 || strlen($card_num) > 16) {
    $errors[] = 'Please enter a valid card number.';
}
if ($amount <= 0) {
    $errors[] = 'Invalid payment amount.';
}

if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
    exit;
}

// ---------- Store ONLY last 4 digits (security) ----------
$card_last4 = substr($card_num, -4);

// ---------- Insert into payments table ----------
$stmt = $conn->prepare(
    "INSERT INTO payments (full_name, email, address, city, zip_code, card_name, card_last4, amount, status)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'success')"
);
$stmt->bind_param(
    'sssssssd',
    $full_name, $email, $address, $city,
    $zip_code, $card_name, $card_last4, $amount
);

if ($stmt->execute()) {
    $payment_id = $stmt->insert_id;
    echo json_encode([
        'status'     => 'success',
        'message'    => 'Payment successful! Your booking is confirmed.',
        'payment_id' => $payment_id,
        'amount'     => $amount,
        'card_last4' => $card_last4
    ]);
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Payment processing failed. Please try again. ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
