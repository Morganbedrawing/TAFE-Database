<?php
require_once 'db_connect.php';

    $errors = [];
    $success = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cabinType = trim($_POST['cabinType']);
        $cabinDescription = trim($_POST['cabinDescription']);
        $pricePerNight = floatval($_POST['pricePerNight']);
        $pricePerWeek = floatval($_POST['pricePerWeek']);

        // Validate price per night
        if ($pricePerNight <= 0) {
            $errors[] = "Price per night must be a positive number.";
        }
        // Validate price per week
        if ($pricePerWeek > 5 * $pricePerNight) {
            $pricePerWeek = 5 * $pricePerNight; //still includes 5x but as the maximum and no more over. :O
            $errors[] = "Price per week has been adjusted to be no more than 5 times the price per night.";
        }

        // Handle image upload
        $photo = "testCabin.jpg"; // Default
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed)) {
                $photo = uniqid('cabin_') . '.' . $ext;
                move_uploaded_file($_FILES['photo']['tmp_name'], "images/$photo");
            } else {
                $errors[] = "Invalid image file type.";
            }
        }

        // If no errors, insert into DB 
        if (empty($errors)) {
            $stmt = $conn->prepare("INSERT INTO cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdds", $cabinType, $cabinDescription, $pricePerNight, $pricePerWeek, $photo);
            if ($stmt->execute()) {
                $success = "Cabin inserted successfully!";
            } else {
                $errors[] = "Database error: " . $conn->error;
            }
            $stmt->close();
        }
    }
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
<h1>Insert Cabin - SunnySpot Holidays</h1>
  <div id="wrapper">
<h1>SunnySide management system</h1>
    <div id="logout" class="logout">
        <a href= "logout.php">Logout>
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
<div>
    <?php
    if ($errors) {
        echo "<ul class='cabin-errors'>";
        foreach ($errors as $e) echo "<li>$e</li>";
        echo "</ul>";
    }
    if ($success) echo "<p class='cabin-success'>$success</p>";
    ?>
    <form method="post" enctype="multipart/form-data">
        <label>Cabin Type: <input type="text" name="cabinType" required></label><br>
        <label>Description: <textarea name="cabinDescription" required></textarea></label><br>
        <label>Price Per Night: <input type="number" name="pricePerNight" step="0.01" required></label><br>
        <label>Price Per Week: <input type="number" name="pricePerWeek" step="0.01" required></label><br>
        <label>Photo: <input type="file" name="photo" accept="image/*"></label><br>
        <input type="submit" value="Insert Cabin">
    </form>
</body>
</html>