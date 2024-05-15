<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

// Получаем данные из POST-запроса
$serviceTypeId = $_POST['serviceTypeId'];
$service_type_name = $_POST['service_type_name'];

// Подготавливаем SQL-запрос для обновления мастера
$query = "UPDATE `service_type` SET 
            `service_type_name` = '$service_type_name'
          WHERE `id_service_type` = $serviceTypeId";

if (mysqli_query($link, $query)) {
    $response = [
        'success' => true,
        'message' => 'Тип услуги успешно обновлен'
    ];
    echo json_encode($response);
} else {
    $response = [
        'success' => false,
        'message' => 'Ошибка при обновлении типа услуги: ' . mysqli_error($link)
    ];
    echo json_encode($response);
}

?>
