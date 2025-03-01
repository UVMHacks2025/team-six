<!-- nav.php -->
<nav class="navbar">
  <div class="container">
    <!-- Logo: Clicking it brings the user to the home page -->
    <div class="nav-logo">
      <a href="index.php">
        <img src="images/logo.jpg" alt="Logo" class="logo-image">
      </a>
    </div>
    <!-- Navigation Links -->
    <ul class="nav-menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="admin.php">Admin</a></li>
      <?php if (isset($_SESSION['username'])): ?>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Sign Up</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<!-- DONT DELETE
    if (isset($_SESSION['username'])) {
        echo '<a href="index.php">Home</a>';
        // Check if the user's role is 'Admin'
        if ($_SESSION['role'] === 'Admin') {
            echo '<a href="portal.php">Admin Portal</a>';
            echo '<a href="send_custom_email.php">Send Email</a>';
        }

        echo '<a href="logout.php">Logout</a>';
    } else {
        echo '<a href="login.php">Login</a>';
        echo '<a href="register.php">Register</a>';
    }
-->