<?php
require '../database/db.php';

// Получение идентификатора мастера из запроса (если передается)
$master_id = isset($_GET['id_master']) ? intval($_GET['id_master']) : 0;

$query = "
    SELECT DISTINCT st.id_service_type, st.service_type_name 
    FROM service_type st
    INNER JOIN service s ON s.id_service_type = st.id_service_type
    INNER JOIN master_service ms ON s.id_service = ms.id_service
    INNER JOIN master m ON ms.id_master = m.id_master
    WHERE m.id_master = ?
";
$stmt = $link->prepare($query);
$stmt->bind_param('i', $master_id);
$stmt->execute();
$result = $stmt->get_result();

$service_types = [];
while ($row = $result->fetch_assoc()) {
    $service_types[] = $row;
}

header('Content-Type: application/json');
echo json_encode($service_types);

$stmt->close();
$link->close();
?>
