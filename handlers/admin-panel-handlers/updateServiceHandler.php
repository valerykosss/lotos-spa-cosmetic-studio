<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

// Получаем данные из POST-запроса
$serviceId = $_POST['serviceId'];
$service_type = $_POST['service_type'];
$service_name = $_POST['service_name'];
$service_image = $_POST['service_image'];
$service_description = $_POST['service_description'];
$duration = $_POST['duration'];
$price = $_POST['price'];
$insication = $_POST['insication'];
$results = $_POST['results'];

// Подготавливаем SQL-запрос для обновления мастера
$query = "UPDATE `service` SET 
            `id_service_type` = '$service_type', 
            `service_name` = '$service_name', 
            `service_image` = '$service_image', 
            `service_description` = '$service_description', 
            `duration` = '$duration', 
            `price` = '$price',
            `insication` = '$insication',
            `results` = '$results'
          WHERE `id_service` = $serviceId";

if (mysqli_query($link, $query)) {
    $response = [
        'success' => true,
        'message' => 'Услуга успешно обновлена'
    ];
    echo json_encode($response);
} else {
    $response = [
        'success' => false,
        'message' => 'Ошибка при обновлении услуги: ' . mysqli_error($link)
    ];
    echo json_encode($response);
}

?>
