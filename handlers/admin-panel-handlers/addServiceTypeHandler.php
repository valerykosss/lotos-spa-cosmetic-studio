<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

    $service_type_name = $_POST['service_type_name'];
    
    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `service_type` (`service_type_name`, `img`, `bg_img`) 
            VALUES ('$service_type_name', 'NULL', 'NULL')";

    if (mysqli_query($link, $query)) {
        $serviceTypeId = mysqli_insert_id($link); // Получаем ID нового мастера

        $response = [
            'success' => true,
            'service_type' => [
                'id' => $serviceTypeId,
                'service_type_name' => $service_type_name,
            ]
        ];
        echo json_encode($response);
    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>