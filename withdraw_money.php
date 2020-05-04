<?php

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $account_number= $_POST['account_number'];
    $balance = $_POST['balance'];
    
    require_once 'connect.php';

    $sql_1 = "SELECT * FROM regularaccounts WHERE account_number='$account_number' ";
    $sql_2 = "SELECT * FROM creditaccounts WHERE account_number='$account_number' ";

    $response_1 = mysqli_query($conn, $sql_1);
    $response_2 = mysqli_query($conn, $sql_2);

    
    if (mysqli_num_rows($response_1) === 1) {  

        $sql_4 = "UPDATE regularaccounts SET balance ='$balance' WHERE account_number='$account_number'";

        if (mysqli_query($conn, $sql_4)) {

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

    } else if (mysqli_num_rows($response_2) === 1) {

        $sql_5 = "UPDATE creditaccounts SET balance ='$balance' WHERE account_number='$account_number'";

        if (mysqli_query($conn, $sql_5)) {

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

    } else {

        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);

    }
}

?>