<?php
if (session_id() == '')
session_start();
require_once '../database/db.php';

try {
    // Запрос к базе данных для получения данных о мастерах
    $sql = "SELECT id_master, master_name, master_surname FROM master";
    $result = $link->query($sql);

    $masters = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $masters[] = $row;
        }
    }

    // Отправка данных в формате JSON
    header('Content-Type: application/json');
    echo json_encode($masters);

    // Закрытие соединения
    $link->close();

} catch (Exception $e) {
    // Обработка ошибок
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка при загрузке данных']);
}
?>
