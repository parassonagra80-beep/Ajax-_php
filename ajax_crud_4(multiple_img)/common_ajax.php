<?php
require_once "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type'] == 'add_edit') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $deletedImages = $_POST['deleted_images'] ?? [];
    $skipIndexes = $_POST['skip_new_indexes'] ?? [];
    $multipleimage = [];
    $post_id = $_POST['post_id'] ?? '';

    if ($deletedImages && count($deletedImages) > 0) {

        foreach ($deletedImages as $key => $di) {

            $filepath = 'uploads/' . $di;
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            $sql = "DELETE FROM post_image WHERE image = '$di'";
            mysqli_query($conn, $sql);
        }
    }

    if ($id) {
        $sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {

            if (isset($_FILES['image']) && $_FILES['image']['name'][0]) {
                foreach ($_FILES['image']['name'] as $key => $image) {

                    if (in_array($key, $skipIndexes))
                        continue;

                    $tmp_name = $_FILES['image']['tmp_name'][$key];
                    $image = $id . time() . $image;
                    move_uploaded_file($tmp_name, 'uploads/' . $image);
                    $post_sql = "INSERT INTO post_image (post_id, image) VALUES ('$post_id','$image')";
                    $post_result = mysqli_query($conn, $post_sql);
                    // mysqili_query($conn, "INSERT INTO post_image (post_id, image) VALUES ('$post_id','$image')");
                    // print_r($image);
                    // exit;
                }
            }
            $response = ["status" => 1, "msg" => "data saved successfully"];
        } else {
            $response = ["status" => 2, "msg" => "data can't save"];
        }
    } else {

        $sql = "INSERT INTO users (name,email,phone) VALUES('$name','$email','$phone')";
        if (mysqli_query($conn, $sql)) {
            $post_id = mysqli_insert_id($conn);
            // echo "<pre>";
            // print_r($_FILES);
            // exit;
            if (isset($_FILES['image']) && $_FILES['image']['name'][0]) {
                foreach ($_FILES['image']['name'] as $key => $image) {

                    if (in_array($key, $skipIndexes))
                        continue;

                    $tmp_name = $_FILES['image']['tmp_name'][$key];
                    $image = $post_id . time() . $image;
                    move_uploaded_file($tmp_name, 'uploads/' . $image);
                    mysqli_query($conn, "INSERT INTO post_image (post_id, image) VALUES ('$post_id','$image')");
                    // print_r($image);
                    // exit;
                }
            }
            $response = ["status" => 1, "msg" => "data saved successfully"];
        } else {
            $response = ["status" => 2, "msg" => "data can't save"];
        }
    }

    echo json_encode($response);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == "GET") {
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
    $get_sql = "SELECT users.* , GROUP_CONCAT(post_image.image) AS image, GROUP_CONCAT(post_image.post_id) AS post_id 
            FROM users 
            INNER JOIN post_image ON post_image.post_id = users.id 
            WHERE users.id = '$id'";
    $get_result = mysqli_query($conn, $get_sql);
    if (mysqli_num_rows($get_result) > 0) {
        $data = mysqli_fetch_array($get_result, MYSQLI_ASSOC);
    }
    $image = $data["image"] ?? '';

    $filepath = 'uploads/' . $image;
    if (file_exists($filepath)) {
        unlink($filepath);
    }
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