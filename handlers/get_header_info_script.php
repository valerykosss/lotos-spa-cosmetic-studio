<?php
    require_once "../database/db.php";

    if (session_id() == ''){
        session_start();
    }
    
    $service_types=mysqli_query($link, "SELECT DISTINCT service_type.id_service_type, service_type.service_type_name FROM `service_type` inner join service on service_type.id_service_type = service.id_service_type");
    $service_types=mysqli_fetch_all($service_types);
?>