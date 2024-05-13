<?php
require_once '../database/db.php';

if (isset($_GET['id_master'])) {
    $id_master = $_GET['id_master'];

    try {
        // Подготавливаем запрос
        $stmt = $link->prepare("SELECT * FROM master WHERE id_master = ?");
        $stmt->bind_param('i', $id_master); // Используем 'i' для целочисленного значения

        // Выполняем запрос
        $stmt->execute();

        // Получаем результат запроса
        $result = $stmt->get_result();
        
        // Извлекаем данные мастера
        $master = $result->fetch_assoc();

        // Отправляем данные в формате JSON
        header('Content-Type: application/json');
        echo json_encode($master);

        // Закрываем запрос и соединение
        $stmt->close();
        $link->close();

    } catch (Exception $e) {
        // Обработка ошибок
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка при загрузке данных']);
    }
} else {
    // Ошибка неверных параметров запроса
    http_response_code(400);
    echo json_encode(['error' => 'Неверные параметры запроса']);
}
?>
