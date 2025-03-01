<!-- index.php -->
<?php include 'top.php'; ?>
<main>
    <h2>Food Items</h2>
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
</main>
<?php include 'footer.php'; ?>