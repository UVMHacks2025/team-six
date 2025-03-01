<?php include 'top.php' ?>
<main class="logs madimi-one-regular">
    <h2>Requests</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Item 1</th>
            <th>Item 2</th>
            <th>Item 3</th>
            <th>Date Made</th>
        </tr>
        <?php
            $sql = "SELECT * FROM requests";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $items = $stmt->fetchAll();

            foreach ($items as $item) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($item['id']) . '</td>';
                echo '<td>' . htmlspecialchars($item['name']) . '</td>';
                echo '<td>' . htmlspecialchars($item['email']) . '</td>';
                echo '<td>' . htmlspecialchars($item['item1']) . '</td>';
                echo '<td>' . htmlspecialchars($item['item2']) . '</td>';
                echo '<td>' . htmlspecialchars($item['item3']) . '</td>';
                echo '<td>' . htmlspecialchars($item['request_date']) . '</td>';
                echo '</tr>';
            }
        ?>
        
    </table>
</main>

<?php include 'footer.php'?>
