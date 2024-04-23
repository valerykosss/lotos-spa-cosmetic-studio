<?php
require_once '../database/db.php';

if (isset($_GET['id_master'], $_GET['start_date'], $_GET['end_date'])) {
    $id_master = $_GET['id_master'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    try {
        $sql = "SELECT record_date, record_time FROM procedure_record
                WHERE id_master = ? AND record_date BETWEEN ? AND ?";
        
        $stmt = $link->prepare($sql);
        $stmt->bind_param('iss', $id_master, $start_date, $end_date);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $booked_slots = [];

        while ($row = $result->fetch_assoc()) {
            $booked_slots[] = $row;
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
