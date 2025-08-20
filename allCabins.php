<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cabins - SunnySpot Holidays</title>
    <link href="css/Sun_style1.css" rel= "stylesheet" type="text/css">
</head>
<body>
<h1>All Cabins - SunnySpot Holidays</h1>
  <div id="wrapper">
<h1>SunnySide management system</h1>
    <div id="logout" class="logout">
        <a href= "logout.php">Logout>
  <div id="inner-wrapper">  
  <div id="topper">
<nav>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="allCabins.php">All Cabins</a></li>
        <li><a href="adminMenu.php">Admin Menu</a></li>
    </ul>
</nav>
</div>
<table border="1">
        <tr>
            <th>Cabin Type</th>
            <th>Description</th>
            <th>Price Per Night</th>
            <th>Price Per Week</th>
            <th>Photo</th>
        </tr>
<?php

if($conn === FALSE)
    echo "DB connection to $dbName unfortunately failed :(";
else {
    // Query all cabins
    $sqlStmt = "SELECT * FROM cabin";
    $result = mysqli_query($conn, $sqlStmt);

    echo "<!-- Found " . mysqli_num_rows($result) . " rows -->";

    if(mysqli_num_rows($result) > 0) {
        // Display each cabin
        while($details = mysqli_fetch_assoc($result)) {
            echo "<tr>"; // Start a new row for each cabin
            echo "<td>" . htmlspecialchars($details['cabinType']) . "</td>";
            echo "<td>" . htmlspecialchars($details['cabinDescription']) . "</td>";
            echo "<td>$" . number_format($details['pricePerNight'], 2) . "</td>";
            echo "<td>$" . number_format($details['pricePerWeek'], 2) . "</td>";
            // Display photo from images folder
            $photo = !empty($details['photo']) ? htmlspecialchars($details['photo']) : 'testCabin.jpg';
            echo "<td><img src='images/" . $photo . "' alt='Cabin Photo' style='width:100px;'></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No cabins found.</td></tr>"; // If no cabins are found, display a message
    }
    mysqli_close($conn);
}   
?> 
</table>

</body>
</html>