<?php
require_once "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $response = ['status' => 1, 'data' => $data];
    } else {
        $response = ['status' => 0, 'data' => []];
    }
    // echo "<pre>";
    // print_r($response);
    // exit;
    echo json_encode($response);
    exit;
}
?>