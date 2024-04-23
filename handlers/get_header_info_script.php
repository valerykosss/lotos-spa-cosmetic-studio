<?php
    require_once "../database/db.php";

    if (session_id() == ''){
        session_start();
    }
    
    $service_types=mysqli_query($link, "SELECT * FROM `service_type`");
    $service_types=mysqli_fetch_all($service_types);
?>