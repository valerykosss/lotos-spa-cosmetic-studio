<?php
require '../database/db.php';
$id_service_type = isset($_GET['id_service_type']) ? (int)$_GET['id_service_type'] : 0;
$master_id = isset($_GET['id_master']) ? intval($_GET['id_master']) : 0;

$query = "SELECT service.id_service, service_name, service_description, price, service_image, duration, price FROM service inner join master_service on master_service.id_service = service.id_service WHERE service.id_service_type = ? and master_service.id_master = ?";

$stmt = $link->prepare($query);
$stmt->bind_param('ii', $id_service_type, $master_id);
$stmt->execute();
$result = $stmt->get_result();

$services = [];
while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}

header('Content-Type: application/json');
echo json_encode($services);

$stmt->close();
$link->close();
?>
