<?php 
include 'top.php'; 
// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=" . urlencode("Please log in to view logs."));
    exit;
}
?>
<main class="logs madimi-one-regular">
    <h2>Item Logs</h2>
    <table>
        <tr>
            <th>Log ID</th>
            <th>Food Item</th>
            <th>Action</th>
            <th>User</th>
            <th>Date</th>
        </tr>
        <?php
        // Join item_log with items and users to display meaningful data
        $sql = "SELECT il.id AS log_id, i.food_type, il.action, u.username, il.action_date
                FROM item_log il
                JOIN items i ON il.item_id = i.id
                JOIN users u ON il.user_id = u.id
                ORDER BY il.action_date DESC
                ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($logs as $log) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($log['log_id']) . '</td>';
            echo '<td>' . htmlspecialchars($log['food_type']) . '</td>';
            echo '<td>' . htmlspecialchars($log['action']) . '</td>';
            echo '<td>' . htmlspecialchars($log['username']) . '</td>';
            echo '<td>' . htmlspecialchars($log['action_date']) . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</main>
<?php include 'footer.php'; ?>