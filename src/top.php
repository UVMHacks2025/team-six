<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts = pathinfo($phpSelf);
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Rally Cat's Cupboard</title>
        <link rel="icon" type="image/x" href="./public/images/rallycat_final_icon.png">
        <meta name="author" content="UVM Hackathon Team 6">
        <meta name="description" content="Rally Cat's Cupboard is UVM's on-campus food pantry. Located on the first floor of the Davis Center, it is run by students and available to all members of the UVM community. They receive donations from groups ranging from local grocery stores, to individual donations. ">
        
        <meta name="viewport" content="width=device-width, 
        initial-scale=1.0">

        <link href="css/custom.css?version=<?php print time(); ?>" 
            rel="stylesheet" 
            type="text/css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


        <!-- LEAVE THESE HERE RN
        <link href="css/layout-desktop.css?version=" 
            rel="stylesheet" 
            type="text/css">

        <link href="css/layout-tablet.css?version" 
            media="(max-width: 820px)"
            rel="stylesheet" 
            type="text/css">

        <link href="css/layout-phone.css?version=" 
            media="(max-width: 430px)"
            rel="stylesheet" 
            type="text/css">
        -->

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet">

        <link rel="icon" href="favicon.ico">
    </head>
    <?php
    print '<body class="' . $pathParts['filename'] . '">';
    print '<!-- #################   Body element    ################# -->';
    include 'connect-db.php';
    include 'nav.php';
    ?>