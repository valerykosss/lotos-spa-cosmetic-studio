<?php
require '../database/db.php';

$id_service = isset($_GET['id_service']) ? (int)$_GET['id_service'] : 0;

$query = "
    SELECT m.id_master, m.master_name, m.master_surname, m.master_photo, m.position, m.education,
    AVG(r.master_rating) AS average_rating
    FROM master_service ms
    JOIN master m ON ms.id_master = m.id_master
    LEFT JOIN master_rating r ON m.id_master = r.id_master
    WHERE ms.id_service = ?
    GROUP BY m.id_master
";
$stmt = $link->prepare($query);
$stmt->bind_param('i', $id_service);
$stmt->execute();
$result = $stmt->get_result();

$masters = [];
while ($row = $result->fetch_assoc()) {
    $masters[] = $row;
}

header('Content-Type: application/json');
echo json_encode($masters);

$stmt->close();
$link->close();
?>
