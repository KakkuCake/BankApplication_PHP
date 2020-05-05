<?php

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = $_POST['email'];
    $card_number = $_POST['card_number'];
    $balance = $_POST['balance'];
    $withdraw_limit = $_POST['withdraw_limit'];

    require_once 'connect.php'; 

    $sql = "INSERT INTO bankcard (email, card_number, balance, withdraw_limit) VALUES ('$email', '$card_number', '$balance', '$withdraw_limit')";

    if(mysqli_query($conn, $sql)) {

          $result["success"] = "1";
          $result["message"] = "success";

          echo json_encode($result);
          mysqli_close($conn);
          
    } else{

        $result["success"] = "0";
        $result["message"] = "error";
        echo json_encode($result);

        mysqli_close($conn);

        }

    
}

?>