<?php
require_once 'conn.php';
$id = $_GET['id'] ?? '';
$response = ['status' => 0, 'msg' => 'Invalid request'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['type']) && $_POST['type'] == 'add_edit') {
    
    $id = $_POST['id'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $gender = $_POST['gender'] ?? '';
    // print_r($id);
    // exit;
    if ($id) {
        $sql = "UPDATE users SET full_name='$full_name',email='$email',phone='$phone',gender='$gender' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO users (full_name,email,phone,gender) VALUES('$full_name','$email','$phone','$gender')";
    }
    if (mysqli_query($conn, $sql)) {
        $response = ["status" => 1, "msg" => "data saved successfully"];
    } else {
        $response = ["status" => 2, "msg" => "data can't save"];
    }
    echo json_encode($response);
    exit;
    }

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['type'] ?? '') == 'delete') {
    $id = $_POST['id'] ?? '';
        $sql = "DELETE FROM users WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            $response = ['status' => 1, 'msg' => 'Data deleted successfully'];
        } else {
            $response = ['status' => 0, 'msg' => 'Error deleting data'];
        }
    echo json_encode($response);
    exit;
}

?>