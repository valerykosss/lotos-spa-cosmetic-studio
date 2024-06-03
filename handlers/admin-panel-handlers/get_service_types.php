<?php
session_start();
require_once "../../database/db.php";

$query = "SELECT `service_type`.`id_service_type`, `service_type`.`service_type_name` FROM `service_type`";
$result = mysqli_query($link, $query);

if (!$result) {
    die('Query error: ' . mysqli_error($link));
}

$service_type = array();
while ($row = mysqli_fetch_assoc($result)) {
    $service_type[] = $row;
}

echo json_encode($service_type);
mysqli_close($link);
?>
