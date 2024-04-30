<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <title>Home</title>
</head>
<body>
    <div id="header">
        <ul>
            <li><a href="services.php">Ծառայություններ</a></li>
            <li><a href="home.php">Իմ հաշիվը</a></li>
        </ul>
    </div>
        <center>
        <h1>Իմ հաշիվը</h1>
        <?php
    // Check if email and password are provided in the URL parameters
        require_once "database.php";
        $sql = "SELECT * FROM users";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        while(mysqli_fetch_assoc($result)){
            echo "<p style='color: aliceblue; font-size:20px;'>" . $user["name"] . "</p>";
            echo "<p style='color: aliceblue; font-size:20px;'> " . $user["surname"] . "</p>";
        }
    ?>
    </center>
    <div id="footer">
        <h6>All rigths reserved</h6>
    </div>
</body>
</html>