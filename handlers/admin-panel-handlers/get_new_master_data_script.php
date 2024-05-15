<?php
session_start();
require_once "../../database/db.php";

if(isset($_GET['service_id'])){
    $service_id=$_GET['service_id'];

    $get_masters=mysqli_query($link, "SELECT m.master_name, m.id_master FROM master m
    left join master_service ws ON m.id_master = ws.id_master AND
    ws.id_service = $service_id  WHERE ws.id_service IS NULL");

    $masters = [];

    while ($row = mysqli_fetch_all($get_masters)) {
        $masters = $row;
    }

    echo json_encode($masters);
}else{
    echo json_encode([]);
}

?>