<?php
// ============================================================
//  order.php  —  Handles Food Order form submission
//  Called by order.html via fetch (AJAX POST)
// ============================================================

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'db_connect.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

// ---------- Food prices list ----------
$food_prices = [
    'pizza'    => 350,
    'pasta'    => 280,
    'sandwich' => 200,
    'cake'     => 450,
    'burger'   => 250,
    'juice'    => 150,
];

// ---------- Read & sanitize inputs ----------
$user_name = trim($conn->real_escape_string($_POST['name']        ?? ''));
$phone     = trim($conn->real_escape_string($_POST['phone']       ?? ''));
$address   = trim($conn->real_escape_string($_POST['address']     ?? ''));
$food_item = trim($conn->real_escape_string($_POST['food_select'] ?? ''));
$quantity  = (int)($_POST['quantity'] ?? 1);

// ---------- Server-side validation ----------
$errors = [];

if (strlen($user_name) < 2) {
    $errors[] = 'Please enter your full name.';
}
if (strlen(preg_replace('/\D/', '', $phone)) < 10) {
    $errors[] = 'Please enter a valid phone number.';
}
if (empty($address)) {
    $errors[] = 'Please enter your delivery address.';
}
if (!array_key_exists($food_item, $food_prices)) {
    $errors[] = 'Please select a valid food item.';
}
if ($quantity < 1) {
    $errors[] = 'Quantity must be at least 1.';
}

if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
    exit;
}

// ---------- Calculate total price ----------
$unit_price  = $food_prices[$food_item];
$total_price = $unit_price * $quantity;

// Food item label map
$food_labels = [
    'pizza'    => 'Wood Fire Pizza',
    'pasta'    => 'Creamy Pasta',
    'sandwich' => 'Club Sandwich',
    'cake'     => 'Signature Cake',
    'burger'   => 'Classic Burger',
    'juice'    => 'Fresh Juice',
];
$food_label = $food_labels[$food_item];

// ---------- Insert into orders table ----------
$stmt = $conn->prepare(
    "INSERT INTO orders (user_name, phone, address, food_item, quantity, total_price)
     VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param('ssssid', $user_name, $phone, $address, $food_label, $quantity, $total_price);

if ($stmt->execute()) {
    $order_id = $stmt->insert_id;
    echo json_encode([
        'status'      => 'success',
        'message'     => 'Order placed successfully! Redirecting to payment...',
        'order_id'    => $order_id,
        'total_price' => $total_price,
        'food_item'   => $food_label,
        'quantity'    => $quantity
    ]);
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Failed to place order. Please try again. ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
