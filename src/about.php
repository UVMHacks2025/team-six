<?php include 'top.php'; ?>
<main class="home madimi-one-regular">
    <h1>About The Cupboard</h1>
    <a href="https://www.uvm.edu/cals/foodsystems/rally-cats-cupboard">Uvm Organization Page</a>
    <?php
    $filename = "public/texts/hours.txt";  //path to the file
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    } else {
        $lines = ["No hours available."];
    }
    ?>
    <div class="hours-container">
        <h2>Hours of Operation</h2>
        <ul>
            <?php foreach ($lines as $line): ?>
                <li class="hour-item"><?php echo htmlspecialchars($line); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <h2>Staff</p>


</main>
<?php include 'footer.php'; ?>