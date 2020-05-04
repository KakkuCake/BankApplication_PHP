<?php

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $id = $_POST['id'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    require_once 'connect.php'; 

    $sql = "UPDATE bank1 SET first_name='$first_name', last_name='$last_name', password='$password' WHERE id='$id'";

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