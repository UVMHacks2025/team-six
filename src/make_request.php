<?php include 'top.php'?>
<main class="home madimi-one-regular">
    <section class="add-request">
    <!-- <form action="script.php" method="post"> -->
    
        <label for="test">Enter your name:</label>
        <input type="text" id="name" required><br><br>
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" required><br><br>


        <?php
            $sql = "SELECT food_type FROM items";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $items = $stmt->fetchAll();

            $food_types = [];
            $quantities = [];

            foreach ($items as $item) {
                $food_types[] = $item['food_type'];
            }
        ?>


        <label for="items">Choose up to 3 items:</label>
        <br><br>
        <input list="items" id="item" name="item" required>
        <datalist id="items">
            <?php
                foreach ($food_types as $food_type) {
                    echo "<option value=\"$food_type\">";
                }
            ?>
        </datalist><br><br>

        <input list="items" id="item" name="item"">
        <datalist id="items">
            <?php
                foreach ($food_types as $food_type) {
                    echo "<option value=\"$food_type\">";
                }
            ?>
        </datalist><br><br>

        <input list="items" id="item" name="item">
        <datalist id="items">
            <?php
                foreach ($food_types as $food_type) {
                    echo "<option value=\"$food_type\">";
                }
            ?>
        </datalist><br><br>

        <input type="submit" value="Submit">
    <!-- </form> -->
    </section>
</main>
<?php include 'footer.php'?>