<?php
require_once '../database/db.php';

if (isset($_GET['id_master'])) {
    $id_master = $_GET['id_master'];

    try {
        // Запрос к базе данных для получения данных о процедурах для выбранного мастера
        $sql = "SELECT s.id_service, s.service_name FROM master_service ms
                JOIN service s ON ms.id_service = s.id_service
                WHERE ms.id_master = ?";
        
        $stmt = $link->prepare($sql);
        $stmt->bind_param('i', $id_master);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $services = [];

        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }

        // Отправка данных в формате JSON
        header('Content-Type: application/json');
        echo json_encode($services);

        // Закрытие соединения
        $stmt->close();
        $link->close();

    } catch (Exception $e) {
        // Обработка ошибок
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка при загрузке данных']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Неверные параметры запроса']);
}
?>
