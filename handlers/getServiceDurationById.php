<?php
// getServiceDurationById.php

// Подключение к базе данных
require_once '../database/db.php';

// Получение ID услуги из GET-запроса
$id_service = $_GET['id_service'] ?? null;

if (!$id_service) {
    echo json_encode(['error' => 'ID услуги не предоставлен']);
    exit;
}

// Запрос к базе данных для получения длительности услуги по ID
$query = "SELECT duration FROM service WHERE id_service = ?";

$stmt = $pdo->prepare($query);
$stmt->execute([$id_service]);

$service = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$service) {
    echo json_encode(['error' => 'Услуга не найдена']);
    exit;
}

// Отправка ответа в формате JSON
echo json_encode(['duration' => $service['duration']]);
?>
