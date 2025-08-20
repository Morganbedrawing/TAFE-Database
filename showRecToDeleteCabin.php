<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rbtDelete'])) {
    $cabinID = $_POST['rbtDelete'];

    // Get cabin details for confirmation
    $stmt = $conn->prepare("SELECT * FROM cabin WHERE cabinID = ?");
    $stmt->bind_param("i", $cabinID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $cabin = $result->fetch_assoc();
        echo "<h2>Are you sure you want to delete this cabin?</h2>";
        echo "<ul>";
        echo "<li><strong>ID:</strong> " . htmlspecialchars($cabin['cabinID']) . "</li>";
        echo "<li><strong>Name:</strong> " . htmlspecialchars($cabin['name']) . "</li>";
        echo "<li><strong>Type:</strong> " . htmlspecialchars($cabin['type']) . "</li>";
        echo "<li><strong>Price:</strong> " . htmlspecialchars($cabin['price']) . "</li>";
        echo "</ul>";
        echo '<form method="post" action="">
                <input type="hidden" name="confirmDelete" value="' . htmlspecialchars($cabinID) . '">
                <input type="submit" value="Yes, Delete">
              </form>';
        echo '<a href="deleteCabin.php">Cancel</a>';
    } else {
        echo "<h2>Cabin not found.</h2>";
        echo '<a href="deleteCabin.php">Back</a>';
    }
    $stmt->close();
} elseif (isset($_POST['confirmDelete'])) {
    $cabinID = $_POST['confirmDelete'];
    $stmt = $conn->prepare("DELETE FROM cabin WHERE cabinID = ?");
    $stmt->bind_param("i", $cabinID);
    if ($stmt->execute()) {
        echo "<h2>Cabin deleted successfully.</h2>";
    } else {
        echo "<h2>Error deleting cabin.</h2>";
    }
    echo '<a href="deleteCabin.php">Back to Cabin List</a>';
    $stmt->close();
} else {
    echo "<h2>No cabin selected.</h2>";
    echo '<a href="deleteCabin.php">Back</a>';
}

$conn->close();
?>