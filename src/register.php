<!-- register.php -->
<?php
include 'connect-db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password']; // You can enforce password policies here

    // Generate salt and hash password
    $salt = bin2hex(random_bytes(32));
    $password_hash = sha1($password . $salt);

    // Insert into database with role 'Admin'
    $sql = 'INSERT INTO users (username, password_hash, salt, role) VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$username, $password_hash, $salt, 'Admin']);
        $message = 'User created successfully!';
        header("Location: login.php?message=" . urlencode($message));
    } catch (PDOException $e) {
        $error_message = 'There was an error creating your account.';
        header("Location: login.php?error=" . urlencode($error_message));
    }
}
?>

<?php include 'top.php'; ?>

<main class="madimi-one-regular">
  <h2>Register</h2>
  <?php
    if (isset($_GET['error'])) {
      echo '<div class="panel pale-red leftbar border-red">';
      echo '<p>' . htmlspecialchars($_GET['error']) . '</p>';
      echo '</div>';
    }
    if (isset($_GET['message'])) {
      echo '<div class="panel pale-green leftbar border-green">';
      echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
      echo '</div>';
    }
  ?>

  <form method="post" action="register.php">
    <div class="input-container">
      <i class="fa fa-user icon" style="color:black;"></i>
      <input class="user-input" type="text" name="username" placeholder="Username" required>
    </div>
    <div class="input-container">
      <i class="fa fa-lock icon" style="color:black;"></i>
      <input class="pass-input" type="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit">Register</button>
  </form>
  <p>
    Already have an account? <a href="login.php">Login here</a>
  </p>
</main>

<?php include 'footer.php'; ?>
