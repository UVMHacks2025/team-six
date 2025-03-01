<!-- index.php -->
<?php include 'top.php'; ?>
<main class="home madimi-one-regular">
    <h1>Rally Cat's Cupboard</h1>
    <h2 class="montserrat-regular">Food Items</h2>
    <!--SEARCH BAR -->
    <section class = "search">
        <input type="text" placeholder="Search..">
    <select id="filterCategory">
            
        <option value="">All Categories</option>

        <option value="Fruit">Fruit</option>
        <option value="Vegetable">Vegetable</option>
        <option value="Protein">Protein</option>
        <option value="Milk Allergy">Milk Allergy</option>
        <option value="Peanut Allergy">Peanut Allergy</option>
        <option value="Treenut Allergy">Treenut Allergy</option>
        <option value="Gluten Allergy">Gluten Allergy</option>
        <option value="Vegan">Vegan</option>
        <option value="Kosher">Kosher</option>
        
    </select>
    </section>
    
    <section class="montserrat-regular">
        <?php
        // Assuming session_start() is called in top.php
        if (isset($_SESSION['username'])) {
        ?>
        <h3>Add New Food Item</h3>
        <table>
            <form action="add_item.php" id="newItem" method="POST">
            <tr class="addData">
                <th colspan="5" class="spanTwoMobile">New Entry</th>
            </tr>
            <tr class="addData">
                <th>Food Type</th>
                <th>Quantity</th>
                <th>Expiration Date</th>
                <th>Allergies</th>
                <th>Dietary Considerations</th>
            </tr>
            <tr class="addData">
                <td>
                <input type="text" id="food_type" name="food_type" placeholder="e.g., Canned Beans" required>
                </td>
                <td>
                <input type="number" id="quantity" name="quantity" min="1" required>
                </td>
                <td>
                <input type="date" id="exp_date" name="exp_date" required>
                </td>
                <td>
                <select id="allergies" name="allergies" required>
                    <option value="">Select Allergy</option>
                    <option value="None">None</option>
                    <option value="Milk">Milk</option>
                    <option value="Peanuts">Peanuts</option>
                    <option value="Treenuts">Treenuts</option>
                    <option value="Gluten">Gluten</option>
                </select>
                </td>
                <td>
                <select id="dietary_considerations" name="dietary_considerations" required>
                    <option value="">Select Dietary Option</option>
                    <option value="None">None</option>
                    <option value="Vegetarian">Vegetarian</option>
                    <option value="Vegan">Vegan</option>
                    <option value="Kosher">Kosher</option>
                    <option value="Halal">Halal</option>
                </select>
                </td>
            </tr>
            <tr class="addData">
                <td colspan="5" class="spanTwoMobile">
                <input type="submit" value="Add Item">
                </td>
            </tr>
            </form>
        </table>
        <!-- closing bracket for if statement -->
        <?php
        }
        ?>
    </section>

    <section class = "table montserrat-regular">
    <table>
        <tr>
            <th>Food Type</th>
            <th>Quantity</th>
            <th>Expiration Date</th>
            <th>Allergies</th>
            <th>Dietary Considerations</th>
        </tr>
        <?php
        $sql = 'SELECT * FROM items ORDER BY exp_date ASC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll();
        foreach ($items as $item) {
            print '<tr>';
            print '<td>' . htmlspecialchars($item['food_type']) . '</td>';
            print '<td>' . htmlspecialchars($item['quantity']) . '</td>';
            print '<td>' . htmlspecialchars($item['exp_date']) . '</td>';
            print '<td>' . htmlspecialchars($item['allergies']) . '</td>';
            print '<td>' . htmlspecialchars($item['dietary_considerations']) . '</td>';
            print '</tr>';
        }
        ?>
    </table>

    </div>
    </section>
</main>
<?php include 'footer.php'; ?>