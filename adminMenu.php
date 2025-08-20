<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link rel="stylesheet" href="css/Sun_style1.css">
</head>
<body>
<h1>Main menu</h1>
<div id="wrapper">
    <h1>SunnySide management system</h1>
    <div id="logout" class="logout">
        <a href="logout.php">Logout</a>
    </div>
    <div id="inner-wrapper">  
        <div id="topper">
            <nav>
                <ul>
                    <li><a href="adminMenu.php">Home Menu</a></li>
                    <li><a href="allCabins.php">All Cabins</a></li>
                    <li><a href="insertCabin.php">Insert a new Cabin</a></li>
                    <li><a href="updateCabin.php">Update a cabin</a></li>
                    <li><a href="deleteCabin.php">Delete a cabin</a></li>
                </ul>
            </nav>
            <div>
                <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']); ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>