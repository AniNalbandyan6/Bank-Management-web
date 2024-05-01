<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Log in</title>
</head>
<body>
    <center>    
        <div id="container">
            <?php
                if(isset($_POST["login"])){
                    $email = $_POST["email"];
                    $passwd = $_POST["passwd"];  
                    require_once "database.php";
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($con, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if ($user) {
                        if(password_verify($passwd, $user["passwd"])){
                            header("Location: home.php");
                            die();
                        }
                    }else{
                        echo "<div class='alert' 
                        style=' width: 300px;
                        height: 30px;
                        background: rgb(189,0,0);
                        background: linear-gradient(90deg, rgba(189,0,0,1) 17%, rgba(121,9,13,0.7091211484593838) 49%, rgba(255,0,0,1) 100%);
                        color: aliceblue;
                        align-content: center;
                        border-radius: 1%;'
                        >Գաղտնաբառը չի համընկնում</div>";
                    }
                }
            ?>
            <h1>Մուտք</h1>
            <form method="post" action="">
                <input type="text" name="email" placeholder="Էլ․ հասցե"><br><br>
                <input type="password" name="passwd" placeholder="Գաղտնաբառ"><br><br>
                <button id="btn" value="login" name="login">Հաստատել</button>
                <a href="">Ադմին</a><br><br>
                <a href="signup.php">Ստեղծել հաշիվ</a>
            </form>
        </div>
    </center>
</body>
</html>