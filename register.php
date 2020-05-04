<?php

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    require_once 'connect.php';

    $sql_1 = "SELECT * FROM bank1 WHERE email='$email' ";

    $response = mysqli_query($conn, $sql_1);
    
    if ( mysqli_num_rows($response) === 1) {  //Tarkistetaan ettei sähköpostia löydy jo tietokannasta.

            $result['success'] = "-1";
            $result['message'] = "error";
            echo json_encode($result);

            mysqli_close($conn);

    } else {

        $sql_2 = "INSERT INTO bank1 (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

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