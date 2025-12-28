<?php
require_once "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id            = $_POST['id'] ?? '';
    $fname    = $_POST['first_name'] ?? '';
    $lname     = $_POST['last_name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $phone        = $_POST['phone'] ?? '';

    $sql = "UPDATE users SET fname='$fname',lname='$lname',email='$email',phone='$phone' WHERE id='$id'";
    // echo "<pre>";
    // print_r($sql);
    // exit(' CALL');
    if (mysqli_query($conn, $sql)) {
        $response = ['status' => 1, 'msg' => 'data update successfully'];
    } else {
        $response = ['status' => 0, 'msg' => 'data cannot save'];
    }
    echo json_encode($response);
    exit;
}
