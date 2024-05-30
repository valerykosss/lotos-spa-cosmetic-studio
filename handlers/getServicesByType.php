<?php
require '../database/db.php';
$id_service_type = isset($_GET['id_service_type']) ? (int)$_GET['id_service_type'] : 0;

$query = "SELECT id_service, service_name, service_description, price, service_image, duration, price FROM service WHERE id_service_type = ?";
$stmt = $link->prepare($query);
$stmt->bind_param('i', $id_service_type);
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
