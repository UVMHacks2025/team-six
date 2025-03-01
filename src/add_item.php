<?php
session_start();
include 'connect-db.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=" . urlencode("Please log in first."));
    exit;
}

// Retrieve and sanitize input
$food_type = $_POST['food_type'];
$quantity = $_POST['quantity'];
$exp_date = $_POST['exp_date'];
$allergies = $_POST['allergies'];
$dietary_considerations = $_POST['dietary_considerations'];
$low_item_alert = !empty($_POST['low_item_alert']) ? $_POST['low_item_alert'] : 10; // Default to 10 if not set
$description = $_POST['description'];

// Handle the image file upload
$image_path = "";
if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == UPLOAD_ERR_OK) {
    $targetDir = "./public/images/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $fileName = basename($_FILES['image_file']['name']);
    $targetFilePath = $targetDir . $fileName;
    
    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetFilePath)) {
        $image_path = "./public/images/" . $fileName;
    } else {
        $image_path = "./public/images/default.png"; // Fallback image
    }
} else {
    // No file was uploaded or an error occurred
    $image_path = "./public/images/default.png";
}

// Insert new item (including the new low_item_alert field)
$sql = "INSERT INTO items (food_type, quantity, exp_date, allergies, dietary_considerations, low_item_alert, image_path, description)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$food_type, $quantity, $exp_date, $allergies, $dietary_considerations, $low_item_alert, $image_path, $description]);

// Get the ID of the inserted item
$item_id = $pdo->lastInsertId();

// Retrieve user_id from session if available; otherwise fetch from DB
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_id = $user['id'];
}

// Insert a record into item_log for tracking the addition of the item
$sql = "INSERT INTO item_log (item_id, action, user_id, food_type, image_path, description)
        VALUES (?, 'added', ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$item_id, $user_id, $food_type, $image_path, $description]);

header("Location: index.php?message=" . urlencode("Item added successfully."));
exit;
?>