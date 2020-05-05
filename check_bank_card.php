<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $email = $_POST['email'];

    require_once 'connect.php';

    $sql = "SELECT * FROM bankcard WHERE email='$email' ";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['card_found'] = array();
    
    if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);
            
        $index['card_number'] = $row['card_number'];
        $index['balance'] = $row['balance'];
        $index['withdraw_limit'] = $row['withdraw_limit'];

        array_push($result['card_found'], $index);

        $result['success'] = "1";
        $result['message'] = "success";

        echo json_encode($result);
        mysqli_close($conn);

     } else {

            $result['success'] = "0";
            $result['message'] = "error";
            echo json_encode($result);

            mysqli_close($conn);

        }

    }

?>