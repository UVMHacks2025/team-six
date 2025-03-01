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
    <canvas id="Item_Stock"></canvas>
    </div>

    <?php 

        // $food_type = 'Canned Beans';  // Set food type

        // // Use a placeholder for the food type
        // $sql = "SELECT quantity FROM items WHERE food_type = :food_type";
        // $stmt = $pdo->prepare($sql);

        // // Bind the food_type parameter to the prepared statement
        // $stmt->bindParam(':food_type', $food_type, PDO::PARAM_STR);

        // // Execute the statement
        // $stmt->execute();

        // // Fetch the first row
        // $item = $stmt->fetch();


        // if ($item) {
        //     $quantity = $item['quantity'];
        // } else {
        //     $quantity = 0;  // If no item is found, set quantity to 0
        // }


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
    const ctx = document.getElementById('Item_Stock').getContext('2d');

    // Passing the PHP arrays into JavaScript
    var foodNames = <?php echo json_encode($food_types); ?>;  // Food types as labels
    var quantities = <?php echo json_encode($quantities); ?>;  // Quantities as data

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: foodNames,  // Food types (x-axis labels)
            datasets: [{
                label: '# in stock',
                data: quantities,   // Quantities (y-axis data)
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


    
    // // Ensure foodName is treated as a string and quantity as a number



    // new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: [foodName],  // Labels should be an array
    //         datasets: [{
    //             label: '# in stock',
    //             data: [quantity],   // Data should be in an array
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });
</script>


    <!-- Bottom 5 -->



    <!-- Dynamic Item Sell Chart -->



    
</body>
</html>
<?php include 'footer.php' ?>
