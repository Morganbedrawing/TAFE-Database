<?php
session_start();
session_unset();
session_destroy();
header("Location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout of SunnySpot</title>
    <link href="css/Sun_style1.css" rel= "stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
    <h1>Thanks for using our services</h1>
    <div id="inner-wrapper">
        Logged out successfully
    </div>
</body>
</html>