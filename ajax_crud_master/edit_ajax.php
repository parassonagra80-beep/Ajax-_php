<?php
require_once "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id            = $_POST['id'] ?? '';
    $first_name    = $_POST['first_name'] ?? '';
    $last_name     = $_POST['last_name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $gender        = $_POST['gender'] ?? '';

    $sql = "UPDATE user_list_1 SET first_name='$first_name',last_name='$last_name',email='$email',gender='$gender' WHERE id='$id'";
    // echo "<pre>";
    // print_r($sql);
    // exit(' CALL');
    if (mysqli_query($con, $sql)) {
        $response = ['status' => 1, 'msg' => 'data update successfully'];
    } else {
        $response = ['status' => 0, 'msg' => 'data cannot save'];
    }
    echo json_encode($response);
    exit;
}
