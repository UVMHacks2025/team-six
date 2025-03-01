<?php include 'top.php'?>
<body>

    <!-- All  -->
    <div class='graph'>
    <canvas id="Item_Stock"></canvas>
    </div>

    <?php 


        $sql = "SELECT food_type, quantity FROM items";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll();

        // Prepare arrays for food types and quantities
        $food_types = [];
        $quantities = [];

        foreach ($items as $item) {
            $food_types[] = $item['food_type'];   // Food type (labels)
            $quantities[] = $item['quantity'];    // Quantity (data)
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


    <!-- Bottom 5 -->



    <!-- Dynamic Item Sell Chart -->



    
</body>
</html>
<?php include 'footer.php' ?>
