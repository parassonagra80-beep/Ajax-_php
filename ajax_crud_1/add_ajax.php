<?php
require_once "conn.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST["first_name"] ?? '';
    $lname = $_POST["last_name"] ?? '';
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"]?? '';

    $sql = "INSERT INTO users(fname,lname,email,phone) VALUES('$fname','$lname','$email','$phone')";
    
    if (mysqli_query($conn, $sql)) {
        $response = ["status" => 1, "msg" => "data saved successfully"];
    } else {
        $response = ["status" => 2, "msg" => "data can't save"];

    }
    echo json_encode($response);
    exit;
}
?>