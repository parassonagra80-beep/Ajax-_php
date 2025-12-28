<?php
require_once "conn.php";
$image = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'add_edit') {
    $id = $_POST['id'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $gender = $_POST['gender'] ?? '';
    $language = implode(',', $_POST['language'] ?? '');
    $old_image = trim($_POST['old_image'] ?? '');
    $image = $_POST['old_image'] ?? '';

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file_name = time() . $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        if ($id && $image) {
            $uploadedFile = "uploads/$old_image";
            unlink($uploadedFile);
        }
        move_uploaded_file($tmp_name, 'uploads/' . $file_name);
        $image = $file_name;
    }
    if ($id) {
        $sql = "UPDATE users SET full_name='$full_name', email='$email', password='$password', gender = '$gender',language='$language',image='$image' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO users (full_name,email,password,gender,language,image) VALUES('$full_name','$email','$password','$gender','$language','$image')";
    }
    if (mysqli_query($conn, $sql)) {
        $response = ["status" => 1, "msg" => "data saved successfully"];
    } else {
        $response = ["status" => 2, "msg" => "data can't save"];
    }
    echo json_encode($response);
    exit;
    // }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $response = ['status' => 1, 'data' => $data];
    } else {
        $response = ['status' => 0, 'data' => []];
    }
   
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['type'] ?? '') == 'delete') {
    $id = $_POST['id'] ?? '';
    $get_sql = "SELECT * FROM users WHERE id='$id'";
    $get_result = mysqli_query($conn, $get_sql);
    if (mysqli_num_rows($get_result) > 0) {
        $data = mysqli_fetch_array($get_result, MYSQLI_ASSOC);
    }
    $image = $data["image"] ?? '';

    $sql = "DELETE FROM users WHERE id = '$id'";

    $uploadedFile = "uploads/$image";
    unlink($uploadedFile);
    if (mysqli_query($conn, $sql)) {
        $response = ['status' => 1, 'msg' => 'Data deleted successfully'];
    } else {
        $response = ['status' => 0, 'msg' => 'Error deleting data'];
    }

    echo json_encode($response);
    exit;
}





?>