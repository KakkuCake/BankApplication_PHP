<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $account_number = $_POST['account_number'];

    require_once 'connect.php';

    $sql_1 = "SELECT * FROM regularaccounts WHERE account_number='$account_number' ";
    $sql_2 = "SELECT * FROM creditaccounts WHERE account_number='$account_number' ";
    $sql_3 = "SELECT * FROM savingsaccounts WHERE account_number='$account_number' ";

    $response_1 = mysqli_query($conn, $sql_1);
    $response_2 = mysqli_query($conn, $sql_2);
    $response_3 = mysqli_query($conn, $sql_3);

    $result = array();
    $result['account_found'] = array();
    
    if (mysqli_num_rows($response_1) === 1) {
        
        $row = mysqli_fetch_assoc($response_1);
            
        $index['balance'] = $row['balance'];
        array_push($result['account_found'], $index);

        $result['success'] = "1";
        $result['message'] = "success";

        echo json_encode($result);
        mysqli_close($conn);

    } else if (mysqli_num_rows($response_2) === 1) {

        $row = mysqli_fetch_assoc($response_2);
            
        $index['balance'] = $row['balance'];
        array_push($result['account_found'], $index);

        $result['success'] = "1";
        $result['message'] = "success";

        echo json_encode($result);
        mysqli_close($conn);


    } else if (mysqli_num_rows($response_3) === 1) {

        $row = mysqli_fetch_assoc($response_3);
            
        $index['balance'] = $row['balance'];
        array_push($result['account_found'], $index);

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