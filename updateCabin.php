<?php
require_once 'db_connect.php';

// Check if the cabin ID is set in the URL
if (isset($_GET['id'])) {
    $cabin_id = $_GET['id'];

    // Fetch the cabin details from the database
    $query = "SELECT * FROM cabin WHERE cabinID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cabin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if cabin exists
    if ($result->num_rows > 0) {
        $cabin = $result->fetch_assoc();
    } else {
        echo "Cabin not found.";
        exit;
    }
} else {
    echo "No cabin ID provided.";
    exit;
}

// Handle form submission for updating the cabin
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cabinType = $_POST['cabinType'];
    $cabinDescription = $_POST['cabinDescription'];
    $pricePerNight = $_POST['pricePerNight'];
    $pricePerWeek = $_POST['pricePerWeek'];

    // Validate input
    if ($pricePerNight <= 0) {
        echo "Price per night must be a positive number.";
    } elseif ($pricePerWeek > 5 * $pricePerNight) {
        echo "Price per week cannot be more than 5 times the price per night.";
    } else {
        // Handle image upload
        $photo = $_FILES['photo']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($photo);
        
        // Check if an image was uploaded
        if (!empty($photo)) {
            // Validate image file type
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowed_types)) {
                echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            } else {
                move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);
            }
        } else {
            // Default image if none uploaded
            $photo = "testCabin.jpg";
        }

        // Update cabin details in the database
        $update_query = "UPDATE cabin SET cabinType = ?, cabinDescription = ?, pricePerNight = ?, pricePerWeek = ?, photo = ? WHERE cabinID = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssddsi", $cabinType, $cabinDescription, $pricePerNight, $pricePerWeek, $photo, $cabin_id);
        $update_stmt->execute();

        echo "Cabin updated successfully.";
        header("Location: allCabins.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Henry's books management system</title>
    <link rel="stylesheet" href="css/Sun_style1.css">
</head>
<body>
<h1>Update a Cabins Details</h1>
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
<body>
    
    <h2>Update Cabin</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="cabinType">Cabin Type:</label>
        <input type="text" name="cabinType" value="<?php echo htmlspecialchars($cabin['cabinType']); ?>" required>
        
        <label for="cabinDescription">Description:</label>
        <textarea name="cabinDescription" required><?php echo htmlspecialchars($cabin['cabinDescription']); ?></textarea>
        
        <label for="pricePerNight">Price per Night:</label>
        <input type="number" name="pricePerNight" value="<?php echo $cabin['pricePerNight']; ?>" required>
        
        <label for="pricePerWeek">Price per Week:</label>
        <input type="number" name="pricePerWeek" value="<?php echo $cabin['pricePerWeek']; ?>" required>
        
        <label for="photo">Cabin Image:</label>
        <input type="file" name="photo">
        
        <input type="submit" value="Update Cabin">
    </form>

</body>
</html>