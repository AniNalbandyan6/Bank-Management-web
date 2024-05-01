<?php
require_once "database.php";

function check($cardNum){
    $cardNum = str_replace(' ', '', $cardNum); 
    $sum = 0;

    for ($i = 0; $i < 16; $i++) {
        $digit = intval($cardNum[$i]);

        if ($i % 2 == 0) {
            $digit *= 2;
            if ($digit > 9) {
                $digit = $digit % 10 + intval($digit / 10);
            }
        }

        $sum += $digit;
    }

    return $sum % 10 == 0;
}

function generate(){
    global $con;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $s = '';
    $card_number = '';

    switch ($user["card_type"]) {
        case 'Visa':
            $s = '4';
            break;
        case 'Mastercard':
            $s = '5';
            break;
        case 'ArCa':
            $s = '9';
            break;
    }

    do {
        $acc = '';
        for ($i = 0; $i < 16; $i++) {
            $acc .= mt_rand(0, 9);
        }

        $card_number = $s . $acc;
    } while (!check($card_number));

    return $card_number;
}
?>
