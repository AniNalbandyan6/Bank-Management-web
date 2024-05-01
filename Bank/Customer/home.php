<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="home.css">
    <title>Home</title>
</head>
<body>
    <?php include 'header.html'; ?>
    <center>
        <h1>Իմ հաշիվը</h1>
            <?php

                require_once "database.php";
                $email = $_POST["email"];
                $email = mysqli_real_escape_string($con, $email);
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($con, $sql);
                $user = mysqli_fetch_assoc($result);
                while(mysqli_fetch_assoc($result)){
                echo "<p style='color: aliceblue; font-size:20px;'>" . $user["name"] . "</p>";
                echo "<p style='color: aliceblue; font-size:20px;'> " . $user["surname"] . "</p>";
                echo "<p style='color: aliceblue; font-size:20px;'>" . $user["card_type"] . "</p>";
                echo "<p style='color: aliceblue; font-size:20px;'> " . $user["card_number"] . "</p>";
                echo "<p style='color: aliceblue; font-size:20px;'>" . $user["pin_code"] . "</p>";
                echo "<p style='color: aliceblue; font-size:20px;'> " . $user["balance"] . "</p>";
                }
        ?>
    </center>
    <?php include 'footer.html'; ?>          
</body>
</html>