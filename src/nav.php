<!-- nav.php -->
<nav class="navbar">
  <div class="container">
    <!-- Logo Section -->
    <div class="nav-logo">
      <a href="index.php">
        <img src="images/logo.jpg" alt="Logo" class="logo-image">
      </a>
    </div>
    <!-- Navigation Menu -->
    <ul class="nav-menu">
      <li><a href="index.php">Home</a></li>
      <?php
          if (isset($_SESSION['username'])) {
              // Check if the user's role is 'Admin'
              if ($_SESSION['role'] === 'Admin') {
                  echo '<li><a href="portal.php">Admin Portal</a></li>';
              }
              echo '<li><a href="logout.php">Logout</a></li>';
          } else {
              echo '<li><a href="login.php">Login</a></li>';
              echo '<li><a href="register.php">Sign Up</a></li>';
          }
      ?>
    </ul>
  </div>
</nav>
