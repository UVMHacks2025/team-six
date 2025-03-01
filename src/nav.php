<!-- nav.php -->
<nav class="navbar">
        <div class="container">
            <h1 class="logo"><a href="{{ url_for('index') }}"><img src="static/images/logo.jpg" alt="Logo" class="logo-image"></a></h1>
            <div class="user-section">
                {% if current_user.is_authenticated and current_user.AgentID > 0 %}
                    <p class="welcome">Welcome, {{ current_user.FirstName }}!</p>
                    <a href="{{ url_for('index') }}">Home</a>
                    <a href="{{ url_for('add_listing') }}">Add Listing</a>
                    <a href="{{ url_for('logout') }}">Logout</a>
                    <a href="{{ url_for('saved_listings') }}">Saved Listings</a>
                    <a href="{{ url_for('show_graphs') }}">View Trends</a>
                    <a href="{{ url_for('statistics') }}">View Statistics</a>
                {% elif current_user.is_authenticated %}
                    <a href="{{ url_for('index') }}">Home</a>
                    <p class="welcome">Welcome, {{ current_user.FirstName }}!</p>
                    <a href="{{ url_for('logout') }}">Logout</a>
                    <a href="{{ url_for('saved_listings') }}">Saved Listings</a>
                    <a href="{{ url_for('show_graphs') }}">View Trends</a>
                    <a href="{{ url_for('statistics') }}">View Statistics</a>
                {% else %}
                    <a href="{{ url_for('index') }}">Home</a>
                    <a href="{{ url_for('login') }}">Login</a>
                    <a href="{{ url_for('show_graphs') }}">View Trends</a>
                    <a href="{{ url_for('statistics') }}">View Statistics</a>
                {% endif %}
            </div>
        </div>
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