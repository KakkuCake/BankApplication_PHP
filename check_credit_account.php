<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $email = $_POST['email'];

    require_once 'connect.php';

    $sql = "SELECT * FROM creditaccounts WHERE email='$email' ";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['credit_account_found'] = array();
    
    if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);
            
        $index['account_number'] = $row['account_number'];
        $index['balance'] = $row['balance'];
        $index['credit'] = $row['credit'];

        array_push($result['credit_account_found'], $index);

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