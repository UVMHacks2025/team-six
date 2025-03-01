
<?php
session_start();
include 'connect-db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$item1 = $_POST['item1'];
$item2 = $_POST['item2'];
$item3 = $_POST['item3'];

$sql = "INSERT INTO requests (name, email, item1, item2, item3)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $email, $item1, $item2, $item3]);

// Sending email
$subject = "Request Reciept - Rally Cat's Cupboard";
$message = "Hi $name,\n
Thank you for making a request at Rally Cat's Cupboard! 
This is your submission receipt for your request at Rally Cat's Cupboard. 
Show your receipt to a staff member upon arrival.
\n
Items Requested:\n
1. $item1\n
2. $item2\n
3. $item3\n";


mail($email, $subject, $message, );
header("Location: make_request.php");
?>