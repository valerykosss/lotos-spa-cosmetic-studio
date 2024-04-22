<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

    // Получение данных из таблицы service_type
    $query = "SELECT * FROM service_type";
    $result = mysqli_query($link, $query);

    $service_types = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $service_types[] = $row;
    }

    // Возвращаем данные в формате JSON
    echo json_encode($service_types);

    // Закрытие подключения
    mysqli_close($link);
?>
