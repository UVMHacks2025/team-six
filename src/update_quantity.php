<?php
header('Content-Type: application/json');
ob_start();

session_start();
if (!isset($_SESSION['username'])) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

include 'connect-db.php'; // Ensure this file does not output any extra content

if (!isset($_POST['item_id']) || !isset($_POST['action']) || !isset($_POST['amount'])) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
    exit;
}

$item_id = $_POST['item_id'];
$action = $_POST['action'];
$amount = intval($_POST['amount']);
if ($amount < 1) {
    $amount = 1; // Default to 1 if an invalid amount is provided
}

// Retrieve current quantity
$sql = "SELECT quantity FROM items WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$item_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Item not found']);
    exit;
}

$currentQuantity = (int)$item['quantity'];

// Determine new quantity based on action and amount
if ($action === 'add') {
    $newQuantity = $currentQuantity + $amount;
} elseif ($action === 'remove') {
    $newQuantity = max($currentQuantity - $amount, 0);  // Ensure it doesn't go negative
} else {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Invalid action']);
    exit;
}

// Update the item quantity in the database
$sql = "UPDATE items SET quantity = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$newQuantity, $item_id])) {
    // Optionally, log the action here
    ob_clean();
    echo json_encode(['success' => true, 'newQuantity' => $newQuantity]);
} else {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Update failed']);
}
exit;
?>
