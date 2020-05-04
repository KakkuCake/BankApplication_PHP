<?php

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $email = $_POST['email'];
    $account_number= $_POST['account_number'];
    $balance = $_POST['balance'];
    $credit = $_POST['credit'];
    
    require_once 'connect.php';

    $sql_1 = "SELECT * FROM creditaccounts WHERE account_number='$account_number' ";
    $sql_2 = "SELECT * FROM creditaccounts WHERE email='$email' ";


    $response_1 = mysqli_query($conn, $sql_1);
    $response_2 = mysqli_query($conn, $sql_2);
    
    if (mysqli_num_rows($response_1) === 1) {  //Tarkistetaan ettei tilinumero ole jo käytössä.

        $result['success'] = "-1";
        $result['message'] = "error";
        
        echo json_encode($result);
        mysqli_close($conn);

    } else {

        if (mysqli_num_rows($response_2) === 1) { //Tarkistetaan ettei käyttäjälle ole jo luottotiliä (1 luottotili/käyttäjä)

            $result['success'] = "-2";
            $result['message'] = "error";
            
            echo json_encode($result);
            mysqli_close($conn);

        } else {

            $sql_3 = "INSERT INTO creditaccounts (email, account_number, balance, credit) VALUES ('$email', '$account_number', '$balance', '$credit')";

            if ( mysqli_query($conn, $sql_3) ) {
                $result["success"] = "1";
                $result["message"] = "success";

                echo json_encode($result);
                mysqli_close($conn);

            } else {

                $result["success"] = "0";
                $result["message"] = "error";

                echo json_encode($result);
                mysqli_close($conn);
            }

        }

    }
    
}

?>