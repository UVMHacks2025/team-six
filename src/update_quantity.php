<?php
header('Content-Type: application/json');
ob_start();

session_start();
if (!isset($_SESSION['username'])) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

include 'connect-db.php';

if (!isset($_POST['item_id']) || !isset($_POST['action']) || !isset($_POST['amount'])) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
    exit;
}

$item_id = $_POST['item_id'];
$action = $_POST['action'];
$amount = intval($_POST['amount']);
if ($amount < 1) {
    $amount = 1;
}

// Fetch the current quantity, low_item_alert, and food_type for the item
$sql = "SELECT quantity, low_item_alert, food_type FROM items WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$item_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Item not found']);
    exit;
}

$previousQuantity = (int) $item['quantity'];
$lowItemAlert = (int) $item['low_item_alert'];
$foodType = $item['food_type'];

// Calculate the new quantity based on the action
if ($action === 'add') {
    $newQuantity = $previousQuantity + $amount;
} elseif ($action === 'remove') {
    $newQuantity = max($previousQuantity - $amount, 0);
} else {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Invalid action']);
    exit;
}

// Update the item quantity in the database
$sql = "UPDATE items SET quantity = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$newQuantity, $item_id])) {
    // Define admin email addresses
    $adminEmails = [
        'aperkel@uvm.edu',
        'oacook@uvm.edu',
        'nicolas.fay@uvm.edu',
        'miro.gohacki@uvm.edu'
    ];

    // Send a "low stock" email if the item has just dropped below the threshold
    if ($previousQuantity > $lowItemAlert && $newQuantity <= $lowItemAlert && $newQuantity > 0) {
        $subject = "Low Stock Alert for $foodType";
        $message = "Warning: The stock level for $foodType has dropped below the alert threshold of $lowItemAlert. Current quantity: $newQuantity.";
        foreach ($adminEmails as $adminEmail) {
            mail($adminEmail, $subject, $message);
        }
    }

    // Send an "out of stock" email if the item has just reached zero
    if ($previousQuantity > 0 && $newQuantity == 0) {
        $subject = "Out of Stock Alert for $foodType";
        $message = "Alert: The item $foodType is now out of stock.";
        foreach ($adminEmails as $adminEmail) {
            mail($adminEmail, $subject, $message);
        }
    }

    ob_clean();
    echo json_encode(['success' => true, 'newQuantity' => $newQuantity]);
} else {
    ob_clean();
    echo json_encode(['success' => false, 'error' => 'Update failed']);
}
exit;
?>