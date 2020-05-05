<?php

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = $_POST['email'];
    $balance = $_POST['balance'];

    require_once 'connect.php'; 

    $sql = "UPDATE bankcard SET balance ='$balance' WHERE email='$email'";

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