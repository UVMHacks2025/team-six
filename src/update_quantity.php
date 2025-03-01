<?php
session_start();
include 'connect-db.php';

// Ensure the user is logged in.
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "Unauthorized."]);
    exit;
}

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

$item_id = isset($data['item_id']) ? (int)$data['item_id'] : 0;
$delta   = isset($data['delta']) ? (int)$data['delta'] : 0;

if ($item_id <= 0 || $delta === 0) {
    echo json_encode(["success" => false, "error" => "Invalid parameters."]);
    exit;
}

// Update the quantity
$sql = "UPDATE items SET quantity = quantity + ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$result = $stmt->execute([$delta, $item_id]);

if (!$result) {
    echo json_encode(["success" => false, "error" => "Database update failed."]);
    exit;
}

// Optionally log the action in the item_log table
$action = $delta > 0 ? 'added' : 'removed';
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO item_log (item_id, action, user_id, food_type, image_path, description)
        SELECT id, ?, ?, food_type, image_path, description FROM items WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$action, $user_id, $item_id]);

// Retrieve the new quantity
$sql = "SELECT quantity FROM items WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$item_id]);
$new_quantity = $stmt->fetchColumn();

echo json_encode(["success" => true, "new_quantity" => $new_quantity]);
?>
