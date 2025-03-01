<!-- nav.php -->
<nav>
    <p>nav buttons here</p>
    <?php
    ?>
</nav>
</div>

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