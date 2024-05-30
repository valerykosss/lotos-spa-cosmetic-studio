<?php
require '../database/db.php';

$id_service = $_GET['id_service'];
$id_master = $_GET['id_master'];

// Получаем данные услуги
$service_sql = "SELECT id_service, service_name, service_description, price FROM service WHERE id_service = $id_service";
$service_result = $link->query($service_sql);

if ($service_result->num_rows > 0) {
    $service_data = $service_result->fetch_assoc();
} else {
    die("Ошибка: не удалось получить данные услуги");
}

// Получаем данные мастера и его рейтинг
$master_sql = "SELECT m.master_name, m.master_surname, m.position, 
                COALESCE(AVG(r.master_rating), 0) AS average_rating
                FROM master m
                LEFT JOIN master_rating r ON m.id_master = r.id_master
                WHERE m.id_master = $id_master";
$master_result = $link->query($master_sql);

if ($master_result->num_rows > 0) {
    $master_data = $master_result->fetch_assoc();
    $master_data['average_rating'] = round($master_data['average_rating'], 2);
} else {
    die("Ошибка: не удалось получить данные мастера");
}

// Возвращаем данные в формате JSON
$response = array(
    'service' => $service_data,
    'master' => $master_data
);

echo json_encode($response);

$link->close();
