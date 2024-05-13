<?php
session_start();
require_once "../../database/db.php";

if(isset($_GET['service_id'])){
    $service_id=$_GET['service_id'];

    $get_masters=mysqli_query($link, "SELECT m.master_name, m.id_master FROM master_service ms
    inner join `master` m on ms.id_master=m.id_master
    WHERE id_service=$service_id");

    $masters = [];

    while ($row = mysqli_fetch_all($get_masters)) {
        $masters = $row;
    }

    echo json_encode($masters);
}else{
    echo json_encode([]);
}

?>