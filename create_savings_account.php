<?php

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $email = $_POST['email'];
    $account_number= $_POST['account_number'];
    $balance = $_POST['balance'];
    
    require_once 'connect.php';

    
    $sql_1 = "SELECT * FROM savingsaccounts WHERE email='$email' ";

    $response = mysqli_query($conn, $sql_1);
    
    if ( mysqli_num_rows($response) === 1) {  // Tarkistetaan ettei käyttäjä ole jo luonut savingsaccount -tiliä.

        $result['success'] = "-1";
        $result['message'] = "error";
        echo json_encode($result);

        mysqli_close($conn);

    } else {

        $sql_2 = "INSERT INTO savingsaccounts (email, account_number, balance) VALUES ('$email', '$account_number', '$balance')";

        if ( mysqli_query($conn, $sql_2) ) {
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


?>
