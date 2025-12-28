<?php 
require_once "conn.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = $_POST['id'] ?? '';
   
    $sql = "DELETE FROM users WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        $response = ['status' => 1, 'msg' => 'deleted'];
    }else{
        
        $response = ['status' => 0, 'msg' => 'not deleted'];
    }
    echo json_encode($response);
    exit;
}
?>