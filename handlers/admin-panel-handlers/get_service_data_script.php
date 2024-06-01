<?php
session_start();
require_once "../../database/db.php";

$get_services=mysqli_query($link, "SELECT `service_name`, `id_service`, `duration` FROM `service`");

$services = [];

while ($row = mysqli_fetch_all($get_services)) {
    $services = $row;
}

echo json_encode($services);

?>