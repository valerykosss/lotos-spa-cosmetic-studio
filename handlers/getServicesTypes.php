<?php
require '../database/db.php';

$query = "SELECT id_service_type, service_type_name FROM service_type";
$result = $link->query($query);

$service_types = [];
while ($row = $result->fetch_assoc()) {
    $service_types[] = $row;
}

header('Content-Type: application/json');
echo json_encode($service_types);

$link->close();
?>
