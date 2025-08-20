<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/Sun_style1.css" rel= "stylesheet" type="text/css">
    <title>Login SunnySpot</title>
</head>
<body>
    <h1>Login</h1>
    <div id="wrapper">
    <form action="processLogin.php" method="post" name="frmLogin">
        <table>
            <tr>
                <th><label for="username">User name</label></th>
                <td><input type="text" name="username" id="username" placeholder="Enter user name" required></td>
            </tr>
            <tr>
                <th><label for="password">Password</label></th>
                <td><input type="password" name="password" id="password" placeholder="Enter password" required></td>
            </tr>
            <tr>
                <th colspan="2">                    
                    <input type="submit" value="Login">
                </th>
            </tr>
        </table>
</form>
</div>
</body>
</html>