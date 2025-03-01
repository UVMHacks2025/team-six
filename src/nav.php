<!-- nav.php -->
<nav class="navbar madimi-one-regular">
  <div class="container">
    <!-- Logo Section -->
    <div class="nav-logo">
      <a href="index.php">
        <img src="./public/images/rallycat_final.png" alt="Logo" class="logo-image">
      </a>
    </div>
    <!-- Navigation Menu -->
    <ul class="nav-menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <?php
          if (isset($_SESSION['username'])) {
              echo '<li><a href="logs.php">Logs</a></li>';
              echo '<li><a href="analytics.php">Analytics</a></li>';
              echo '<li><a href="view_requests.php">Requests</a></li>';
              echo '<li><a href="logout.php">Logout</a></li>';
          } else {
            echo '<li><a href="make_request.php">Make A Request</a></li>';
            echo '<li><a href="login.php">Login</a></li>';
          }
      ?>
    </ul>
  </div>
</nav>
