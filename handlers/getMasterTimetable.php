<?php
require_once '../database/db.php';

if (isset($_GET['id_master']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $id_master = $_GET['id_master'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    try {
        $sql = "SELECT start, end FROM master_timetable
                WHERE id_master = ? AND start BETWEEN ? AND ?";
        
        $stmt = $link->prepare($sql);
        $stmt->bind_param('iss', $id_master, $start_date, $end_date);
        $stmt->execute();

        $result = $stmt->get_result();
        $timetable = [];

        while ($row = $result->fetch_assoc()) {
            $timetable[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($timetable);

        $stmt->close();
        $link->close();

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка при загрузке графика работы мастера']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Неверные параметры запроса при загрузке графика работы мастера']);
}
?>
