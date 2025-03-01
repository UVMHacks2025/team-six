<!-- login.php -->
<?php include 'top.php'; ?>

<main class="madimi-one-regular">
  <h2>Login</h2>
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
  <form method="post" action="authenticate.php">
    <div class="input-container">
      <i class="fa fa-user icon" style="color:black;"></i>
      <input class="user-input" type="text" name="username" placeholder="Username" required>
    </div>
    <div class="input-container">
      <i class="fa fa-lock icon" style="color:black;"></i>
      <input class="pass-input" type="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit">Login</button>
  </form>
  <p>
    New user? <a href="register.php">Register here</a>
  </p>
</main>

<?php include 'footer.php'; ?>