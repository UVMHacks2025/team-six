<?php include 'top.php'?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- Item Specific Chart -->
    <div>
    <canvas id="Item Stock"></canvas>
    </div>

    <?php 

        $food_type = 'cookies';
        $sql = "SELECT quantity FROM items WHERE food_type=$food_type";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll();

        $quantity = $items['quantity'];

    ?>

    

    <script>
    const ctx = document.getElementById('Item Stock');
    var foodName = <?php echo $food_type;?>
    var quantity = <?php echo $quantity;?>

    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: foodName,
        datasets: [{
            label: '# in stock',
            data: quantity,
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
