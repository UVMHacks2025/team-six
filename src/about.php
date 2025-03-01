<?php include 'top.php'; ?>
<main class="home madimi-one-regular">
    <h1>About The Cupboard</h1>

    <a href="https://www.uvm.edu/cals/foodsystems/rally-cats-cupboard">Uvm Organization Page</a>
    <br>

    <a href="https://www.instagram.com/rallycatscupboard/#">Instagram Page</a>

<!-- Php to read from file and handle form -->
    <?php
    $filename = "public/texts/hours.txt";  //path to the file
    // get lines to display for the website
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    } else {
        $lines = ["No hours available."];
    }
    // Handle form submission to change hours
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["content"])) {
            file_put_contents($filename, $_POST["content"]); // Save changes
            $message = "Hours updated successfully!";
        }
    }
    // Read file content
    $content = file_exists($filename) ? file_get_contents($filename) : "File not found.";
    ?>

<!--hours on the website -->
    <div class="hours-container">
        <h2>Hours of Operation</h2>
        <ul>
            <?php foreach ($lines as $line): ?>
                <li class="hour-item"><?php echo htmlspecialchars($line); ?></li>
            <?php endforeach; ?>
        </ul>

<!-- form to change hours for administrators-->
        <?php if (isset($_SESSION['username'])): ?>
        <h2>Update Hours</h2>
        <p>Enter into the text box the hours you want displayed. To see changes refresh page</p>
        <p>These hours will be visible to people who view the site but can only be changed if signed in</p>
        <?php if (isset($message)): ?>
        <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <textarea name="content"><?php echo htmlspecialchars($content); ?></textarea>
            <br>
            <button class="formsubmit" type="submit">Save Changes</button>
        </form>
        <?php endif; ?>
    </div>
</main>
<?php include 'footer.php'; ?>