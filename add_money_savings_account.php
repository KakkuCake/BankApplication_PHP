<?php

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $account_number = $_POST['account_number'];
    $balance = $_POST['balance'];

    require_once 'connect.php'; 

    $sql = "UPDATE savingsaccounts SET balance ='$balance' WHERE account_number='$account_number'";

    if(mysqli_query($conn, $sql)) {

          $result["success"] = "1";
          $result["message"] = "success";

          echo json_encode($result);
          mysqli_close($conn);
          
    } else{

        $result["success"] = "0";
        $result["message"] = "error!";
        echo json_encode($result);

        mysqli_close($conn);

        }

    
}

?>