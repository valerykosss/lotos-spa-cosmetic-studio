<?php
    require '../database/db.php';

    $service_types=mysqli_query($link, "SELECT `id_service_type`, `service_type_name` FROM `service_type`");
    $service_types=mysqli_fetch_all($service_types);

    $record_statuses=mysqli_query($link, "SELECT * FROM `procedure_record_status`");
    $record_statuses=mysqli_fetch_all($record_statuses);

    $services=mysqli_query($link, "SELECT `id_service`, `service_name` FROM `service`");
    $services=mysqli_fetch_all($services);

?>