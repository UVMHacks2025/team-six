<?php include 'top.php'?>

    <div class='graph'>
    <canvas id="Item_Stock"></canvas>
    </div>

    <?php 

        $sql = "SELECT food_type, quantity FROM items";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll();

        $food_types = [];
        $quantities = [];

        foreach ($items as $item) {
            $food_types[] = $item['food_type'];   
            $quantities[] = $item['quantity'];  
        }
    ?>

<script>
    const ctx = document.getElementById('Item_Stock');


    var foodNames = <?php echo json_encode($food_types); ?>; 
    var quantities = <?php echo json_encode($quantities); ?>; 

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: foodNames, 
            datasets: [{
                label: '# in stock',
                data: quantities,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>

</body>
<?php include 'footer.php' ?>
