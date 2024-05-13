<?php
require_once '../database/db.php';

require_once '../database/db.php';

if (isset($_GET['id_master'], $_GET['start_date'], $_GET['end_date'])) {
    $id_master = $_GET['id_master'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    try {
        $sql = "SELECT pr.record_date, pr.record_time, s.duration
                FROM procedure_record pr
                JOIN master_service ms ON pr.id_master_service = ms.id_master_service
                JOIN service s ON ms.id_service = s.id_service
                WHERE ms.id_master = ? AND pr.record_date BETWEEN ? AND ?";
        
        $stmt = $link->prepare($sql);
        $stmt->bind_param('iss', $id_master, $start_date, $end_date);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $booked_slots = [];

        while ($row = $result->fetch_assoc()) {
            $booked_slots[] = [
                'record_date' => $row['record_date'],
                'record_time' => $row['record_time'],
                'duration' => $row['duration']
            ];
        }

        // Отправка данных в формате JSON
        header('Content-Type: application/json');
        echo json_encode($booked_slots);

        // Закрытие соединения
        $stmt->close();
        $link->close();

    } catch (Exception $e) {
        // Обработка ошибок
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка при загрузке данных для поиска забронированных слотов']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Неверные параметры запроса для поиска забронированных слотов']);
}

?>
