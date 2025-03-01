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
$location = $_POST['location'];
$allergies = $_POST['allergies'];
$dietary_considerations = $_POST['dietary_considerations'];

// Insert new item
$sql = "INSERT INTO items (food_type, quantity, exp_date, location, allergies, dietary_considerations)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$food_type, $quantity, $exp_date, $location, $allergies, $dietary_considerations]);

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

// Insert a record into item_log for tracking
$sql = "INSERT INTO item_log (item_id, action, user_id) VALUES (?, 'added', ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$item_id, $user_id]);

header("Location: index.php?message=" . urlencode("Item added successfully."));
exit;
?>