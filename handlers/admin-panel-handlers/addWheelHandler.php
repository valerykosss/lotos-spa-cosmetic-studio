<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

    $discount_name = $_POST['discount_name'];
    $sector_wheel_color = $_POST['sector_wheel_color'];
    $id_service = $_POST['id_service'];

    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `wheel_discount` (`discount_name`, `sector_wheel_color`, `id_service`) 
            VALUES ('$discount_name', '$sector_wheel_color', '$id_service')";

    if (mysqli_query($link, $query)) {
        $sectorId = mysqli_insert_id($link); // Получаем ID нового мастера
        $response = [
            'success' => true,
            'wheel_discount' => [
                'id' => $sectorId,
                'discount_name' => $discount_name,
                'sector_wheel_color' => $sector_wheel_color,
                'id_service' => $id_service,
            ]
        ];
        echo json_encode($response);
    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>