<!-- nav.php -->
<nav>
    <p>nav buttons here</p>
    <?php
        echo '<a href="index.php">Home</a>';
        if (isset($_SESSION['username'])) {
            // Check if the user's role is 'Admin'
            if ($_SESSION['role'] === 'Admin') {
                echo '<a href="portal.php">Admin Portal</a>';
            }
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="login.php">Login</a>';
            echo '<a href="register.php">Register</a>';
        }
    ?>
</nav>
</div>