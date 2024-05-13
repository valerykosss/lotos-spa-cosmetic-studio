<?php
require_once "../../database/db.php";

$id=$_POST['id'];

$query="DELETE FROM wheel_discount WHERE id_wheel_discount=$id";

if(mysqli_query($link, $query)){
    $wheel_id=mysqli_insert_id($link);

    $response = ['success' => true];
    echo json_encode($response);
}else{
    $response = ['success' => false];
    echo json_encode($response);
}
?>