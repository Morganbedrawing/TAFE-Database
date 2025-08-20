<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';
if (!$conn) {
    die("<h1>Database connection failed: " . mysqli_connect_error() . "</h1>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appUser = trim($_POST['username']);
    $appPass = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    if (!$stmt) {
        die("<h1>Database query failed: " . $conn->error . "</h1>");
    }
    $stmt->bind_param("ss", $appUser, $appPass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $_SESSION['username'] = $appUser;
        header('Location: adminMenu.php');
        exit;
    } else {
        $error = "Incorrect login details";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Processing</title>
    <link href="css/Sun_style1.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if (isset($error)) {
    echo "<h1>$error</h1>";
    echo '<a href="login.php">Try again</a>';
}
?>
</body>
</html>