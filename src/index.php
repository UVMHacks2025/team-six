<!-- index.php -->
<?php include 'top.php'; ?>
<main class="home madimi-one-regular">
    <h2>Food Items</h2>
    <h1>Rally Cat's Cupboard</h1>
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
    </select>
    </section>

    <section class = "table">
    <table>
        <tr>
            <th>Food Type</th>
            <th>Quantity</th>
            <th>Expiration Date</th>
            <th>Location</th>
            <th>Allergies</th>
            <th>Dietary Considerations</th>
        </tr>
        <?php
        $sql = 'SELECT * FROM items ORDER BY exp_date ASC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll();
        foreach ($items as $item) {
            print '<tr class="hover">';
            print '<td>' . htmlspecialchars($item['food_type']) . '</td>';
            print '<td>' . htmlspecialchars($item['quantity']) . '</td>';
            print '<td>' . htmlspecialchars($item['exp_date']) . '</td>';
            print '<td>' . htmlspecialchars($item['location']) . '</td>';
            print '<td>' . htmlspecialchars($item['allergies']) . '</td>';
            print '<td>' . htmlspecialchars($item['dietary_considerations']) . '</td>';
            print '</tr>';
        }
        ?>
    </table>
    </section>
</main>
<?php include 'footer.php'; ?>