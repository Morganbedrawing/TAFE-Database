<?php
require_once 'db_connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// Optional: session check
// if (!isset($_SESSION['username'])) {
//     header('Location: login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Cabin</title>
    <link rel="stylesheet" href="css/Sun_style1.css">
</head>
<body>
<h1>All Cabins</h1>
<div id="wrapper">
<form action="showRecToDeleteCabin.php" method="post">
<table border="1">
    <tr>
        <th>Cabin ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Delete</th>
    </tr>
<?php
require_once 'db_connect.php';
if ($conn === FALSE) {
    echo "DB connection to $dbName failed :(";
} else {
    $sqlStmt = "SELECT * FROM cabin";
    $result = mysqli_query($conn, $sqlStmt);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($details = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $details['cabinID'] . "</td>";
            echo "<td>" . $details['name'] . "</td>";
            echo "<td>" . $details['type'] . "</td>";
            echo "<td>" . $details['price'] . "</td>";
            echo "<td><input type='radio' name='rbtDelete' value='" . $details['cabinID'] . "'></td>";
            echo "</tr>";
        }
        echo "<tr><td colspan='5'><input type='submit' value='Choose record to delete'></td></tr>";
    } else {
        echo "<tr><td colspan='5'>Table was empty</td></tr>";
    }
    mysqli_close($conn);
}
?>
</table>
</form>
</div>
</body>
</html>