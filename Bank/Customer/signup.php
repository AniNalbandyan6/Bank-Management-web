

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Sign up</title>
</head>
<body>
    <center>    
        <div id="container">

            <?php

            require_once "cardnum.php";

                if(isset($_POST["submit"])){

                    $name = $_POST["name"];
                    $surname = $_POST["surname"];
                    $email = $_POST["email"];
                    $passwd = $_POST["password"];  
                    $card_type = $_POST["cardtype"];  
                    $hashed_pass = password_hash($passwd, PASSWORD_DEFAULT);
                    $balance = 0;
                    $pin_code = sprintf("%04d", mt_rand(0, 9999));
                    $errors = array();

                    if (empty( $name) OR empty( $surname) OR empty($email) OR empty($passwd)) {
                        array_push($errors, "Բոլոր դաշտերը պարտադիր են");
                    }
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push($errors, "Էլ․ հասցեն գործող չէ");
                    }
                    if (strlen($passwd)<8) {
                        array_push($errors, "Գաղտնաբառը պետք է լինի առնվազն 8 նիշից");
                    }
                  

                    require_once "database.php";
                
                    if (count($errors)>0) {
                        foreach($errors as $error){
                            echo "<div class='alert' 
                            style=' width: 300px;
                            height: 30px;
                            background: rgb(189,0,0);
                            background: linear-gradient(90deg, rgba(189,0,0,1) 17%, rgba(121,9,13,0.7091211484593838) 49%, rgba(255,0,0,1) 100%);
                            color: aliceblue;
                            align-content: center;
                            border-radius: 1%;
                            margin: 10px;'>$error</div>";
                        }
                    }else{
                        $sql = "INSERT INTO users VALUES (null, '$name', '$surname', '$email', '$hashed_pass', '$card_type', null, '$pin_code', '$balance')";
                        $x = mysqli_query($con, $sql);
                        if ($x) {
                            $card_number = generate();
                            $sql_update = "UPDATE users SET card_number = '$card_number' WHERE email = '$email'";
                            mysqli_query($con, $sql_update);
                            echo "<div class='inform' 
                            style=' width: 300px;
                            height: 30px;
                            background: rgb(0,75,12);
                            background: linear-gradient(90deg, rgba(0,75,12,1) 17%, rgba(9,121,33,0.7091211484593838) 49%, rgba(0,150,12,1) 100%);
                            color: aliceblue;
                            align-content: center;
                            border-radius: 1%;'>Դուք հաջողությամբ գրանցվեցիք</div>";
                        }else{
                            echo "<div class='alert' 
                            style=' width: 300px;
                            height: 30px;
                            background: rgb(189,0,0);
                            background: linear-gradient(90deg, rgba(189,0,0,1) 17%, rgba(121,9,13,0.7091211484593838) 49%, rgba(255,0,0,1) 100%);
                            color: aliceblue;
                            align-content: center;
                            border-radius: 1%;'>Տեղի է ունեցել սխալ</div>";
                        }
                    }
                }
            ?>
            <h1>Ստեղծել նոր հաշիվ</h1>
            <form method="post">
                <input type="text" class="form" name="name" placeholder="Անուն"><br><br>
                <input type="text" class="form" name="surname" placeholder="Ազգանուն"><br><br>
                <input type="text" class="form" name="email" placeholder="Էլ․ հասցե"><br><br>              
                <input type="password" class="form" name="password" placeholder="Գաղտնաբառ"><br><br>
                <select name="cardtype">
                    <option value="">Ընտրեք քարտի տեսակը</option>
                    <option value="Visa">Visa</option>
                    <option value="Mastercard">Mastercard</option>
                    <option value="ArCa">ArCa</option>
                </select><br><br>  
                <button id="btn" value="submit" name="submit">Հաստատել</button>
                <a href="login.php">Վերադառնալ մուտքի էջ</a>
            </form>
        </div>
    </center>
</body>
</html>
