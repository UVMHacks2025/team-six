
<?php
session_start();
include 'connect-DB.php';

$name = $_POST['name'];
$email = $_POST['email'];
$item1 = $_POST['item1'];
$item2 = $_POST['item2'];
$item3 = $_POST['item3'];

$sql = "INSERT INTO requests (name, email, item1, item2, item3)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute(params: [$name, $email, $item1, $item2, $item3]);



