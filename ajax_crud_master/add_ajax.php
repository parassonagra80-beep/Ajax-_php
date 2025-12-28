<?php 
require_once "conn.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $first_name    = $_POST['first_name'] ?? '';
    $last_name     = $_POST['last_name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $password      = $_POST['password'] ?? '';
    $gender        = $_POST['gender'] ?? '';
    $password_hash = password_hash($password,PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_list_1 (first_name,last_name,email,password,gender)
    VALUES ('$first_name','$last_name','$email','$password_hash','$gender')";

    if(mysqli_query($con,$sql)){
        $response = ['status' => 1, 'msg' => 'data saved successfully'];
    }else{
        $response = ['status' => 0, 'msg' => 'data cannot save'];
    }
    echo json_encode($response);
    exit;
}
?>

