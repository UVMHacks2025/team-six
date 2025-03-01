<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts = pathinfo($phpSelf);
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>WEB SITE TITLE</title>
        <link rel="icon" type="image/x-icon" href="images/bike.jpg">
        <meta name="author" content="UVM Hackathon Team 6">
        <meta name="description" content="WEB SITE DESCRIPTION">
        
        <meta name="viewport" content="width=device-width, 
        initial-scale=1.0">

        <link href="css/custom.css?version=<?php print time(); ?>" 
            rel="stylesheet" 
            type="text/css">

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
    include 'header.php';
    include 'nav.php';
    ?>